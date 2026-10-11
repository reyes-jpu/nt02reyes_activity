<?php
/**
 * functions.php
 * Small helper functions shared by login, register and the dashboard.
 */

/* ---------- Output / input helpers ---------- */

// Escape a value before printing it in HTML (prevents XSS).
function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

// Safely read a POST field. Returns '' if it is missing or not a plain string.
function post_value(string $key): string
{
    return (isset($_POST[$key]) && is_string($_POST[$key])) ? $_POST[$key] : '';
}

// Sanitize free text: trim and collapse repeated whitespace.
function clean_input(string $value): string
{
    return trim(preg_replace('/\s+/u', ' ', $value) ?? '');
}

/* ---------- CSRF protection for forms ---------- */

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function csrf_valid(): bool
{
    return isset($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], post_value('csrf_token'));
}

/* ---------- Login state ---------- */

function redirect(string $to): void
{
    header('Location: ' . $to);
    exit;
}

function is_logged_in(): bool
{
    return !empty($_SESSION['user']);
}

function current_user(): array
{
    return $_SESSION['user'] ?? [];
}

function require_login(): void
{
    if (!is_logged_in()) {
        redirect('login.php?login_required=1');
    }
}

function redirect_if_logged_in(): void
{
    if (is_logged_in()) {
        redirect('index.php');
    }
}

/* ---------- Display helpers ---------- */

function first_name(string $fullName): string
{
    $parts = explode(' ', trim($fullName));
    return $parts[0] ?? '';
}

function greeting(): string
{
    $hour = (int) date('G');
    if ($hour < 12) {
        return 'Good Morning';
    }
    return ($hour < 18) ? 'Good Afternoon' : 'Good Evening';
}

/* ---------- Tiny JSON "database" for users ---------- */

function load_users(): array
{
    if (!file_exists(USERS_FILE)) {
        return [];
    }
    $data = json_decode((string) file_get_contents(USERS_FILE), true);
    return is_array($data) ? $data : [];
}

function save_users(array $users): bool
{
    $dir = dirname(USERS_FILE);
    if (!is_dir($dir) && !mkdir($dir, 0755, true)) {
        return false;
    }
    $json = json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return file_put_contents(USERS_FILE, $json, LOCK_EX) !== false;
}

// Find a user by 'username' or 'email' (case-insensitive). Returns null if none.
function find_user(array $users, string $field, string $value): ?array
{
    foreach ($users as $user) {
        if (isset($user[$field]) && strcasecmp($user[$field], $value) === 0) {
            return $user;
        }
    }
    return null;
}
