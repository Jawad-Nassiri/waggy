<?php

namespace Admin\Controllers;

use Admin\Controllers\BaseController;
use Admin\Models\Product;
use Admin\Models\User;
use Admin\Models\Order;


class DashboardController extends BaseController
{
    public function index()
    {
        $product = new Product();
        $user = new User();
        $order = new Order();

        $latestProducts = $product->getLatestProducts(6);
        $latestUsers = $user->getLatestUsers(6);

        $totalProducts = $product->countAll();
        $totalUsers = $user->countAll();
        $totalOrders = $order->countAll();
        $totalRevenue = $order->totalRevenue();

        $this->view('dashboard/index', [
            'latestProducts' => $latestProducts,
            'latestUsers' => $latestUsers,
            'totalProducts' => $totalProducts,
            'totalUsers' => $totalUsers,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue
        ]);
    }

}