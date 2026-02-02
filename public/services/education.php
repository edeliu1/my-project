<?php
session_start();
$user = $_SESSION['user'] ?? null;
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Education - Smart City</title>
        <link rel="stylesheet" href="../css/index.css">
</head>
<body>

<header class="main-header">
    <div class="logo-area">
        <img src="../images/logo.fk.png" alt="Fushe Kosova Logo">
        <span class="portal-name">Fushe Kosova</span>
</div>
<nav class="main-nav">
    <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="../about.php">About us</a></li>
        <li><a href="../services.php"class="active">Services</a></li>