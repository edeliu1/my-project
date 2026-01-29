<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

function csrf_input(){
    $t = htmlspecialchars($_SESSION['csrf']);
    echo '<input type="hidden" name="csrf" value="' .$t.  '">';
}

function csrf_check(){
    $posted = $_POST['csrf'] ?? '';
    $sessionToken = $_SESSION['csrf'] ?? '';

    if(!$posted || !$sessionToken || !hash_equals($sessionToken, $posted)){
        http_response_code(403);
        die("CSRF token invalid.");
    }
}