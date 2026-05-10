<?php

$pageStyles = 'users';
$pageScripts = 'users';
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

        <a href="/waggy/admin/products" class="nav-item">
            <i class="fa-solid fa-box"></i>
            <span>Products</span>
        </a>

        <a href="/waggy/admin/orders" class="nav-item">
            <i class="fa-solid fa-bag-shopping"></i>
            <span>Orders</span>
        </a>

        <a href="/waggy/admin/users" class="nav-item active">
            <i class="fa-solid fa-users"></i>
            <span>Users</span>
        </a>
    </nav>

    <a href="/waggy/admin/auth/logout" class="sidebar-logout">
        <i class="fa-solid fa-right-from-bracket"></i>
        <span>Logout</span>
    </a>
</aside>

<div class="users-table">

    <div class="table-header">
        <span>ID</span>
        <span>Name</span>
        <span>Email</span>
        <span>Role</span>
        <span>Created At</span>
        <span>Actions</span>
    </div>

    <?php foreach ($users as $user): ?>
        <div class="table-row">

            <span><?= $user['id']; ?></span>

            <span><?= htmlspecialchars($user['name']); ?></span>

            <span><?= htmlspecialchars($user['email']); ?></span>

            <span><?= htmlspecialchars($user['role']); ?></span>

            <span><?= date('d/m/Y', strtotime($user['created_at'])); ?></span>

            <div class="actions">
                <button class="edit-btn">Edit</button>

                <button class="delete-btn" data-id=<?= $user['id'] ?>>
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>

        </div>
    <?php endforeach; ?>

</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>