<?php

$pageStyles = 'shop';
$pageScripts = 'shop';
require_once __DIR__ . '/../layouts/header.php';

?>

<section id="banner">
    <div class="container">
        <h2 class="title">Shop</h2>
        <nav class="breadcrumb">
            <span class="breadcrumb-item">Home</span>
            <span class="breadcrumb-item">Pages</span>
            <span class="breadcrumb-item">Shop</span>
        </nav>
    </div>
</section>

<div class="shop-container">

    <aside class="shop-sidebar">

        <h3>Categories</h3>
        <ul class="category-list">
            <li>
                <a href="#" class="filter-category <?= $categoryId === null ? 'active' : '' ?>" data-category="">
                    All
                </a>
            </li>

            <?php foreach ($categories as $cat): ?>
                <li>
                    <a href="#"
                        class="filter-category <?= $categoryId == $cat['id'] ? 'active' : '' ?>"
                        data-category="<?= $cat['id'] ?>">
                        <?= $cat['name'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <h3>Filter By Price</h3>
        <ul class="price-list">
            <li>
                <a href="#" class="filter-price <?= $price === null ? 'active' : '' ?>" data-price="">
                    All
                </a>
            </li>

            <li><a href="#" class="filter-price <?= $price == 10 ? 'active' : '' ?>" data-price="10">Less than $10</a></li>
            <li><a href="#" class="filter-price <?= $price == 20 ? 'active' : '' ?>" data-price="20">$10 - $20</a></li>
            <li><a href="#" class="filter-price <?= $price == 30 ? 'active' : '' ?>" data-price="30">$20 - $30</a></li>
            <li><a href="#" class="filter-price <?= $price == 40 ? 'active' : '' ?>" data-price="40">$30 - $40</a></li>
            <li><a href="#" class="filter-price <?= $price == 50 ? 'active' : '' ?>" data-price="50">$40 - $50</a></li>
        </ul>

    </aside>

    <div class="shop-content">

        <p class="results-count">
            Showing <span id="results-count"><?= count($products) ?></span> results out of <?= $productsCount ?>
        </p>

        <div class="shop-grid" id="products-container">
            <?php foreach ($products as $product): ?>
                <a class="product-card-link" href="/waggy/product/index/<?= $product['id'] ?>">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="/waggy/public/images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                        </div>
                        <h3><?= $product['name'] ?></h3>
                        <div class="product-stars">
                            <?php
                            $num = rand(2, 5);
                            $star = "";
                            for ($i = 1; $i <= $num; $i++) {
                                $star .= "★";
                            }
                            ?>
                            <span><?= $star . " " . $num . ".0" ?></span>
                        </div>
                        <p class="product-price">$<?= number_format($product['price'], 2) ?></p>
                        <button class="btn-cart">ADD TO CART</button>
                    </div>
                </a> <?php endforeach; ?>
        </div>

        <div class="pagination" id="pagination">
            <?php if ($currentPage > 1): ?>
                <a href="#" class="pagination-link arrow-left" data-page="<?= $currentPage - 1 ?>">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            <?php endif; ?>


            <?php if ($totalPages > 1): ?>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="#" class="pagination-link num <?= $i == $currentPage ? 'active' : '' ?>" data-page="<?= $i ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            <?php endif; ?>

            <?php if ($currentPage < $totalPages): ?>
                <a href="#" class="pagination-link arrow-right" data-page="<?= $currentPage + 1 ?>">
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            <?php endif; ?>
        </div>

    </div>

</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>