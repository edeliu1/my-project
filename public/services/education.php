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
        <li><a href="../contact.php">Contact</a></li>
        <?php if ($user): ?>
            <?php if(strtolower((string)$user['role']) === 'admin'): ?>
               
                <li><a href="../dashboard.php">Dashboard</a></li>
                <?php endif; ?>
                <li><a href="../logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="../login.php">Login</a></li>
                    <?php endif; ?>
   </ul>
  </nav>
</header>

<section class="education-page">
    <div class="topbar">
        <div class="titles">
            <div class="breadcrumbs">Services / Education</div>
            <h1 class="page-title">Education Services</h1>
            <p class="subtitle">
                An overview of education-related services in the municipality, including enrollments,
                certificates, scholarships, and school transport information.
                </p>
               </div>
               <div class="btn btn-secondary" href="../services.php">← Back to Services</a>
                </div>
               </div>
