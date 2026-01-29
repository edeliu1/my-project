<?php
session_start();
$user= $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Contact - Smart City Fushe Kosova</title>
        <link rel="stylesheet" href="css/index.css">
</head>
<body>  

<header class="main-header">
    <div class="logo-area">
        <img src="images/logo.fk.png" alt="Fushe Kosova Logo">
        <span class="portal-name">Fushe Kosova</span>
</div>

<nav class="main-nav">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About us</a></li>
        <li><a href="services.php">services</a></li>
        <li><a href="contact.php"class="active">Contact</a></li>
        <li><a href="login.php">Login</a></li>
  </ul>
 </nav>
</header>

<section id="contact" class="content-section">
    <h2>Contact</h2>
    <p>For any issues, suggestions or support, you can contact the municipal administration</p>
