<?php

$pageStyles = 'success';
require_once __DIR__ . '/../layouts/header.php';
?>

<!-- banner start  -->
<section id="banner">
    <div class="container">
        <h2 class="title">Thankyou <span><?= $username ?></span></h2>
        <nav class="breadcrumb">
            <span class="breadcrumb-item">Home</span>
            <span class="breadcrumb-item">Pages</span>
            <span class="breadcrumb-item">Thankyou</span>
        </nav>
    </div>
</section>
<!-- banner finish  -->

<div class="success-container">

    <div class="success-header">
        <div class="success-icon">
            <i class="fa-solid fa-check"></i>
        </div>
        <div>
            <p>Order #<?= $order['id'] ?></p>
            <h2>Order Confirmed !</h2>
        </div>
    </div>

    <div class="success-card">
        <h3>Your Order <span><?= count($orderItems) ?></span></h3>

        <?php foreach ($orderItems as $item): ?>
            <div class="order-item">
                <img src="/waggy/public/images/<?= $item['image'] ?>" alt="<?= $item['name'] ?>">
                <div class="order-item-info">
                    <p class="order-item-name"><?= htmlspecialchars($item['name']) ?></p>
                    <p class="order-item-qty">x <?= $item['quantity'] ?></p>
                </div>
                <p class="order-item-price">$<?= number_format($item['price'], 2) ?></p>
            </div>
        <?php endforeach; ?>

        <div class="order-totals">
            <div class="order-total-row">
                <span>Subtotal</span>
                <span>$<?= number_format($order['total'], 2) ?></span>
            </div>
            <div class="order-total-row total">
                <span>Total</span>
                <span>$<?= number_format($order['total'], 2) ?></span>
            </div>
        </div>
    </div>

    <a href="/waggy/shop" class="continue-btn">CONTINUE SHOPPING</a>

</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>