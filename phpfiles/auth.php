<?php
/**
 * auth.php
 * Loads the shared files and blocks the page if the visitor is not logged in.
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';

require_login();

// Current resident (name, username, email) - used by the navigation, hero and header.
$user = current_user();
