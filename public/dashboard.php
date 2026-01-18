<?php

session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

if(($_SESSION['user']['role'] ?? '') !=='admin'){
    header("Location: index.php");
    exit;
}

$user = $_SESSION['user'];

include __DIR__ . '/dashboard.html';