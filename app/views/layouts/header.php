<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Shop</title>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <link rel="stylesheet" href="/waggy/public/css/main.css" />

    <?php if (isset($pageStyles)): ?>
        <link rel="stylesheet" href="/waggy/public/css/<?= $pageStyles ?>.css" />
    <?php endif; ?>

</head>

<body>
    <!-- header start  -->
    <header class="top-header">
        <div class="header-container">
            <div class="logo">
                <img src="/waggy/public/images/logo.png" alt="Logo">
            </div>
            <div class="search-bar">
                <input
                    type="text"
                    placeholder="Search For More Than 10,000 Products" />
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="header-contact">
                <div>
                    <span>Phone</span>
                    <span class="strong">+980-34984089</span>
                </div>
                <div>
                    <span>Email</span>
                    <span class="strong">Waggy@Gmail.Com</span>
                </div>
            </div>
        </div>
    </header>
    <!-- header finish  -->

    <!-- nav start  -->
    <nav class="main-nav">
        <div class="nav-container">
            <ul class="nav-links">
                <li><a href="#" class="active">Home</a></li>
                <li><a href="#">Shop</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <div class="nav-icons">
                <i class="fa-solid fa-user"></i>

                <div class="cart-wrap">
                    <a href="#" class="cart-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                    <span class="cart-count">3</span>
                </div>
            </div>
        </div>
    </nav>
    <!-- nav finish  -->

<?php if (isset($_SESSION['toast'])): ?>
    <script>
        window.toastData = <?= json_encode($_SESSION['toast']) ?>;
    </script>
    <?php unset($_SESSION['toast']); ?>
<?php endif; ?>