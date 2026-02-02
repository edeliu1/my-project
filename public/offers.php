<?php
require __DIR__ . '/admin/_db.php';

$rows = $pdo->query(
    "SELECT id, name, description, price, image_path, pdf_path, created_at
     FROM products
     ORDER BY id DESC"
)->fetchAll(PDO::FETCH_ASSOC);
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

<header class="top">
  <h1>Municipal Offers</h1>
  <p>Forms, guides, and service information packs from the municipality.</p>
</header>

<main class="wrap">
  <?php if (!$rows): ?>
    <p class="empty">No offers available right now.</p>
  <?php else: ?>
    <div class="grid">
      <?php foreach ($rows as $r): ?>
        <article class="offer">
          <?php if (!empty($r['image_path'])): ?>
            <div class="img">
              <img src="<?php echo htmlspecialchars($r['image_path']); ?>" alt="">
            </div>
          <?php endif; ?>

          <h2><?php echo htmlspecialchars($r['name']); ?></h2>

          <div class="badge">
            <?php
              $p = (float)($r['price'] ?? 0);
              echo ($p <= 0) ? "Free" : "€" . number_format($p, 2);
            ?>
          </div>

          <p><?php echo nl2br(htmlspecialchars($r['description'])); ?></p>

          <div class="btns">
            <?php if (!empty($r['pdf_path'])): ?>
              <a class="btn" href="<?php echo htmlspecialchars($r['pdf_path']); ?>" target="_blank" rel="noopener">Download PDF</a>
            <?php endif; ?>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</main>

</body>
</html>
