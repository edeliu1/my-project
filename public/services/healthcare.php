<?php

session_start();
$user = $_SESSION['user'] ?? null;
?>
<DOCTYPE html>
    <html lang="en">
   <head>
  <meta charset="UTF-8">
 <title>Healthcare Services</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../css/healthcare.css">
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
     <li><a href="../services.php" class="active">Services</a></li>
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

  <section class="healthcare-section">
<h1>Healthcare Services</h1>
<p class="subtitle">
  Digital healthcare services designed to support citizens with fast, reliable, and accessible medical care.
    </p>


    <div class="healthcare-grid">
     <div class="health-card">
    <div class="icon">🏥</div>
     <h3>Primary Healthcare</h3>
     <p>Access family medicine services, clinics, and general health consultations.</p>
    </div>

        <div class="health-card">
      <div class="icon">🩺</div>
     <h3>Medical Appointments</h3>
    <p>Book, manage, and track your medical appointments online.</p>
    </div>

        <div class="health-card">
        <div class="icon">💊</div>
         <h3>Pharmacy Services</h3>
     <p>Find nearby pharmacies and check availability of essential medicines.</p>
    </div>

        <div class="health-card">
     <div class="icon">🚑</div>
    <h3>Emergency Care</h3>
     <p>Immediate access to emergency healthcare and ambulance services.</p>
    </div>
    </div>
    </section>

    <footer class="main-footer">
     <p>©️ 2025 Smart City Web Portal - Fushe Kosova</p>
    </footer>

    <script src="../js/healthcare.js"></script>
    </body>
    </html>