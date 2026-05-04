<?php

namespace App\Controllers;

// This loads the Stripe PHP library. Without this, PHP doesn't know what Stripe is it's like importing a tool before using it.
require_once 'C:\\xampp\\htdocs\\waggy\\stripe-php\\init.php';
// this loads config file where keys are defined
require_once 'C:\\xampp\\htdocs\\waggy\\config\\stripe.php';
// This tells the Stripe library "use this secret key for all requests
\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

use Core\Controller;
use App\Models\Cart;
use App\Models\Order;

class CartController extends Controller
{
    private $userId;

    public function __construct()
    {
        $this->userId = $_SESSION['user']['id'] ?? null;
    }
    public function index()
    {

        if (!$this->userId) {
            header("Location: /waggy/auth/login");
            exit;
        }

        $cart = new Cart();
        $products = $cart->getCartItems($this->userId);

        $this->view('cart/index', ['products' => $products]);

    }
    public function add()
    {
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents("php://input"), true);

        if (!$this->userId) {
            echo json_encode(['status' => 'Error', 'message' => 'Not logged in']);
            exit;
        }

        $cart = new Cart();
        $productId = trim($body['productId'] ?? '');
        $quantity = (int) ($body['quantity'] ?? 1);

        if ($productId && $quantity) {
            $res = $cart->addToCart($this->userId, $productId, $quantity);
            if ($res === 'exists') {
                echo json_encode(['status' => 'Warning', 'message' => 'Product is already in the cart']);
                exit;
            } else {
                $_SESSION['cartCount'] += 1;
                echo json_encode([
                    'status' => 'Success',
                    'message' => 'Product added to cart',
                    'cartCount' => $_SESSION['cartCount']
                ]);
                exit;
            }
        }

        echo json_encode(['status' => 'Error', 'message' => 'Invalid data']);
        exit;
    }
    public function delete()
    {
        header('Content-Type: application/json');

        $body = json_decode(file_get_contents("php://input"), true);

        $productId = $body['productId'] ?? null;

        if (!$this->userId) {
            echo json_encode([
                'status' => 'Error',
                'message' => 'Not logged in'
            ]);
            exit;
        }

        if (!$productId) {
            echo json_encode([
                'status' => 'Error',
                'message' => 'Invalid product ID'
            ]);
            exit;
        }

        $cart = new Cart();
        $res = $cart->removeItem($this->userId, $productId);

        if ($res) {
            if (!isset($_SESSION['cartCount'])) {
                $_SESSION['cartCount'] = 0;
            }

            $_SESSION['cartCount'] = max(0, $_SESSION['cartCount'] - 1);

            echo json_encode([
                'status' => 'Success',
                'message' => 'Item removed successfully',
                'cartCount' => $_SESSION['cartCount']
            ]);
        } else {
            echo json_encode([
                'status' => 'Error',
                'message' => 'Failed to remove item'
            ]);
        }

        exit;
    }
    public function update()
    {
        header('Content-Type: application/json');

        if (!$this->userId) {
            echo json_encode(['status' => 'Error', 'message' => 'Not logged in']);
            exit;
        }

        $body = json_decode(file_get_contents("php://input"), true);
        $productId = $body['productId'] ?? null;
        $quantity = $body['quantity'] ?? null;

        if (!$productId || !$quantity) {
            echo json_encode(['status' => 'Error', 'message' => 'Invalid data']);
            exit;
        }

        $cart = new Cart();
        $cart->updateQuantity($this->userId, $productId, $quantity);

        echo json_encode(['status' => 'Success']);
        exit;
    }
    public function checkout()
    {

        if (!$this->userId) {
            header("Location: /waggy/auth/login");
            exit;
        }

        $cart = new Cart();
        $products = $cart->getCartItems($this->userId);

        if (count($products) === 0) {
            header("Location: /waggy/shop");
            exit;
        }

        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $product['price'] * $product['quantity'];
        }

        $this->view('cart/checkout', [
            'totalPrice' => $totalPrice
        ]);
    }
    public function payment()
    {
        header('Content-Type: application/json');

        if (!$this->userId) {
            echo json_encode(['error' => 'Not logged in']);
            exit;
        }

        $body = json_decode(file_get_contents("php://input"), true);

        $cart = new Cart();
        $products = $cart->getCartItems($this->userId);

        if (count($products) === 0) {
            echo json_encode(['error' => 'Cart is empty']);
            exit;
        }

        $total = 0;
        foreach ($products as $product) {
            $total += $product['price'] * $product['quantity'];
        }


        // This sends a request to Stripe's servers saying I want to create a payment
        // Stripe responds with a payment object that contains everything needed to process the transaction.
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => (int) ($total * 100), //Stripe works in cents
            'currency' => 'usd',
            'metadata' => [
                'user_id' => $this->userId,
                'name' => $body['firstName'] . ' ' . $body['lastName'],
                'email' => $body['email']
            ]
        ]);

        $_SESSION['cartCount'] = 0;
        $_SESSION['order_success'] = true;
        echo json_encode(['clientSecret' => $paymentIntent->client_secret]);
        exit;
    }
    public function webhook()
    {
        $payload = file_get_contents('php://input');
        $sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sigHeader,
                STRIPE_WEBHOOK_SECRET
            );
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
            exit;
        }

        if ($event->type === 'payment_intent.succeeded') {
            $paymentIntent = $event->data->object;
            $userId = $paymentIntent->metadata->user_id;
            $total = $paymentIntent->amount / 100;

            $cart = new Cart();
            $products = $cart->getCartItems($userId);

            $order = new Order();
            $orderId = $order->createOrder($userId, $total);

            foreach ($products as $product) {
                $order->createOrderItems($orderId, $product['id'], $product['quantity'], $product['price']);
            }

            $cart->clearCart($userId);
            // $_SESSION['cartCount'] = 0;
        }

        http_response_code(200);
        exit;
    }

    public function success()
    {
        if (!isset($_SESSION['order_success'])) {
            header("Location: /waggy/shop");
            exit;
        }
        unset($_SESSION['order_success']);

        if (!$this->userId) {
            header("Location: /waggy/auth/login");
            exit;
        }

        $order = new Order();
        $lastOrder = $order->getLastOrder($this->userId);
        $orderItems = $order->getOrderItems($lastOrder['id']);

        $this->view('cart/success', [
            'order' => $lastOrder,
            'orderItems' => $orderItems,
            'username' => $_SESSION['user']['name']
        ]);
    }

}
