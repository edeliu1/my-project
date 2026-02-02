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
  <title>Transport - Smart City</title>

  <link rel="stylesheet" href="../css/index.css">
  <link rel="stylesheet" href="transport.css">
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

<section class="transport-page">
  <div class="topbar">
    <div class="titles">
      <div class="breadcrumbs">Services / Transport</div>
      <h1 class="page-title">Transport Services</h1>
      <p class="subtitle">
        Information about public transport, train schedules, permits, parking, and road updates in Fushe Kosova.
      </p>
    </div>

    <div class="actions">
      <a class="btn btn-secondary" href="../services.php">← Back to Services</a>
    </div>
  </div>

  <div class="grid">
    <div class="karta">
      <h2 class="section-title">Popular Transport Services</h2>

      <div class="item" id="tr-bus">
        <div class="icon">🚌</div>
        <div class="text">
          <h3>City Bus Info</h3>
          <p class="meta">Routes, stops, ticket info, and peak-time guidance.</p>
        </div>
      </div>

      <div class="item" id="tr-train">
        <div class="icon">🚆</div>
        <div class="text">
          <h3>Train Schedule</h3>
          <p class="meta">Departures, arrivals and station information.</p>
        </div>
      </div>

      <div class="item" id="tr-parking">
        <div class="icon">🅿️</div>
        <div class="text">
          <h3>Parking & Zones</h3>
          <p class="meta">Parking zones, fees, and permit rules.</p>
        </div>
      </div>

      <div class="item" id="tr-permits">
        <div class="icon">🪪</div>
        <div class="text">
          <h3>Transport Permits</h3>
          <p class="meta">Special permits for vehicles and access restrictions.</p>
        </div>
      </div>
    </div>

    <div class="karta">
      <h2 class="section-title">Search & Information</h2>

      <div class="searchbox">
        <input id="q" type="text" placeholder="Search transport services">
        <button class="btn-primary" type="button" onclick="filterTransport()">Search</button>
      </div>

      <h3 class="mini-title spaced">Support Hours</h3>
      <p class="meta">Monday–Friday: 08:00–16:00</p>

      <h3 class="mini-title spaced">Quick Links</h3>
      <div class="links">
        <button class="link-btn" data-target="#tr-bus">Bus</button>
        <button class="link-btn" data-target="#tr-train">Train</button>
        <button class="link-btn" data-target="#tr-parking">Parking</button>
        <button class="link-btn" data-target="#tr-permits">Permits</button>
      </div>

      <p class="note">
        Tip: Use the search to quickly find the service you need.
      </p>
    </div>
  </div>
</section>

<footer class="main-footer">
  <p>© 2025 Smart City Web Portal - Fushe Kosova</p>
</footer>

<script src="transport.js"></script>
</body>
</html>
