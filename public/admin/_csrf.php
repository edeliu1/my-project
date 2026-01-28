<?php
if(empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(16));
}

function csrf_input(){
    $t = htmlspecialchars($_SESSION['csrf']);
    echo '<input type="hidden" name="csrf" value"' .$t.  '">';
}

function csrf_check(){
    $posted = $_POST['csrf'] ?? '';
    if(!$posted || !hash_equals($_SESSION['csrf'], $posted)){
        http_response_code(403);
        die("CSRF token invalid.");
    }
}