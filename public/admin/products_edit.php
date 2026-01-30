<?php
require __DIR__ . '/_guard.php';
require __DIR__ . '/_db.php';
require __DIR__ . '/_csrf.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header("Location: products_admin.php");
    exit;
}

$error = '';
$success = '';

$stmt = $pdo->prepare("SELECT id, name, price, description, image FROM products WHERE id = ? LIMIT 1");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header("Location: products_admin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();

    $name = trim($_POST['name'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $image = trim($_POST['image'] ?? '');

    if ($name === '' || $price === '') {
        $error = "Name and price are required.";
    } elseif (!is_numeric($price)) {
        $error = "Price must be a number.";
    } else {
        $upd = $pdo->prepare("UPDATE products SET name=?, price=?, description=?, image=? WHERE id=?");
        $upd->execute([$name, (float)$price, $description, $image, $id]);
        $success = "Product updated.";

        // refresh data
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Product</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<div class="page">
  <h2>Edit Product</h2>

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

  <form method="post" class="contact-form">
    <input type="hidden" name="_csrf" value="<?php echo htmlspecialchars(csrf_token()); ?>">

    <label>Name</label>
    <input name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>

    <label>Price</label>
    <input name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>

    <label>Description</label>
    <textarea name="description" rows="4"><?php echo htmlspecialchars($product['description']); ?></textarea>

    <label>Image path</label>
    <input name="image" value="<?php echo htmlspecialchars($product['image']); ?>">

    <button class="btn-primary" type="submit">Save</button>
  </form>

  <div class="actions" style="margin-top:18px;">
    <a class="logout" href="products_admin.php">Back</a>
  </div>
</div>
</body>
</html>
