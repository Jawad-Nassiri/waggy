<?php
$cartCount = $_SESSION['cartCount'] ?? 0;
?>

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
                <li><a href="/waggy/home">Home</a></li>
                <li><a href="/waggy/shop">Shop</a></li>
                <li><a href="/waggy/blog">Blog</a></li>
                <li><a href="/waggy/faq">FAQ</a></li>
            </ul>
            <div class="nav-icons">
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="#" class="user" id="user-icon">
                        <i class="fa-solid fa-user"></i>
                    </a>
                    <div class="user-data" id="user-data">
                        <span class="username"><?= $_SESSION['user']['name'] ?></span>
                        <a href="/waggy/auth/logout" class="logout">Logout</a>
                        <!-- <span class="username"></span> -->
                    </div>
                <?php else: ?>
                    <a href="/waggy/auth/login" class="user" id="user-icon">
                        <i class="fa-solid fa-user"></i>
                    </a>
                <?php endif; ?>


                <div class="cart-wrap">
                    <a href="/waggy/cart" class="cart-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                    <?php if ($cartCount !== 0): ?>
                        <span class="cart-count"><?= $cartCount ?></span>
                    <?php endif; ?>
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