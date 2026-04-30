<?php
$pageStyles = 'blog';
require_once __DIR__ . '/../layouts/header.php';
?>

<!-- banner start  -->
<section id="banner">
    <div class="container">
        <h2 class="title">Blog</h2>
        <nav class="breadcrumb">
            <span class="breadcrumb-item">Home</span>
            <span class="breadcrumb-item">Pages</span>
            <span class="breadcrumb-item">Blog</span>
        </nav>
    </div>
</section>
<!-- banner finish  -->

<!-- blog start  -->
<section class="blog-section">
    <div class="blog-header">
        <h2>Latest Blog Post</h2>
        <a href="#" class="btn-shop">READ ALL →</a>
    </div>

    <div class="blog-grid">
        <div class="blog-card">
            <div class="blog-image1">
                <span class="blog-date"><strong>20</strong> Feb</span>
                <img src="/waggy/public/images/blog/blog1.jpg" alt="Blog 1">
            </div>
            <h3>10 Reasons To Be Helpful Towards Any Animals</h3>
            <p>At the core of our practice is the idea that cities are the incubators of our greatest achievements, and the best hope for a sustainable future.</p>
            <a href="#" class="read-more">READ MORE</a>
        </div>

        <div class="blog-card">
            <div class="blog-image2">
                <span class="blog-date"><strong>21</strong> Feb</span>
                <img src="/waggy/public/images/blog/blog2.jpg" alt="Blog 2">
            </div>
            <h3>How To Know Your Pet Is Hungry</h3>
            <p>At the core of our practice is the idea that cities are the incubators of our greatest achievements, and the best hope for a sustainable future.</p>
            <a href="#" class="read-more">READ MORE</a>
        </div>

        <div class="blog-card">
            <div class="blog-image3">
                <span class="blog-date"><strong>22</strong> Feb</span>
                <img src="/waggy/public/images/blog/blog3.jpg" alt="Blog 3">
            </div>
            <h3>Best Home For Your Pets</h3>
            <p>At the core of our practice is the idea that cities are the incubators of our greatest achievements, and the best hope for a sustainable future.</p>
            <a href="#" class="read-more">READ MORE</a>
        </div>

        <!-- Second row - inverse order -->
        <div class="blog-card">
            <div class="blog-image2">
                <span class="blog-date"><strong>23</strong> Feb</span>
                <img src="/waggy/public/images/blog/blog2.jpg" alt="Blog 4">
            </div>
            <h3>How To Know Your Pet Is Hungry</h3>
            <p>At the core of our practice is the idea that cities are the incubators of our greatest achievements, and the best hope for a sustainable future.</p>
            <a href="#" class="read-more">READ MORE</a>
        </div>

        <div class="blog-card">
            <div class="blog-image3">
                <span class="blog-date"><strong>24</strong> Feb</span>
                <img src="/waggy/public/images/blog/blog3.jpg" alt="Blog 5">
            </div>
            <h3>Best Home For Your Pets</h3>
            <p>At the core of our practice is the idea that cities are the incubators of our greatest achievements, and the best hope for a sustainable future.</p>
            <a href="#" class="read-more">READ MORE</a>
        </div>

        <div class="blog-card">
            <div class="blog-image1">
                <span class="blog-date"><strong>25</strong> Feb</span>
                <img src="/waggy/public/images/blog/blog1.jpg" alt="Blog 6">
            </div>
            <h3>10 Reasons To Be Helpful Towards Any Animals</h3>
            <p>At the core of our practice is the idea that cities are the incubators of our greatest achievements, and the best hope for a sustainable future.</p>
            <a href="#" class="read-more">READ MORE</a>
        </div>
    </div>
</section>
<!-- blog finish  -->

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


<?php 
require_once __DIR__ . '/../layouts/footer.php';

?>