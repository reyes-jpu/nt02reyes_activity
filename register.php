<?php
require_once __DIR__ . '/phpfiles/config.php';
require_once __DIR__ . '/phpfiles/functions.php';
require_once __DIR__ . '/phpfiles/validation.php';

redirect_if_logged_in();

$errors = [];
$old    = ['fullname' => '', 'username' => '', 'email' => '', 'mobile' => ''];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    
    $old['fullname'] = clean_input(post_value('fullname'));
    $old['username'] = trim(post_value('username'));
    $old['email']    = (string) filter_var(trim(post_value('email')), FILTER_SANITIZE_EMAIL);
    $old['mobile']   = normalize_mobile(post_value('mobile'));
    $password        = post_value('password');
    $confirm         = post_value('confirm_password');

    if (!csrf_valid()) {
        $errors['form'] = 'Your session expired. Please try again.';
    } else {
        
        $errors = validate_registration($old, $password, $confirm);

       
        if (empty($errors)) {
            $users = load_users();

            if (find_user($users, 'username', $old['username']) !== null) {
                $errors['username'] = 'That username is already taken.';
            }
            if (find_user($users, 'email', $old['email']) !== null) {
                $errors['email'] = 'That email is already registered.';
            }
        }

        
        if (empty($errors)) {
            $users[] = [
                'fullname'      => $old['fullname'],
                'username'      => $old['username'],
                'email'         => $old['email'],
                'mobile'        => $old['mobile'],
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                'created_at'    => date('Y-m-d H:i:s'),
            ];

            if (save_users($users)) {
                redirect('login.php?registered=1');
            }
            $errors['form'] = 'Could not save your account. Make sure the "data" folder is writable.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>EBRGY | Registration</title>

    <link rel="stylesheet" href="static/register.css">
    <link rel="stylesheet" href="static/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>

    <div class="container active is-register" id="container">
        <div class="form-box register">
            <form id="registerForm" method="post" action="register.php" novalidate>
                <h1>Registration</h1>

                <?= csrf_field() ?>

                <?php if (isset($errors['form'])): ?>
                    <div class="form-alert error"><?= e($errors['form']) ?></div>
                <?php endif; ?>

                <div class="input-box">
                    <input type="text" id="registerFullname" name="fullname" placeholder="Full Name"
                           value="<?= e($old['fullname']) ?>" autocomplete="name"
                           class="<?= isset($errors['fullname']) ? 'input-error' : '' ?>">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <?php if (isset($errors['fullname'])): ?>
                    <small class="field-error"><?= e($errors['fullname']) ?></small>
                <?php endif; ?>

                <div class="input-box">
                    <input type="text" id="registerUsername" name="username" placeholder="Username"
                           value="<?= e($old['username']) ?>" autocomplete="username"
                           class="<?= isset($errors['username']) ? 'input-error' : '' ?>">
                    <i class="fa-solid fa-user"></i>
                </div>
                <?php if (isset($errors['username'])): ?>
                    <small class="field-error"><?= e($errors['username']) ?></small>
                <?php else: ?>
                    <small class="field-hint">5-20 characters: letters, numbers, underscore</small>
                <?php endif; ?>

                <div class="input-box">
                    <input type="email" id="registerEmail" name="email" placeholder="Email"
                           value="<?= e($old['email']) ?>" autocomplete="email"
                           class="<?= isset($errors['email']) ? 'input-error' : '' ?>">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <?php if (isset($errors['email'])): ?>
                    <small class="field-error"><?= e($errors['email']) ?></small>
                <?php endif; ?>

                <div class="input-box">
                    <input type="text" id="registerMobile" name="mobile" placeholder="Mobile (09XXXXXXXXX)"
                           value="<?= e($old['mobile']) ?>" autocomplete="tel"
                           class="<?= isset($errors['mobile']) ? 'input-error' : '' ?>">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <?php if (isset($errors['mobile'])): ?>
                    <small class="field-error"><?= e($errors['mobile']) ?></small>
                <?php endif; ?>

                <div class="input-box">
                    <input type="password" id="registerPassword" name="password" placeholder="Password"
                           autocomplete="new-password"
                           class="<?= isset($errors['password']) ? 'input-error' : '' ?>">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <?php if (isset($errors['password'])): ?>
                    <small class="field-error"><?= e($errors['password']) ?></small>
                <?php else: ?>
                    <small class="field-hint">8-15 characters with upper, lower, number &amp; symbol</small>
                <?php endif; ?>

                <div class="input-box">
                    <input type="password" id="registerConfirm" name="confirm_password" placeholder="Confirm Password"
                           autocomplete="new-password"
                           class="<?= isset($errors['confirm_password']) ? 'input-error' : '' ?>">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <?php if (isset($errors['confirm_password'])): ?>
                    <small class="field-error"><?= e($errors['confirm_password']) ?></small>
                <?php endif; ?>

                <button type="submit" name="submit" value="register" class="btn">Register</button>
            </form>
        </div>

        <div class="toggle-box">

            <div class="toggle-panel toggle-left">
                <h1>Hello, Welcome!</h1>
                <p>Don't have an account?</p>
                <button type="button" class="btn register-btn">Register</button>
            </div>

            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>Already have an account?</p>
                <button type="button" class="btn login-btn">Login</button>
            </div>

        </div>

    </div>

    <script src="static/register.js"></script>

</body>
</html>
