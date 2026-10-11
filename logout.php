<?php
require_once __DIR__ . '/phpfiles/config.php';
require_once __DIR__ . '/phpfiles/functions.php';

// Clear the session data and the session cookie.
$_SESSION = [];

if (ini_get('session.use_cookies')) {
    $p = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
}

session_destroy();

redirect('login.php?loggedout=1');
