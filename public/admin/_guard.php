<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['user'])){
    header("Location: ../login.php");
    exit;
}

if(strtolower((string)($_SESSION['user']['role'] ?? '')) !== 'admin'){
    header("Location: ../index.php");
    exit;
}