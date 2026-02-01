<?php
session_start();
$user = $_SESSION['user'] ?? null;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Municipal Administration - Smart City</title>

  <link rel="stylesheet" href="../css/index.css">
  <link rel="stylesheet" href="municipal.css">
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

<section class="municipal-page">
  <div class="topbar">
    <div class="titles">
      <div class="breadcrumbs">Services / Municipal Administration</div>
      <h1 class="page-title">Municipal Administration</h1>
      <p class="subtitle">
        Municipal Administration provides essential public services that support the daily life of citizens and the proper functioning of the municipality. Through municipal offices, residents can access administrative procedures, official documents, registrations, permits, and information related to local governance.
      </p>
    </div>

    <div class="actions">
      <a class="btn btn-secondary" href="../services.php">← Back to Services</a>
    </div>
  </div>

  <div class="grid">
    <div class="karta">
      <h2 class="section-title">Main Offices</h2>

      <div class="item" id="office-civil">
        <h3>Office of Civil Status <span class="badge2">Civil Status</span></h3>
        <p class="meta"><b>Services:</b> certificates, verifications, registrations</p>
        <p class="meta"><b>Phone:</b> +383 xx xxx xxx</p>
        <p class="meta"><b>Hours:</b> 08:00–16:00</p>
      </div>

      <div class="item" id="office-urban">
        <h3>Urban Planning & Construction <span class="badge2">Urban</span></h3>
        <p class="meta"><b>Services:</b> building permits, urban information, procedures (as required)</p>
        <p class="meta"><b>Phone:</b> +383 xx xxx xxx</p>
      </div>

      <div class="item" id="office-finance">
        <h3>Finance / Local Taxes <span class="badge2">Finance</span></h3>
        <p class="meta"><b>Services:</b> payments, obligations, confirmations</p>
        <p class="meta"><b>Phone:</b> +383 xx xxx xxx</p>
      </div>
    </div>

    <div class="karta">
      <h2 class="section-title">Citizen Information</h2>

      <div class="item">
        <h3>How to contact</h3>
        <p class="meta">• Call the responsible office</p>
        <p class="meta">• Or use the portal Contact page</p>
      </div>

      <div class="item">
        <h3>Common required documents</h3>
        <p class="meta">ID • Personal number • Address • Authorization (if applying for someone else)</p>
      </div>

      <div class="item">
        <h3>Office address (example)</h3>
        <p class="meta">Municipality of Fushe Kosova — (insert address)</p>
      </div>

      <div class="item quicklinks">
        <h3>Quick links</h3>
        <div class="links">
          <button class="link-btn" type="button" data-target="#office-civil">Civil Status Office</button>
          <button class="link-btn" type="button" data-target="#office-urban">Urban Planning</button>
          <button class="link-btn" type="button" data-target="#office-finance">Finance / Taxes</button>
        </div>
      </div>
    </div>
  </div>
</section>

<footer class="main-footer">
  <p>© 2025 Smart City Web Portal - Fushe Kosova</p>
</footer>

<script src="municipal.js"></script>
</body>
</html>