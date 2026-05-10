<?php

$pageStyles = 'products';
require_once __DIR__ . '/../layouts/header.php';
?>

<aside class="sidebar">
    <div class="sidebar-logo">
        <h2>Waggy</h2>
        <span>Admin Panel</span>
    </div>

    <nav class="sidebar-nav">
        <a href="/waggy/admin/dashboard" class="nav-item">
            <i class="fa-solid fa-gauge"></i>
            <span>Dashboard</span>
        </a>

        <a href="/waggy/admin/products" class="nav-item active">
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

<div class="products-table">

    <div class="table-header">
        <span>ID</span>
        <span>Image</span>
        <span>Name</span>
        <span>Description</span>
        <span>Price</span>
        <span>Stock</span>
        <span>Created At</span>
        <span>Actions</span>
    </div>

    <?php foreach ($products as $product): ?>
        <div class="table-row">

            <span><?= $product['id']; ?></span>

            <span>
                <img src="/waggy/public/images/<?= $product['image']; ?>" alt="<?= htmlspecialchars($product['name']); ?>">
            </span>

            <span><?= htmlspecialchars($product['name']); ?></span>

            <span class="description"><?= htmlspecialchars($product['description']); ?></span>

            <span>$<?= number_format($product['price'], 2); ?></span>

            <span><?= $product['stock']; ?></span>

            <span><?= date('d/m/Y', strtotime($product['created_at'])); ?></span>

            <div class="actions">
                <button class="edit-btn">Edit</button>

                <button class="delete-btn">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>

        </div>
    <?php endforeach; ?>

</div>