<?php
$pageStyles = 'checkout';
$pageScripts = 'checkout';
require_once __DIR__ . '/../layouts/header.php';
?>

<!-- banner start  -->
<section id="banner">
    <div class="container">
        <h2 class="title">Checkout</h2>
        <nav class="breadcrumb">
            <span class="breadcrumb-item">Home</span>
            <span class="breadcrumb-item">Pages</span>
            <span class="breadcrumb-item">Checkout</span>
        </nav>
    </div>
</section>
<!-- banner finish  -->

<!-- checkout-container start  -->
<div class="checkout-container">

    <!-- Left: Billing Details -->
    <div class="billing-details">
        <h2>Billing Details</h2>

        <div class="form-group">
            <label>First Name <span>*</span></label>
            <input type="text" id="first-name" placeholder="First Name">
        </div>
        <div class="form-group">
            <label>Last Name *</label>
            <input type="text" id="last-name" placeholder="Last Name">
        </div>
        <div class="form-group">
            <label>Street Address <span>*</span></label>
            <input type="text" id="address" placeholder="House number and street name">
        </div>
        <div class="form-group">
            <label>Town / City <span>*</span></label>
            <input type="text" id="city" placeholder="Town / City">
        </div>
        <div class="form-group">
            <label>Zip Code <span>*</span></label>
            <input type="text" id="zip" placeholder="Zip Code">
        </div>
        <div class="form-group">
            <label>Phone <span>*</span></label>
            <input type="text" id="phone" placeholder="Phone">
        </div>
        <div class="form-group">
            <label>Email <span>*</span></label>
            <input type="email" id="email" placeholder="Email address">
        </div>
    </div>

    <div class="order-summary">
        <h2>Cart Totals</h2>

        <div class="total-row">
            <span>SUBTOTAL</span>
            <span>$<?= number_format($totalPrice, 2) ?></span>
        </div>
        <div class="total-row">
            <span>TOTAL</span>
            <span>$<?= number_format($totalPrice, 2) ?></span>
        </div>

        <div class="form-group cart-detail">
            <label>Card Details <span>*</span></label>
            <div id="card-element"></div>
            <div id="card-errors"></div>
        </div>

        <button id="place-order-btn">PLACE AN ORDER</button>
    </div>

</div>
<!-- checkout-container finish  -->

<!-- gallery start  -->
<section class="gallery">
    <img src="/waggy/public/images/gallery/gallery1.jpg" alt="">
    <img src="/waggy/public/images/gallery/gallery2.jpg" alt="">
    <img src="/waggy/public/images/gallery/gallery3.jpg" alt="">
    <img src="/waggy/public/images/gallery/gallery4.jpg" alt="">
    <img src="/waggy/public/images/gallery/gallery5.jpg" alt="">
    <img src="/waggy/public/images/gallery/gallery6.jpg" alt="">
</section>
<!-- gallery finish  -->


<script src="https://js.stripe.com/v3/"></script>
<script>const stripeKey = '<?= STRIPE_PUBLIC_KEY ?>';</script>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>