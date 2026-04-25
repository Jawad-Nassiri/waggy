<?php
$pageStyles = 'auth';
$pageScripts = 'auth';
require_once __DIR__ . '/../layouts/header.php';
?>


<!-- banner start  -->
<section id="banner">
    <div class="container">
        <h2 class="title">Register</h2>
        <nav class="breadcrumb">
            <span class="breadcrumb-item">Home</span>
            <span class="breadcrumb-item">Pages</span>
            <span class="breadcrumb-item">Register</span>
        </nav>
    </div>
</section>
<!-- banner finish  -->

<div class="auth-container">

    <div class="auth-tabs">
        <a href="/waggy/auth/login" class="auth-tab">LOG IN</a>
        <a href="/waggy/auth/register" class="auth-tab active">SIGN UP</a>
    </div>

    <div class="auth-divider"></div>

    <form action="/waggy/auth/register" method="POST" class="auth-form" id="auth-form">

        <div class="auth-section-line"></div>

        <div class="form-group">
            <input type="text" id="name" name="name" placeholder="Your Full Name" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">
            <span class="form-error name"><?= $errors['name'] ?? '' ?></span>
        </div>

        <div class="form-group">
            <input type="email" id="email" name="email" placeholder="Your Email Address" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
            <span class="form-error email"><?= $errors['email'] ?? '' ?></span>
        </div>

        <div class="form-group password-group">
            <input type="password" name="password" id="password" placeholder="Set Your Password">
            <i class="fa-solid fa-eye-slash" id="eye-icon" data-target="password"></i>
            <span class="form-error password"><?= $errors['password'] ?? '' ?></span>
        </div>

        <div class="form-group password-group">
            <input type="password" name="confirm-password" id="confirm-password" placeholder="Retype Your Password">
            <i class="fa-solid fa-eye-slash" id="eye-icon" data-target="confirm-password"></i>
            <span class="form-error confirm-password"><?= $errors['confirm-password'] ?? '' ?></span>
        </div>

        <button type="submit" class="btn-submit">SIGN UP</button>

    </form>

</div>


<?php
require_once __DIR__ . '/../layouts/footer.php';
?>