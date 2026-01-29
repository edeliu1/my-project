<?php
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