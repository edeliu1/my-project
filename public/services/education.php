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
  <link rel="stylesheet" href="education.css">
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
    <div class="actions">
      <a class="btn btn-secondary" href="../services.php">← Back to Services</a>
    </div>
  </div>

  <div class="grid">
    <div class="karta">
      <h2 class="section-title">Popular Education Services</h2>

      <div class="item" id="svc-enrollment">
        <div class="icon">🎓</div>
        <div class="text">
          <h3>Student Enrollment</h3>
          <p class="meta">Information about enrollment procedures, requirements, and deadlines.</p>
        </div>
      </div>

      <div class="item" id="svc-scholarships">
        <div class="icon">🏅</div>
        <div class="text">
          <h3>Scholarships</h3>
          <p class="meta">Details on available scholarship programs and application steps.</p>
        </div>
      </div>

      <div class="item" id="svc-certificates">
        <div class="icon">📄</div>
        <div class="text">
          <h3>School Certificates</h3>
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

    <div class="karta">
      <h2 class="section-title">Search & Information</h2>

      <div class="searchbox">
        <input id="q" type="text" placeholder="Search education services">
        <button class="btn-primary" type="button" onclick="filterEducation()">Search</button>
      </div>

      <h3 class="mini-title">Opening Hours</h3>
      <p class="meta">Monday–Friday: 08:00–16:00</p>

      <h3 class="mini-title spaced">Quick Links</h3>
      <div class="links">
        <button class="link-btn" data-target="#svc-enrollment">Enrollment</button>
        <button class="link-btn" data-target="#svc-scholarships">Scholarships</button>
        <button class="link-btn" data-target="#svc-certificates">Certificates</button>
        <button class="link-btn" data-target="#svc-transport">Transport</button>
      </div>
    </div>
  </div>
</section>

<footer class="main-footer">
  <p>© 2025 Smart City Web Portal - Fushe Kosova</p>
</footer>

<script src="education.js"></script>
</body>
</html>