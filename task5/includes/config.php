<?php
// includes/config.php
// Started on every page: boots the session and holds small shared helpers.

session_start();

/**
 * Safely echo a value into HTML (prevents XSS when we print back
 * whatever the user typed into a form).
 */
function h($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * True once the user has logged in with the simple email/password form.
 */
function isLoggedIn() {
    return !empty($_SESSION['logged_in']);
}

/**
 * True once the logged-in user has also filled the extended profile form.
 */
function hasProfile() {
    return !empty($_SESSION['profile_completed']);
}
