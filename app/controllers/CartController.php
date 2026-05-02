<?php

namespace App\Controllers;
require_once 'C:\\xampp\\htdocs\\waggy\\stripe-php\\init.php';
require_once 'C:\\xampp\\htdocs\\waggy\\config\\stripe.php';
\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
use Core\Controller;
use App\Models\Cart;

class CartController extends Controller
{

    public function index()
    {
        $userId = $_SESSION['user']['id'] ?? null;

        if (!$userId) {
            header("Location: /waggy/auth/login");
            exit;
        }

        $cart = new Cart();
        $products = $cart->getCartItems($userId);

        $this->view('cart/index', ['products' => $products]);

    }

    public function add()
    {
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents("php://input"), true);

        $userId = $_SESSION['user']['id'] ?? null;

        if (!$userId) {
            echo json_encode(['status' => 'Error', 'message' => 'Not logged in']);
            exit;
        }

        $cart = new Cart();
        $productId = trim($body['productId'] ?? '');
        $quantity = (int) ($body['quantity'] ?? 1);

        if ($productId && $quantity) {
            $res = $cart->addToCart($userId, $productId, $quantity);
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

        $userId = $_SESSION['user']['id'] ?? null;
        $productId = $body['productId'] ?? null;

        if (!$userId) {
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
        $res = $cart->removeItem($userId, $productId);

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
    public function checkout()
    {
        $userId = $_SESSION['user']['id'] ?? null;

        if (!$userId) {
            header("Location: /waggy/auth/login");
            exit;
        }

        $cart = new Cart();
        $products = $cart->getCartItems($userId);

        if (count($products) === 0) {
            header("Location: /waggy/shop");
            exit;
        }

        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $product['price'] * $product['quantity'];
        }

        $this->view('cart/checkout', [
            'products' => $products,
            'totalPrice' => $totalPrice
        ]);
    }

    public function payment()
    {
        header('Content-Type: application/json');

        $userId = $_SESSION['user']['id'] ?? null;

        if (!$userId) {
            echo json_encode(['error' => 'Not logged in']);
            exit;
        }

        $body = json_decode(file_get_contents("php://input"), true);

        $cart = new Cart();
        $products = $cart->getCartItems($userId);

        if (count($products) === 0) {
            echo json_encode(['error' => 'Cart is empty']);
            exit;
        }

        $total = 0;
        foreach ($products as $product) {
            $total += $product['price'] * $product['quantity'];
        }

        \Stripe\Stripe::setApiKey('STRIPE_SECRET_KEY');

        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => (int) ($total * 100),
            'currency' => 'eur',
            'metadata' => [
                'user_id' => $userId,
                'name' => $body['firstName'] . ' ' . $body['lastName'],
                'email' => $body['email']
            ]
        ]);

        echo json_encode(['clientSecret' => $paymentIntent->client_secret]);
        exit;
    }



}
