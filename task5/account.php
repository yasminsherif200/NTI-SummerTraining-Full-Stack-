<?php
require_once 'includes/config.php';

$errors = [];
$old = []; // keeps whatever the user typed, so the form isn't wiped on error

/* ------------------------------------------------------------------
 * CASE 1: user is not logged in yet -> simple email/password form
 * ------------------------------------------------------------------ */
if (!isLoggedIn()) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_submit'])) {

        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $old      = ['email' => $email];

        if ($email === '') {
            $errors['email'] = 'Email is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address.';
        }

        if ($password === '') {
            $errors['password'] = 'Password is required.';
        } elseif (strlen($password) < 6) {
            $errors['password'] = 'Password must be at least 6 characters long.';
        }

        if (empty($errors)) {
            // All good: store the data in the session and move the user on
            $_SESSION['logged_in'] = true;
            $_SESSION['email']     = $email;
            header('Location: all_products.php');
            exit;
        }
    }
}

/* ------------------------------------------------------------------
 * CASE 2: user is logged in but hasn't completed their profile yet
 * ------------------------------------------------------------------ */
elseif (!hasProfile()) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['profile_submit'])) {

        $username  = trim($_POST['username'] ?? '');
        $password  = trim($_POST['password'] ?? '');
        $email     = trim($_POST['email'] ?? '');
        $phone     = trim($_POST['phone'] ?? '');
        $facebook  = trim($_POST['facebook'] ?? '');
        $twitter   = trim($_POST['twitter'] ?? '');
        $instagram = trim($_POST['instagram'] ?? '');

        $old = compact('username', 'email', 'phone', 'facebook', 'twitter', 'instagram');

        // 1. username
        if ($username === '') {
            $errors['username'] = 'Username is required.';
        } elseif (strlen($username) < 3) {
            $errors['username'] = 'Username must be at least 3 characters long.';
        }

        // 2. password
        if ($password === '') {
            $errors['password'] = 'Password is required.';
        } elseif (strlen($password) < 6) {
            $errors['password'] = 'Password must be at least 6 characters long.';
        }

        // 3. email
        if ($email === '') {
            $errors['email'] = 'Email is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address.';
        }

        // 4. phone number (Egyptian mobile format: 01 + 0/1/2/5 + 8 digits)
        if ($phone === '') {
            $errors['phone'] = 'Phone number is required.';
        } elseif (!preg_match('/^01[0125][0-9]{8}$/', $phone)) {
            $errors['phone'] = 'Enter a valid phone number (e.g. 01012345678).';
        }

        // 5. facebook url
        if ($facebook === '') {
            $errors['facebook'] = 'Facebook account URL is required.';
        } elseif (!filter_var($facebook, FILTER_VALIDATE_URL) || stripos($facebook, 'facebook.com') === false) {
            $errors['facebook'] = 'Enter a valid Facebook URL (e.g. https://facebook.com/yourname).';
        }

        // 6. twitter url
        if ($twitter === '') {
            $errors['twitter'] = 'Twitter (X) account URL is required.';
        } elseif (!filter_var($twitter, FILTER_VALIDATE_URL) || (stripos($twitter, 'twitter.com') === false && stripos($twitter, 'x.com') === false)) {
            $errors['twitter'] = 'Enter a valid Twitter/X URL (e.g. https://twitter.com/yourname).';
        }

        // 7. instagram url
        if ($instagram === '') {
            $errors['instagram'] = 'Instagram account URL is required.';
        } elseif (!filter_var($instagram, FILTER_VALIDATE_URL) || stripos($instagram, 'instagram.com') === false) {
            $errors['instagram'] = 'Enter a valid Instagram URL (e.g. https://instagram.com/yourname).';
        }

        if (empty($errors)) {
            $_SESSION['username']           = $username;
            $_SESSION['profile_password']   = $password; // in real life: password_hash()
            $_SESSION['profile_email']      = $email;
            $_SESSION['phone']              = $phone;
            $_SESSION['facebook']           = $facebook;
            $_SESSION['twitter']            = $twitter;
            $_SESSION['instagram']          = $instagram;
            $_SESSION['profile_completed']  = true;

            header('Location: index.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ShopEasy - Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php require_once 'includes/navbar.php'; ?>

<div class="container">

<?php if (!isLoggedIn()): ?>

    <!-- CASE 1: login form -->
    <div class="form-wrapper">
        <h2 class="mb-4 text-center">Sign In</h2>

        <form method="POST" action="account.php" novalidate>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email"
                       class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>"
                       value="<?php echo h($old['email'] ?? ''); ?>">
                <?php if (isset($errors['email'])): ?>
                    <div class="invalid-feedback"><?php echo h($errors['email']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password"
                       class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>">
                <?php if (isset($errors['password'])): ?>
                    <div class="invalid-feedback"><?php echo h($errors['password']); ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" name="login_submit" class="btn btn-dark btn-block">Sign In</button>
        </form>
    </div>

<?php elseif (!hasProfile()): ?>

    <!-- CASE 2: extended profile form -->
    <div class="form-wrapper" style="max-width:600px;">
        <h2 class="mb-4 text-center">Complete Your Profile</h2>

        <form method="POST" action="account.php" novalidate>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username"
                       class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>"
                       value="<?php echo h($old['username'] ?? ''); ?>">
                <?php if (isset($errors['username'])): ?>
                    <div class="invalid-feedback"><?php echo h($errors['username']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password"
                       class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>">
                <?php if (isset($errors['password'])): ?>
                    <div class="invalid-feedback"><?php echo h($errors['password']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email"
                       class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>"
                       value="<?php echo h($old['email'] ?? ''); ?>">
                <?php if (isset($errors['email'])): ?>
                    <div class="invalid-feedback"><?php echo h($errors['email']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone"
                       class="form-control <?php echo isset($errors['phone']) ? 'is-invalid' : ''; ?>"
                       value="<?php echo h($old['phone'] ?? ''); ?>">
                <?php if (isset($errors['phone'])): ?>
                    <div class="invalid-feedback"><?php echo h($errors['phone']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="facebook">Facebook Account URL</label>
                <input type="text" name="facebook" id="facebook"
                       class="form-control <?php echo isset($errors['facebook']) ? 'is-invalid' : ''; ?>"
                       value="<?php echo h($old['facebook'] ?? ''); ?>">
                <?php if (isset($errors['facebook'])): ?>
                    <div class="invalid-feedback"><?php echo h($errors['facebook']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="twitter">Twitter (X) Account URL</label>
                <input type="text" name="twitter" id="twitter"
                       class="form-control <?php echo isset($errors['twitter']) ? 'is-invalid' : ''; ?>"
                       value="<?php echo h($old['twitter'] ?? ''); ?>">
                <?php if (isset($errors['twitter'])): ?>
                    <div class="invalid-feedback"><?php echo h($errors['twitter']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="instagram">Instagram Account URL</label>
                <input type="text" name="instagram" id="instagram"
                       class="form-control <?php echo isset($errors['instagram']) ? 'is-invalid' : ''; ?>"
                       value="<?php echo h($old['instagram'] ?? ''); ?>">
                <?php if (isset($errors['instagram'])): ?>
                    <div class="invalid-feedback"><?php echo h($errors['instagram']); ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" name="profile_submit" class="btn btn-dark btn-block">Save Profile</button>
        </form>
    </div>

<?php else: ?>

    <!-- User is logged in AND profile is already complete -->
    <div class="form-wrapper text-center">
        <h2 class="mb-3">Welcome back, <?php echo h($_SESSION['username'] ?? $_SESSION['email'] ?? ''); ?>!</h2>
        <p>Your account is all set up.</p>
        <ul class="list-group text-left mb-4">
            <li class="list-group-item"><strong>Email:</strong> <?php echo h($_SESSION['profile_email'] ?? $_SESSION['email'] ?? ''); ?></li>
            <li class="list-group-item"><strong>Phone:</strong> <?php echo h($_SESSION['phone'] ?? ''); ?></li>
            <li class="list-group-item"><strong>Facebook:</strong> <?php echo h($_SESSION['facebook'] ?? ''); ?></li>
            <li class="list-group-item"><strong>Twitter:</strong> <?php echo h($_SESSION['twitter'] ?? ''); ?></li>
            <li class="list-group-item"><strong>Instagram:</strong> <?php echo h($_SESSION['instagram'] ?? ''); ?></li>
        </ul>
        <a href="logout.php" class="btn btn-outline-dark">Logout</a>
    </div>

<?php endif; ?>

</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
