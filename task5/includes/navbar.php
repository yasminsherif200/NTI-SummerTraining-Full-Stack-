<?php
// includes/navbar.php
// Site name on the left, 3 links on the right (home - all products - account),
// plus a logout link that only shows once the user is logged in.
$current = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="index.php">ShopEasy</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="mainNav">
        <ul class="navbar-nav">
            <li class="nav-item <?php echo $current === 'index.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item <?php echo $current === 'all_products.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="all_products.php">All Products</a>
            </li>
            <li class="nav-item <?php echo $current === 'account.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="account.php">Account</a>
            </li>
            <?php if (isLoggedIn()): ?>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
