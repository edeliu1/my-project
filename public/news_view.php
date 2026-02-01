<?php
session_start();

require __DIR__ . '/../app/core/Database.php';
$config = require __DIR__ . '/../config/config.php';
$db = new Database($config);

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header("Location: index.php");
    exit;
}

$stmt = $db->getPdo()->prepare("SELECT id, title, body, image_path, pdf_path, created_at 
                                FROM news 
                                WHERE id = ? 
                                LIMIT 1");
$stmt->execute([$id]);
$news = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$news) {
    header("Location: index.php");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($news['title']); ?></title>
  <link rel="stylesheet" href="css/index.css">
  <style>
    .article-wrap{max-width:1000px;margin:30px auto;padding:0 18px}
    .article-card{background:#fff;border-radius:18px;padding:22px;box-shadow:0 18px 40px rgba(0,0,0,.08)}
    .meta{opacity:.75;font-size:14px;margin-top:6px}
    .article-body{margin-top:16px;line-height:1.7;font-size:16px;white-space:pre-wrap}
    .top-actions{display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:14px}
    .btn{display:inline-block;padding:10px 16px;border-radius:999px;background:linear-gradient(135deg,#2563eb,#1d4ed8);color:#fff;text-decoration:none;font-weight:700}
    .asset{margin-top:14px}
    .asset img{max-width:100%;border-radius:14px;border:1px solid #e5e7eb}
  </style>
</head>
<body>
  <div class="article-wrap">
    <div class="top-actions">
      <a class="btn" href="index.php">← Back Home</a>
      <span class="meta"><?php echo htmlspecialchars($news['created_at'] ?? ''); ?></span>
    </div>

    <div class="article-card">
      <h1 style="margin:0;"><?php echo htmlspecialchars($news['title']); ?></h1>
      <div class="meta">Fushe Kosova • Announcement</div>

      <?php if (!empty($news['image_path'])): ?>
        <div class="asset">
          <img src="<?php echo htmlspecialchars($news['image_path']); ?>" alt="News image">
        </div>
      <?php endif; ?>

      <div class="article-body"><?php echo htmlspecialchars($news['body']); ?></div>

      <?php if (!empty($news['pdf_path'])): ?>
        <div class="asset">
          <a class="btn" href="<?php echo htmlspecialchars($news['pdf_path']); ?>" target="_blank">Open PDF</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
