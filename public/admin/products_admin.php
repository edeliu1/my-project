<?php
require __DIR__ . '/_guard.php';
require __DIR__ . '/_db.php';
require __DIR__ . '/_csrf.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();

    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $image = trim($_POST['image'] ?? '');
    $pdf = trim($_POST['pdf'] ?? '');

    if ($name === '') {
        $error = "Name is required.";
    } elseif ($price !== '' && !is_numeric($price)) {
        $error = "Price must be a number (or leave empty).";
    } else {
        $createdBy = (int)($_SESSION['user']['id'] ?? 0);
        $priceVal = ($price === '') ? 0 : (float)$price;

        $stmt = $pdo->prepare(
            "INSERT INTO products (name, description, price, image_path, pdf_path, created_by, created_at)
             VALUES (?, ?, ?, ?, ?, ?, NOW())"
        );
        $stmt->execute([$name, $description, $priceVal, $image, $pdf, $createdBy]);

        $success = "Offer added successfully.";
    }
}

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
  <title>Municipal Offers - Admin</title>
  <link rel="stylesheet" href="products_admin.css?v=7">
</head>
<body>

<div class="page">

  <h2>Municipal Offers</h2>

  <?php if ($error): ?>
    <div class="msg error"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <?php if ($success): ?>
    <div class="msg success"><?php echo htmlspecialchars($success); ?></div>
  <?php endif; ?>

  <h3>Add Offer</h3>

  <div class="card">
    <form method="post">
      <?php csrf_input(); ?>

      <div class="form-row">
        <label>Title</label>
        <input name="name" required>
      </div>

      <div class="form-row">
        <label>Description</label>
        <textarea name="description" rows="4" required></textarea>
      </div>

      <div class="form-row">
        <label>Price (optional)</label>
        <input name="price" type="number" step="0.01" placeholder="0.00">
      </div>

      <div class="form-row">
        <label>Image path (optional)</label>
        <input name="image" placeholder="images/permit.png or https://...">
      </div>

      <div class="form-row">
        <label>PDF path (optional)</label>
        <input name="pdf" placeholder="docs/parking-permit.pdf or https://...">
      </div>

      <button class="btn-primary" type="submit">Add</button>
    </form>
  </div>

  <h3 style="margin-top:24px;">Offers</h3>

  <?php if (!$rows): ?>
    <p style="opacity:.8;">No offers yet.</p>
  <?php else: ?>
    <div class="list">
      <?php foreach ($rows as $r): ?>
        <div class="item">
          <div class="item-top">
            <strong><?php echo htmlspecialchars($r['name']); ?></strong>
            <span class="time"><?php echo htmlspecialchars($r['created_at']); ?></span>
          </div>

          <div class="price">
            <?php
              $p = (float)($r['price'] ?? 0);
              echo ($p <= 0) ? "Free" : "€" . number_format($p, 2);
            ?>
          </div>

          <p><?php echo nl2br(htmlspecialchars($r['description'])); ?></p>

          <?php if (!empty($r['image_path'])): ?>
            <div class="meta">Image: <?php echo htmlspecialchars($r['image_path']); ?></div>
          <?php endif; ?>

          <?php if (!empty($r['pdf_path'])): ?>
            <div class="meta">PDF: <?php echo htmlspecialchars($r['pdf_path']); ?></div>
          <?php endif; ?>

          <div class="actions">
            <a class="btn-primary" href="products_edit.php?id=<?php echo (int)$r['id']; ?>">Edit</a>
            <a class="btn-danger" href="products_delete.php?id=<?php echo (int)$r['id']; ?>" onclick="return confirm('Delete?')">Delete</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <div class="actions">
    <a class="back" href="dashboard.php">Back</a>
  </div>

</div>
</body>
</html>
