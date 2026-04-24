<?php
$pageStyles = 'auth';
$pageScripts = 'auth';
require_once __DIR__ . '/../layouts/header.php';
?>


<!-- banner start  -->
<section id="banner">
    <div class="container">
        <h2 class="title">Shop</h2>
        <nav class="breadcrumb">
            <span class="breadcrumb-item">Home</span>
            <span class="breadcrumb-item">Pages</span>
            <span class="breadcrumb-item">Register</span>
        </nav>
    </div>
</section>
<!-- banner finish  -->

<div class="auth-container">

    <div class="auth-info">
        <h2>Create Account</h2>
        <p>Join us today and start shopping for your furry friend.</p>

        <div class="auth-info-block">
            <h4>Office</h4>
            <p>730 Glenstone Ave 65802,<br>Springfield, US</p>
            <p>+123 987 321</p>
            <p>contact@waggy.com</p>
        </div>

        <div class="auth-info-block">
            <h4>Management</h4>
            <p>730 Glenstone Ave 65802,<br>Springfield, US</p>
            <p>+123 987 321</p>
            <p>contact@waggy.com</p>
        </div>
    </div>

    <div class="auth-form-section">
        <h2>Get In Touch</h2>
        <p>Fill in the form below to create your account.</p>

        <form action="/waggy/auth/register" method="POST" class="auth-form">

            <div class="form-row">
                <div class="form-group">
                    <input type="text" id="name" name="name" placeholder="Write Your Name Here" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">

                    <span class="form-error name"><?= $errors['name'] ?? '' ?></span>

                </div>

                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Write Your Email Here" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                    <span class="form-error email"><?= $errors['email'] ?? '' ?></span>
                </div>
            </div>

            <div class="form-group password-group">
                <input type="password" name="password" id="password" placeholder="Write Your Password Here">
                <i class="fa-solid fa-eye-slash" id="eye-icon" data-target="password"></i>
                <span class="form-error password"><?= $errors['password'] ?? '' ?></span>
            </div>

            <div class="form-group password-group">
                <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Your Password Here">
                <i class="fa-solid fa-eye-slash" id="eye-icon" data-target="confirm-password"></i>
                <span class="form-error confirm-password"><?= $errors['confirm-password'] ?? '' ?></span>
            </div>

            <button type="submit" class="btn-submit">REGISTER</button>

            <p class="auth-switch">Already have an account? <a href="/waggy/auth/login">Sign In</a></p>

        </form>
    </div>

</div>


<?php
require_once __DIR__ . '/../layouts/footer.php';
?>