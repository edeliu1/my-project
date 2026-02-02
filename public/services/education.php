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

<div class="grid">
    <div class="karta">
        <h2 class="section-title">Popular Education Services</h2>

        <dic class="item" id="svc-enrollment">
            <div class="icon">🎓</div>
            <dic class="text">
                <h3>Student Enrollment</h3>
                <p class="meta">Information about enrollment procedures, requirements, and deadlines.</p>
      </div>
  </div>

  <div class="item" id="svc-scholarships">
    <div class="icon">🏅</div>
    <div class="text">
        <h3>scholarships</3>
        <p class="meta">Details on available scholarship programs and application stpes.</p>
    </div>   
 </div>

<div class="item" id="svc-certificates">
    <div class="icon">📄</div>
    <div class="text">
        <h3>School certificates</h3>
        <p class="meta">Requests for confirmations, attendance letters, and certificates.</p>
  </div> 
 </div>  
 
 <div class="item" id="svc-transport">
    <div class="icon">🚌</div>
    <div class="text">
        <h3>School Transport</h3>
        <p class="meta">Information on routes, eligibility, and transport rules.</p>
    </div>
   </div>
  </div>    

