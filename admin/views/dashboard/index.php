<?php
$pageStyles = 'admin';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="admin-wrap">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <h2>Waggy</h2>
            <span>Admin Panel</span>
        </div>
        <nav class="sidebar-nav">
            <a href="/waggy/admin/dashboard" class="nav-item active">
                <i class="fa-solid fa-gauge"></i>
                <span>Dashboard</span>
            </a>
            <a href="/waggy/admin/products" class="nav-item">
                <i class="fa-solid fa-box"></i>
                <span>Products</span>
            </a>
            <a href="/waggy/admin/orders" class="nav-item">
                <i class="fa-solid fa-bag-shopping"></i>
                <span>Orders</span>
            </a>
            <a href="/waggy/admin/users" class="nav-item">
                <i class="fa-solid fa-users"></i>
                <span>Users</span>
            </a>
        </nav>
        <a href="/waggy/admin/auth/logout" class="sidebar-logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>
    </aside>

    <!-- Main -->
    <main class="admin-main">
        <!-- Top -->
        <div class="admin-top">
            <h1>Hello, <?= htmlspecialchars($_SESSION['admin']['name']) ?></h1>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card orders">
                <span class="stat-value"><?= $totalOrders ?></span>
                <span class="stat-label">Total Orders</span>
            </div>
            <div class="stat-card users">
                <span class="stat-value"><?= $totalUsers ?></span>
                <span class="stat-label">Total Users</span>
                <button class="view-all users">View All</button>
            </div>
            <div class="stat-card products">
                <span class="stat-value"><?= $totalProducts ?></span>
                <span class="stat-label">Total Products</span>
                <button class="view-all products">View All</button>
            </div>
            <div class="stat-card revenue">
                <span class="stat-value">$<?= number_format($totalRevenue, 2) ?></span>
                <span class="stat-label">Total Revenue</span>
            </div>
        </div>

        <!-- Lists -->
        <div class="admin-lists">
            <!-- Latest Products -->
            <div class="list-card">
                <h3>Latest Products</h3>
                <div class="list-items">
                    <?php foreach ($latestProducts as $product): ?>
                        <div class="list-item">
                            <img src="/waggy/public/images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                            <div class="list-item-info">
                                <p class="list-item-name"><?= htmlspecialchars($product['name']) ?></p>
                                <p class="list-item-sub">$<?= number_format($product['price'], 2) ?></p>
                            </div>
                            <i class="fa-solid fa-circle-check checked"></i>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Latest Users -->
            <div class="list-card">
                <h3>Latest Users</h3>
                <div class="list-items">
                    <?php foreach ($latestUsers as $user): ?>
                        <div class="list-item">
                            <div class="user-avatar"><?= strtoupper($user['name'][0]) ?></div>
                            <div class="list-item-info">
                                <p class="list-item-name"><?= htmlspecialchars($user['name']) ?></p>
                                <p class="list-item-sub"><?= htmlspecialchars($user['email']) ?></p>
                            </div>
                            <i class="fa-solid fa-circle-check checked"></i>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>
</div>