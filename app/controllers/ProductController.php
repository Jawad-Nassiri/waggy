<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Product;
use App\Models\Category;



class ProductController extends Controller
{
    public function index($id)
    {
        $id = (int) $id;
        $product = new Product();
        $category = new Category();

        $data = $product->getProductById($id);
        $categoryId = $data['category_id'];

        $category = $category->getCategoryById($categoryId);

        $this->view('product/index', [
            'product' => $data,
            'categoryName' => $category['name']
        ]);
    }
}
