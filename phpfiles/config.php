<?php

date_default_timezone_set('Asia/Manila');

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax']);
    session_start();
}

define('SITE_NAME', 'EBRGY');
define('BARANGAY_NAME', 'Barangay Pinagkawitan');

define('USERS_FILE', __DIR__ . '/../data/users.json');
