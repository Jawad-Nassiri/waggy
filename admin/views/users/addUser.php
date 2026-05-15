<?php

$pageStyles = "auth";
$pageScripts = 'users';
require_once __DIR__ . '/../layouts/header.php';

?>

<!-- banner start  -->
<section id="banner">
    <div class="container">
        <h2 class="title">Add User</h2>
        <nav class="breadcrumb">
            <span class="breadcrumb-item">Admin</span>
            <span class="breadcrumb-item">Pages</span>
            <span class="breadcrumb-item">Add User</span>
        </nav>
    </div>
</section>
<!-- banner finish  -->


<div class="auth-container">

    <div class="auth-tabs">
        <a href="/waggy/admin/users" class="auth-tab active">ADD USER</a>
    </div>

    <div class="auth-divider"></div>

    <form action="/waggy/admin/users/addUser" id="add-user-form" method="POST" class="auth-form">

        <div class="form-group">
            <input type="text" name="name" placeholder="Full Name">
            <span class="form-error name"><?= $errors['name'] ?? '' ?></span>
        </div>

        <div class="form-group">
            <input type="email" name="email" placeholder="Email Address">
            <span class="form-error email"><?= $errors['email'] ?? '' ?></span>
        </div>

        <div class="form-group password-group">
            <input type="password" name="password" id="password" placeholder="Password">
            <i class="fa-solid fa-eye-slash" id="eye-icon" data-target="password"></i>
            <span class="form-error password"><?= $errors['password'] ?? '' ?></span>
        </div>

        <div class="form-group select-box">
            <select name="role">
                <option value="user" <?= isset($user['role']) && $user['role'] === "user" ? "selected" : "" ?>>User
                </option>
                <option value="admin" <?= isset($user['role']) && $user['role'] === "admin" ? "selected" : "" ?>>Admin
                </option>
            </select>
            <span class="form-error"><?= $errors['role'] ?? '' ?></span>
        </div>

        <button type="submit" class="btn-submit">ADD USER</button>

    </form>

</div>

<?php if (isset($_SESSION['toast'])): ?>
    <script>
        window.toastData = <?= json_encode($_SESSION['toast']); ?>;
    </script>
    <?php unset($_SESSION['toast']); ?>
<?php endif; ?>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>