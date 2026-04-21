<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $product = new Product();

        $clothing = $product->getByCategory(1);
        $food = $product->getByCategory(2, 8, 0);

        $this->view('home/index', [
            'clothing' => $clothing,
            'food' => $food
        ]);
    }
}
