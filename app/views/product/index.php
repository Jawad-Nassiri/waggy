<?php
$pageStyles = 'product';
$pageScripts = 'product';
require_once __DIR__ . '/../layouts/header.php';
?>

<!-- banner start  -->
<section id="banner">
    <div class="container">
        <h2 class="title">Product</h2>
        <nav class="breadcrumb">
            <span class="breadcrumb-item">Home</span>
            <span class="breadcrumb-item">Product Detail</span>
            <span class="breadcrumb-item"><?= htmlspecialchars($categoryName) ?></span>
        </nav>
    </div>
</section>
<!-- banner finish  -->

<!-- product detail start  -->
<div class="product-detail-container">

    <div class="product-detail-image">
        <img src="/waggy/public/images/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
    </div>

    <div class="product-detail-info">

        <h1 class="product-detail-name"><?= htmlspecialchars($product['name']) ?></h1>

        <div class="product-detail-stars">
            <?php
            $randomNum = rand(2, 5);
            $star = "";

            for ($i = 1; $i <= $randomNum; $i++) {
                $star .= "★";
            }
            ?>
            <span><?= $star . " " . $randomNum . ".0" ?></span>
        </div>

        <p class="product-detail-price">$<?= number_format($product['price'], 2) ?></p>

        <p class="product-detail-description"><?= htmlspecialchars($product['description']) ?></p>


        <div class="product-detail-quantity">
            <button class="qty-btn" id="qty-minus">−</button>
            <input type="number" id="qty-input" value="1" min="1" max="<?= $product['stock'] ?>" readonly>
            <button class="qty-btn" id="qty-plus">+</button>
        </div>

        <button class="btn-add-to-cart btn-cart" data-id="<?= htmlspecialchars($product['id']) ?>">
            ADD TO CART
        </button>
        <a href="/waggy/shop" class="btn-back-to-shop">Continue Shopping</a>

        <div class="product-detail-meta">
            <p><span>Category:</span> <?= htmlspecialchars($categoryName) ?></p>
        </div>

    </div>

</div>
<!-- product detail finish  -->

<!-- tab panel start -->
<div class="product-tabs-section">

    <div class="product-tabs-sidebar">
        <button class="tab-btn active" data-tab="description">Description</button>
        <button class="tab-btn" data-tab="additional">Additional Information</button>
        <button class="tab-btn" data-tab="reviews">Customer Reviews</button>
    </div>

    <div class="product-tabs-content">

        <div class="tab-panel active" id="description">
            <h2>Product Description</h2>
            <p><?= htmlspecialchars($product['description']) ?></p>
            <ul>
                <li>Made from high-quality, pet-safe materials</li>
                <li>Designed for comfort and durability</li>
                <li>Easy to clean and maintain</li>
            </ul>
            <p>Our products are crafted with your pet's wellbeing in mind, ensuring every item meets the highest standards of quality and safety.</p>
        </div>

        <div class="tab-panel" id="additional">
            <h2>How To Use The Product</h2>
            <p>This product is designed to be simple and intuitive to use. Follow the instructions below to get the best experience for your pet. Always supervise your pet when using new products for the first time to ensure their comfort and safety.</p>
            <p>Store in a cool, dry place away from direct sunlight. Clean regularly according to the care instructions provided. If your pet shows any signs of discomfort, discontinue use immediately.</p>
        </div>

        <div class="tab-panel" id="reviews">
            <div class="reviews-grid">

                <div class="review-card">
                    <div class="review-header">
                        <div class="review-avatar">T</div>
                        <div>
                            <p class="review-name">Tina Johnson</p>
                            <p class="review-date">03/07/2023</p>
                        </div>
                    </div>
                    <div class="review-stars">★★★☆☆ <span>(3.5)</span></div>
                    <p class="review-text">Great product overall! My dog loves it and the quality is really good for the price. Would definitely recommend to other pet owners.</p>
                </div>

                <div class="review-card">
                    <div class="review-header">
                        <div class="review-avatar">J</div>
                        <div>
                            <p class="review-name">Jenny Willis</p>
                            <p class="review-date">03/06/2022</p>
                        </div>
                    </div>
                    <div class="review-stars">★★★☆☆ <span>(3.5)</span></div>
                    <p class="review-text">My cat seems very happy with this. Shipping was fast and the packaging was secure. Will be ordering again soon!</p>
                </div>

            </div>
        </div>

    </div>

</div>
<!-- tab panel finish -->

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

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>