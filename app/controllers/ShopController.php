<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{

    public function index()
    {
        $product = new Product();
        $category = new Category();

        $limit = 9;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        $categoryId = isset($_GET['category']) ? (int)$_GET['category'] : null;

        $priceRanges = [
            10 => [0, 10],
            20 => [10, 20],
            30 => [20, 30],
            40 => [30, 40],
            50 => [40, 50],
        ];

        $price = isset($_GET['price']) ? (int)$_GET['price'] : null;
        $minPrice = null;
        $maxPrice = null;

        if ($price && isset($priceRanges[$price])) {
            $minPrice = $priceRanges[$price][0];
            $maxPrice = $priceRanges[$price][1];
        }

        $productsCount = $product->countAll();
        $products = $product->getFiltered($limit, $offset, $categoryId, $minPrice, $maxPrice);
        $categories = $category->getAll();
        $total = $product->countFiltered($categoryId, $minPrice, $maxPrice);
        $totalPages = ceil($total / $limit);

        $this->view('shop/index', [
            'productsCount' => $productsCount,
            'products' => $products,
            'categories' => $categories,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'categoryId' => $categoryId,
            'price' => $price
        ]);
    }


    public function filter()
    {
        $product = new Product();

        $limit = 9;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $categoryId = isset($_GET['category']) && $_GET['category'] !== '' ? (int)$_GET['category'] : null;

        $priceRanges = [
            10 => [0, 10],
            20 => [10, 20],
            30 => [20, 30],
            40 => [30, 40],
            50 => [40, 50],
        ];

        $price = isset($_GET['price']) && $_GET['price'] !== '' ? (int)$_GET['price'] : null;
        $minPrice = null;
        $maxPrice = null;

        if ($price && isset($priceRanges[$price])) {
            $minPrice = $priceRanges[$price][0];
            $maxPrice = $priceRanges[$price][1];
        }

        $products = $product->getFiltered($limit, $offset, $categoryId, $minPrice, $maxPrice);
        $total = $product->countFiltered($categoryId, $minPrice, $maxPrice);
        $totalPages = ceil($total / $limit);

        header('Content-Type: application/json');
        echo json_encode([
            'products' => $products,
            'totalPages' => $totalPages,
            'totalProducts' => $total,
            'totalPages' => $totalPages
        ]);
    }
}
