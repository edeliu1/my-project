<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$user = $_SESSION['user'];

if (strtolower((string)($user['role'] ?? '')) === 'admin') {
    header("Location: ../admin/dashboard.php");
    exit;
}

require __DIR__ . '/../app/core/Database.php';
$config = require __DIR__ . '/../config/config.php';
$db = new Database($config);
$pdo = $db->getPdo();