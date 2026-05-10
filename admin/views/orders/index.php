<?php

$pageStyles = 'orders';
require_once __DIR__ . '/../layouts/header.php';
?>

<!-- Sidebar -->
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
        <a href="/waggy/admin/products" class="nav-item">
            <i class="fa-solid fa-box"></i>
            <span>Products</span>
        </a>
        <a href="/waggy/admin/orders" class="nav-item active">
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

<div class="orders-table">

    <div class="table-header">
        <span>ID</span>
        <span>User</span>
        <span>Total</span>
        <span>Created At</span>
        <span>Actions</span>
    </div>

    <?php foreach ($orders as $order): ?>
        <div class="table-row">

            <span><?= $order['id']; ?></span>

            <span><?= htmlspecialchars($order['user']['name']); ?></span>

            <span>$<?= number_format($order['total'], 2); ?></span>

            <span><?= date('d/m/Y', strtotime($order['created_at'])); ?></span>

            <div class="actions">
                <button class="edit-btn">View</button>

                <button class="delete-btn">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>

        </div>
    <?php endforeach; ?>

</div>