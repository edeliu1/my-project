<?php
session_start();
$user = $_SESSION['user'] ?? null;
$isAdmin = $user && strtolower((string)($user['role'] ?? '')) === 'admin';

require __DIR__ . '/../app/core/Database.php';
$config = require __DIR__ . '/../config/config.php';
$db = new Database($config);

$rows = $db->getPdo()->query("
    SELECT id, name, description, price, image_path, pdf_path, created_at
    FROM products
    ORDER BY id DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Municipal Offers</title>
  <link rel="stylesheet" href="css/offers.css?v=1">
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
      <li><a href="services.php">Services</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li><a class="active" href="offers.php">Offers</a></li>

      <?php if ($user): ?>
        <?php if ($isAdmin): ?>
          <li><a href="admin/dashboard.php">Admin</a></li>
        <?php endif; ?>
        <li><a href="logout.php">Logout</a></li>
      <?php else: ?>
        <li><a href="login.php">Login</a></li>
      <?php endif; ?>
    </ul>
  </nav>
</header>

<section class="hero">
  <div class="hero-inner">
    <h1>Municipal Offers</h1>
    <p>Forms, guides, and service information packs from the municipality.</p>
  </div>
</section>

<main class="wrap">
  <?php if (!$rows): ?>
    <div class="empty">
      <h3>No offers available right now.</h3>
      <p>Add offers from the admin panel.</p>
    </div>
  <?php else: ?>
    <div class="grid">
      <?php foreach ($rows as $r): ?>
        <?php
          $name = (string)($r['name'] ?? '');
          $desc = (string)($r['description'] ?? '');
          $price = (float)($r['price'] ?? 0);
          $img = trim((string)($r['image_path'] ?? ''));
          $pdf = trim((string)($r['pdf_path'] ?? ''));
        ?>
        <article class="card">
          <?php if ($img !== ''): ?>
            <div class="card-img">
              <img src="<?php echo htmlspecialchars($img); ?>" alt="">
            </div>
          <?php else: ?>
            <div class="card-img placeholder">
              <span>📄</span>
            </div>
          <?php endif; ?>

          <div class="card-body">
            <div class="card-top">
              <h2><?php echo htmlspecialchars($name); ?></h2>
              <span class="badge"><?php echo ($price <= 0) ? 'Free' : '€' . number_format($price, 2); ?></span>
            </div>

            <p class="desc"><?php echo nl2br(htmlspecialchars($desc)); ?></p>

            <div class="actions">
              <?php if ($pdf !== ''): ?>
                <a class="btn" href="<?php echo htmlspecialchars($pdf); ?>" target="_blank" rel="noopener">Download PDF</a>
              <?php else: ?>
                <span class="muted">No PDF attached</span>
              <?php endif; ?>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</main>

<footer class="main-footer">
  <p>© 2025 Smart City Web Portal - Fushe Kosova</p>
</footer>

</body>
</html>
