<?php
$pageStyles = 'auth';
$pageScripts = 'auth';
require_once __DIR__ . '/../layouts/header.php';
?>

<!-- banner start  -->
<section id="banner">
    <div class="container">
        <h2 class="title">Login</h2>
        <nav class="breadcrumb">
            <span class="breadcrumb-item">Home</span>
            <span class="breadcrumb-item">Pages</span>
            <span class="breadcrumb-item">Login</span>
        </nav>
    </div>
</section>
<!-- banner finish  -->

<div class="auth-container">

    <div class="auth-tabs">
        <a href="/waggy/auth/login" class="auth-tab active">LOG IN</a>
        <a href="/waggy/auth/register" class="auth-tab">SIGN UP</a>
    </div>


    <form action="/waggy/auth/login" method="POST" class="auth-form" id="login-form">

        <div class="form-group">
            <input type="email" id="email" name="email" placeholder="Your Email Address" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
            <span class="form-error email"><?= $errors['email'] ?? '' ?></span>
        </div>

        <div class="form-group password-group">
            <input type="password" name="password" id="password" placeholder="Your Password">
            <i class="fa-solid fa-eye-slash" id ="eye-icon" data-target="password"></i>
            <span class="form-error password"><?= $errors['password'] ?? '' ?></span>
        </div>

        <?php if (!empty($errors['login'])): ?>
            <span class="form-error"><?= $errors['login'] ?></span>
        <?php endif; ?>

        <button type="submit" class="btn-submit">LOG IN</button>

    </form>

</div>

<!-- get toast box data  -->
<?php if (isset($_SESSION['toast'])): ?>
    <script>
        window.toastData = <?= json_encode($_SESSION['toast']) ?>;
    </script>
    <?php unset($_SESSION['toast']); ?>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>