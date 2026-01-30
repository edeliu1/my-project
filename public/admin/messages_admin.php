<?php
require __DIR__ . '/_guard.php';
require __DIR__ . '/_db.php';
require __DIR__ . '/_csrf.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();

    $id = (int)($_POST['id'] ?? 0);

    if ($id > 0) {
        $stmt = $pdo->prepare("DELETE FROM contact_message WHERE id = ?");
        $stmt->execute([$id]);
        $success = "Message deleted.";
    } else {
        $error = "Invalid message id.";
    }
}

$rows = $pdo->query("SELECT id, name, email, message, created_at 
                     FROM contact_message 
                     ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Messages</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<div class="page">
  <h2>Contact Messages</h2>

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

  <?php if (!$rows): ?>
    <p style="opacity:.8;">No messages yet.</p>
  <?php else: ?>
    <?php foreach ($rows as $r): ?>
      <div style="padding:14px;border:1px solid #d7e3ff;border-radius:14px;background:white;margin:12px 0;text-align:left;">
        <div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap;">
          <strong><?php echo htmlspecialchars($r['name']); ?></strong>
          <span style="opacity:.7;font-size:13px;"><?php echo htmlspecialchars($r['created_at']); ?></span>
        </div>

        <div style="margin-top:6px;opacity:.9;">
          <?php echo htmlspecialchars($r['email']); ?>
        </div>

        <p style="margin-top:10px;">
          <?php echo nl2br(htmlspecialchars($r['message'])); ?>
        </p>

        <form method="post" style="margin-top:12px;">
          <input type="hidden" name="_csrf" value="<?php echo htmlspecialchars(csrf_token()); ?>">
          <input type="hidden" name="id" value="<?php echo (int)$r['id']; ?>">
          <button type="submit" class="btn-primary" style="background:linear-gradient(135deg,#ef4444,#b91c1c);box-shadow:none;">
            Delete
          </button>
        </form>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>

  <div class="actions" style="margin-top:18px;">
    <a class="logout" href="dashboard.php">Back</a>
  </div>
</div>
</body>
</html>
