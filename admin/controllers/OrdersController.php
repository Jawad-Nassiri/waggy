<?php

namespace Admin\Controllers;
use Admin\Controllers\BaseController;
use Admin\Models\Order;
use Admin\Models\User;

class OrdersController extends BaseController {
    public function index() {

    $orderModel = new Order();
    $userModel = new User();

    $orders = $orderModel->getAllOrders();

    foreach ($orders as &$order) {
        $order['user'] = $userModel->getUserById($order['user_id']);
    }
    unset($order);

    return $this->view('orders/index', [
        'orders' => $orders
    ]);
}
}