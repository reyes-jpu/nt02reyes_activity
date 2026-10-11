<?php
require_once __DIR__ . '/phpfiles/config.php';
require_once __DIR__ . '/phpfiles/functions.php';
require_once __DIR__ . '/phpfiles/validation.php';

redirect_if_logged_in();

$errors   = [];
$username = '';


$notice = '';
if (isset($_GET['registered'])) {
    $notice = 'Registration successful! You can now log in.';
} elseif (isset($_GET['loggedout'])) {
    $notice = 'You have been logged out.';
} elseif (isset($_GET['login_required'])) {
    $notice = 'Please log in to access your dashboard.';
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $username = trim(post_value('username'));
    $password = post_value('password');

    if (!csrf_valid()) {
        $errors['form'] = 'Your session expired. Please try again.';
    } else {
        
        $errors = validate_login($username, $password);

        
        if (empty($errors)) {
            $user = find_user(load_users(), 'username', $username);

            if ($user !== null && password_verify($password, $user['password_hash'])) {
                session_regenerate_id(true);
                $_SESSION['user'] = [
                    'username' => $user['username'],
                    'fullname' => $user['fullname'],
                    'email'    => $user['email'],
                ];
                redirect('index.php');
            }

           
            $errors['form'] = 'Invalid username or password. Please register first if you are new!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>EBRGY | Login</title>

    <link rel="stylesheet" href="static/login.css">
    <link rel="stylesheet" href="static/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>

    <div class="container is-login" id="container">

        <div class="form-box login">
            <form id="loginForm" method="post" action="login.php" novalidate>
                <h1>Login</h1>

                <?= csrf_field() ?>

                <?php if ($notice !== ''): ?>
                    <div class="form-alert success"><?= e($notice) ?></div>
                <?php endif; ?>

                <?php if (isset($errors['form'])): ?>
                    <div class="form-alert error"><?= e($errors['form']) ?></div>
                <?php endif; ?>

                <div class="input-box">
                    <input type="text" id="loginUsername" name="username" placeholder="Username"
                           value="<?= e($username) ?>" autocomplete="username"
                           class="<?= isset($errors['username']) ? 'input-error' : '' ?>">
                    <i class="fa-solid fa-user"></i>
                </div>
                <?php if (isset($errors['username'])): ?>
                    <small class="field-error"><?= e($errors['username']) ?></small>
                <?php endif; ?>

                <div class="input-box">
                    <input type="password" id="loginPassword" name="password" placeholder="Password"
                           autocomplete="current-password"
                           class="<?= isset($errors['password']) ? 'input-error' : '' ?>">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <?php if (isset($errors['password'])): ?>
                    <small class="field-error"><?= e($errors['password']) ?></small>
                <?php endif; ?>

                <div class="forgot-link">
                    <a href="#" id="forgotPassword">Forgot Password?</a>
                </div>

                <button type="submit" name="submit" value="login" class="btn">Login</button>

                <p>or login with social platforms</p>

                <div class="social-icons">
                    <a href="#" aria-label="Google"><i class="fa-brands fa-google"></i></a>
                    <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Hello, Welcome!</h1>
                <p>Don't have an account?</p>
                <button type="button" class="btn register-btn">Register</button>
            </div>
        </div>

    </div>

    <script src="static/login.js"></script>

</body>
</html>
