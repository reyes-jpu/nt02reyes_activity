<?php
/**
 * validation.php
 * Server-side form validation using regular expressions (preg_match)
 * and PHP filters (filter_var).
 *
 * Each validate_*() function returns an error message,
 * or an empty string '' when the value is valid.
 */

/* ---------- Regular expressions ---------- */

// Letters (incl. ñ, accents), spaces, period, hyphen, apostrophe. 2-50 chars, must start with a letter.
const RX_FULLNAME = '/^\p{L}[\p{L} .\'-]{1,49}$/u';

// 5-20 chars. Starts with a letter, then letters, numbers or underscore.
const RX_USERNAME = '/^[A-Za-z][A-Za-z0-9_]{4,19}$/';

// name@domain.tld
const RX_EMAIL = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/';

// Philippine mobile number: 09XXXXXXXXX or +639XXXXXXXXX
const RX_MOBILE = '/^(09|\+639)\d{9}$/';

// Password rules (checked one by one so the message can be specific)
const RX_PW_LENGTH  = '/^.{8,15}$/';
const RX_PW_UPPER   = '/[A-Z]/';
const RX_PW_LOWER   = '/[a-z]/';
const RX_PW_NUMBER  = '/\d/';
const RX_PW_SPECIAL = '/[\W_]/';

/* ---------- Field validators ---------- */

function validate_fullname(string $value): string
{
    if ($value === '') {
        return 'Full name is required.';
    }
    if (!preg_match(RX_FULLNAME, $value)) {
        return 'Use letters, spaces, . - \' only (2-50 characters).';
    }
    return '';
}

function validate_username(string $value): string
{
    if ($value === '') {
        return 'Username is required.';
    }
    if (!preg_match(RX_USERNAME, $value)) {
        return '5-20 characters: start with a letter; letters, numbers, _ only.';
    }
    return '';
}

function validate_email(string $value): string
{
    if ($value === '') {
        return 'Email is required.';
    }
    // filter_var checks the overall format, the regex adds a stricter domain rule.
    if (filter_var($value, FILTER_VALIDATE_EMAIL) === false || !preg_match(RX_EMAIL, $value)) {
        return 'Please enter a valid email address.';
    }
    return '';
}

function validate_mobile(string $value): string
{
    if ($value === '') {
        return 'Mobile number is required.';
    }
    if (!preg_match(RX_MOBILE, $value)) {
        return 'Use a PH number like 09123456789 or +639123456789.';
    }
    return '';
}

function validate_password(string $value): string
{
    if ($value === '') {
        return 'Password is required.';
    }
    if (!preg_match(RX_PW_LENGTH, $value)) {
        return 'Password must be 8 to 15 characters long.';
    }
    if (!preg_match(RX_PW_UPPER, $value)) {
        return 'Password needs at least one uppercase letter.';
    }
    if (!preg_match(RX_PW_LOWER, $value)) {
        return 'Password needs at least one lowercase letter.';
    }
    if (!preg_match(RX_PW_NUMBER, $value)) {
        return 'Password needs at least one number.';
    }
    if (!preg_match(RX_PW_SPECIAL, $value)) {
        return 'Password needs at least one special character (e.g. @ # ! $).';
    }
    return '';
}

function validate_confirm_password(string $password, string $confirm): string
{
    if ($confirm === '') {
        return 'Please confirm your password.';
    }
    if ($password !== $confirm) {
        return 'Passwords do not match.';
    }
    return '';
}

/* ---------- Helpers ---------- */

// Turn "+639123456789" (or "0912 345 6789") into the standard "09123456789".
function normalize_mobile(string $value): string
{
    $value = preg_replace('/[\s-]+/', '', $value) ?? '';
    if (strpos($value, '+63') === 0) {
        $value = '0' . substr($value, 3);
    }
    return $value;
}

/* ---------- Whole-form validators ---------- */

// Returns an array like ['email' => 'message', ...]. Empty array = form is valid.
function validate_registration(array $data, string $password, string $confirm): array
{
    $checks = [
        'fullname' => validate_fullname($data['fullname']),
        'username' => validate_username($data['username']),
        'email'    => validate_email($data['email']),
        'mobile'   => validate_mobile($data['mobile']),
        'password' => validate_password($password),
        'confirm_password' => validate_confirm_password($password, $confirm),
    ];
    return array_filter($checks, fn($message) => $message !== '');
}

function validate_login(string $username, string $password): array
{
    $checks = [
        'username' => validate_username($username),
        'password' => ($password === '') ? 'Password is required.' : '',
    ];
    return array_filter($checks, fn($message) => $message !== '');
}
