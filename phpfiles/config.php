<?php
/**
 * config.php
 * Shared settings. Every page loads this file first.
 */

date_default_timezone_set('Asia/Manila');

// Start the session once (used to remember who is logged in).
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax']);
    session_start();
}

define('SITE_NAME', 'EBRGY');
define('BARANGAY_NAME', 'Barangay Pinagkawitan');

// Registered users are stored here (created automatically on first registration).
define('USERS_FILE', __DIR__ . '/../data/users.json');
