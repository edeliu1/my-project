<?php
session_start();
$user = $_SESSION['user'] ?? null;
$isAdmin = $user && strtolower(trim((string)($user['role'] ?? ''))) === 'admin';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Online Requests - Smart City</title>

  <link rel="stylesheet" href="../css/index.css">
  <link rel="stylesheet" href="online_requests.css">
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
      <li><a href="../offers.php">Offers</a></li>

      <?php if ($user): ?>
        <?php if ($isAdmin): ?>
          <li><a href="../admin/dashboard.php">Dashboard</a></li>
        <?php endif; ?>
        <li><a href="../logout.php">Logout</a></li>
      <?php else: ?>
        <li><a href="../login.php">Login</a></li>
      <?php endif; ?>
    </ul>
  </nav>
</header>

<section class="requests-page">
  <div class="topbar">
    <div class="titles">
      <div class="breadcrumbs">Services / Online Requests</div>
      <h1 class="page-title">Online Requests</h1>
      <p class="subtitle">
        Submit simple requests online and get guidance on required documents and processing time.
      </p>
    </div>

    <div class="actions">
      <a class="btn btn-secondary" href="../services.php">← Back to Services</a>
    </div>
  </div>

  <div class="grid">
    <div class="karta">
      <h2 class="section-title">Request Types</h2>

      <div class="item" id="rq-appointment">
        <div class="icon">📅</div>
        <div class="text">
          <h3>Appointment Request</h3>
          <p class="meta">Book an appointment for municipal services and document processing.</p>
        </div>
      </div>

      <div class="item" id="rq-docs">
        <div class="icon">📄</div>
        <div class="text">
          <h3>Document Request</h3>
          <p class="meta">Request confirmations, certificates, and official letters.</p>
        </div>
      </div>

      <div class="item" id="rq-report">
        <div class="icon">🛠️</div>
        <div class="text">
          <h3>Issue Report</h3>
          <p class="meta">Report streetlights, roads, waste issues, and get follow-up guidance.</p>
        </div>
      </div>

      <div class="item" id="rq-feedback">
        <div class="icon">💬</div>
        <div class="text">
          <h3>Feedback / Suggestion</h3>
          <p class="meta">Send suggestions to improve services in the municipality.</p>
        </div>
      </div>
    </div>

    <div class="karta">
      <h2 class="section-title">Quick Search</h2>

      <div class="searchbox">
        <input id="q" type="text" placeholder="Search request types">
        <button class="btn-primary" type="button" onclick="filterRequests()">Search</button>
      </div>

      <h3 class="mini-title spaced">Processing Info</h3>
      <p class="meta">Most requests: 1–5 working days (depending on service).</p>

      <h3 class="mini-title spaced">Quick Links</h3>
      <div class="links">
        <button class="link-btn" data-target="#rq-appointment">Appointments</button>
        <button class="link-btn" data-target="#rq-docs">Documents</button>
        <button class="link-btn" data-target="#rq-report">Report Issue</button>
        <button class="link-btn" data-target="#rq-feedback">Feedback</button>
      </div>

      <div class="tip">
        Tip: For official submissions, use the Contact form or visit the municipality office.
      </div>
    </div>
  </div>
</section>

<footer class="main-footer">
  <p>© 2025 Smart City Web Portal - Fushe Kosova</p>
</footer>

<script src="online_requests.js"></script>
</body>
</html>
