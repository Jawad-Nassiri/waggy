<?php
$pageStyles = 'auth';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="auth-container">

    <div class="auth-tabs">
        <span class="auth-tab active">ADMIN LOGIN</span>
    </div>

    <form action="/waggy/admin/auth/login" method="POST" class="auth-form" id="admin-login">

        <div class="form-group">
            <input type="email" name="email" id="email" placeholder="Admin Email"
                value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
            <span class="form-error email"><?= $errors['email'] ?? '' ?></span>
        </div>

        <div class="form-group password-group">
            <input type="password" name="password" id="password" placeholder="Admin Password">
            <i class="fa-solid fa-eye-slash" id="eye-icon" data-target="password"></i>
            <span class="form-error password"><?= $errors['password'] ?? '' ?></span>
        </div>

        <?php if (!empty($errors['login'])): ?>
            <span class="form-error"><?= $errors['login'] ?></span>
        <?php endif; ?>

        <button type="submit" class="btn-submit">LOG IN</button>

    </form>

</div>

<script src="/waggy/public/js/auth.js"></script>