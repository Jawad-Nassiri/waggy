<?php
$pageStyles = 'auth';

require_once __DIR__ . '/../layouts/header.php';

?>
<!-- banner start  -->
<section id="banner">
    <div class="container">
        <h2 class="title">Edit User</h2>
        <nav class="breadcrumb">
            <span class="breadcrumb-item">Admin</span>
            <span class="breadcrumb-item">Pages</span>
            <span class="breadcrumb-item">Edit User</span>
        </nav>
    </div>
</section>
<!-- banner finish  -->

<div class="auth-container">

    <form action="/waggy/admin/users/updateUser/<?= $user['id'] ?>" method="POST" class="auth-form">

        <div class="auth-section-line"></div>

        <div class="form-group">
            <input type="text" name="name" placeholder="Your Full Name" value="<?= htmlspecialchars($user['name']) ?>">
        </div>

        <div class="form-group">
            <input type="email" name="email" placeholder="Your Email Address"
                value="<?= htmlspecialchars($user['email']) ?>">
        </div>

        <div class="form-group select-box">
            <select name="role">
                <option value="user" <?= $user['role'] === "user" ? "selected" : "" ?>>User</option>
                <option value="admin" <?= $user['role'] === "admin" ? "selected" : "" ?>>Admin</option>
            </select>
        </div>

        <div class="form-group">
            <input type="text" value="********" readonly>
        </div>

        <button type="submit" class="btn-submit">UPDATE USER</button>

    </form>

</div>