<?php
session_start();

require_once _DIR_ . '/../admin/_db.php';

if (isset($_SESSION['user'])) {
        header("Location: ../login.php");
        exit;
}

$user = $_SESSION['user'];

if (($user['role'] ?? '') === 'admin') {
        header("Location: ../admin/dashboard.php");
        exit;
}
        ?>
        <DOCTYPE html>
         <html lang="en">
            <head>
   <meta charset="UTF-8">
     <meta name="viewport"
      content="width=device-width, initial-scale=1.0">
     <title>User Dashboard</title>
