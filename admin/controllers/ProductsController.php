<?php

namespace Admin\Controllers;

use Admin\Controllers\BaseController;
use Admin\Models\Product;

class ProductsController extends BaseController
{
    public function index()
    {
        $productsModel = new Product();
        $products = $productsModel->getAllProducts();


        if (empty($products)) {
            return $this->view('products/index', [
                'error' => 'No products found !'
            ]);
        }

        return $this->view('products/index', [
            'products' => $products
        ]);
    }
}