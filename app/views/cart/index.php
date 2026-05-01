<?php
$pageStyles = 'cart';
$pageScripts = 'cart';
require_once __DIR__ . '/../layouts/header.php';

$total = 0;
foreach ($products as $product) {
    $total += $product['price'] * $product['quantity'];
}

?>

<!-- banner start  -->
<section id="banner">
    <div class="container">
        <h2 class="title">Cart</h2>
        <nav class="breadcrumb">
            <span class="breadcrumb-item">Home</span>
            <span class="breadcrumb-item">Pages</span>
            <span class="breadcrumb-item">Cart</span>
        </nav>
    </div>
</section>
<!-- banner finish  -->

<div class="cart-container">
    <div class="cart-items">
        <div class="header">
            <div>PRODUCT</div>
            <div>QUANTITY</div>
            <div>SUBTOTAL</div>
            <div></div>
        </div>
        <?php if (count($products) === 0) : ?>
            <div class="empty-cart">
                <h1>
                    Your cart is empty <i class="fa-regular fa-face-frown"></i>
                </h1>
            </div>

        <?php else : ?>

            <?php foreach ($products as $product) : ?>
                <div class="product-row">
                    <div class="product-info">
                        <div class="product-image">
                            <img src="/waggy/public/images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                        </div>
                        <div class="product-name"><?= $product['name'] ?></div>
                    </div>
                    <div class="quantity-control">
                        <button class="quantity-btn minus">-</button>
                        <input type="text" class="quantity-input" id="quantity-input" value="<?= $product['quantity'] ?>" readonly>
                        <button class="quantity-btn plus">+</button>
                    </div>
                    <div class="subtotal" data-price="<?= $product['price'] ?>"><?= number_format($product['price'] * $product['quantity'], 2) ?></div>
                    <button class="delete-btn" data-id="<?= $product['id'] ?>">🗑</button>
                </div>
            <?php endforeach ?>
        <?php endif; ?>

    </div>

    <!-- Cart Total -->
    <div class="cart-total">
        <h2>Cart Total</h2>

        <div class="total-row">
            <div>SUBTOTAL</div>
            <div class="subtotal-price">$<?= number_format($total, 2) ?></div>
        </div>
        <div class="total-row">
            <div>TOTAL</div>
            <div class="total-price">$<?= number_format($total, 2) ?></div>
        </div>

        <div class="buttons-container">
            <button class="continue-to-shop-btn">
                <a href="/waggy/shop" class="continue-shopping">Continue To Shop</a>
            </button>
            <?php if (count($products) > 0): ?>
                <button class="proceed-btn">PROCEED TO CHECKOUT</button>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>