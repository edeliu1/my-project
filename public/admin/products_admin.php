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
    $image = trim($_POST['image'] ?? ''); 

    if ($name === '' || $price === '') {
        $error = "Name and price are required.";
    } elseif (!is_numeric($price)) {
        $error = "Price must be a number.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO products (name, description, image_path, created_at) 
                               VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$name, $description, $image, $_SESSION['user']['id']]);
        $success = "Product added successfully.";
    }
}

$rows = $pdo->query("SELECT id, name, description, image_path, created_at 
                     FROM products ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Products</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<div class="page">
  <h2>Manage Products</h2>

  <?php if ($error): ?>
    <div style="padding:12px;border:1px solid #fecaca;background:#fff1f2;border-radius:12px;margin:14px 0;">
      <?php echo htmlspecialchars($error); ?>
    </div>
  <?php endif; ?>

  <?php if ($success): ?>
    <div style="padding:12px;border:1px solid #bbf7d0;background:#f0fdf4;border-radius:12px;margin:14px 0;">
      <?php echo htmlspecialchars($success); ?>
    </div>
  <?php endif; ?>

  <h3 style="margin-top:10px;">Add Product</h3>
  <form method="post" class="contact-form" style="margin-top:12px;">
    <input type="hidden" name="_csrf" value="<?php echo htmlspecialchars(csrf_token()); ?>">

    <label>Name</label>
    <input name="name" required>

    <label>Description</label>
    <textarea name="description" rows="3"></textarea>

    <label>Image path (optional)</label>
    <input name="image" placeholder="images/xxx.png or https://...">

    <button class="btn-primary" type="submit">Add</button>
  </form>

  <h3 style="margin-top:24px;">Products</h3>

  <?php if (!$rows): ?>
    <p style="opacity:.8;">No products yet.</p>
  <?php else: ?>
    <div style="margin-top:10px;text-align:left;">
      <?php foreach ($rows as $r): ?>
        <div style="padding:14px;border:1px solid #d7e3ff;border-radius:14px;background:white;margin:12px 0;">
          <div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap;">
            <strong><?php echo htmlspecialchars($r['name']); ?></strong>
            <span style="opacity:.7;font-size:13px;"><?php echo htmlspecialchars($r['created_at']); ?></span>
          </div>

          <div style="margin-top:8px;">
            <span style="font-weight:700;">€<?php echo htmlspecialchars($r['price']); ?></span>
          </div>

          <?php if (!empty($r['description'])): ?>
            <p style="margin-top:10px;"><?php echo nl2br(htmlspecialchars($r['description'])); ?></p>
          <?php endif; ?>

          <?php if (!empty($r['image_path'])): ?>
            <div style="margin-top:10px;opacity:.85;font-size:14px;">
              Image: <?php echo htmlspecialchars($r['image_path']); ?>
            </div>
          <?php endif; ?>

          <div style="display:flex;gap:10px;margin-top:12px;flex-wrap:wrap;">
            <a class="btn-primary" href="products_edit.php?id=<?php echo (int)$r['id']; ?>" style="box-shadow:none;">
              Edit
            </a>
            <a class="btn-primary" href="products_delete.php?id=<?php echo (int)$r['id']; ?>"
               style="background:linear-gradient(135deg,#ef4444,#b91c1c);box-shadow:none;"
               onclick="return confirm('Delete this product?');">
              Delete
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <div class="actions" style="margin-top:18px;">
    <a class="logout" href="dashboard.php">Back</a>
  </div>
</div>
</body>
</html>
