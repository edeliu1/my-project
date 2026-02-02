<?php
session_start();

require __DIR__ . '/../app/core/Database.php';
$config = require __DIR__ . '/../config/config.php';
$db = new Database($config);

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header("Location: index.php#news");
    exit;
}

$stmt = $db->getPdo()->prepare("SELECT id, title, body, created_at FROM news WHERE id = ? LIMIT 1");
$stmt->execute([$id]);
$news = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$news) {
    header("Location: index.php#news");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($news['title']); ?> - News</title>
  <link rel="stylesheet" href="css/index.css">

  <style>
    .article-wrap{ max-width: 900px; margin: 40px auto; padding: 0 20px; }
    .article-card{
      background: rgba(255,255,255,.95);
      border: 1px solid rgba(37,99,235,.15);
      border-radius: 18px;
      box-shadow: 0 18px 45px rgba(0,0,0,.10);
      padding: 20px;
      text-align:left;
    }
    .article-meta{ opacity:.75; font-size: 13px; margin-top: 6px; }
    .article-body{ margin-top: 14px; line-height: 1.7; font-size: 15px; }
    .back-btn{
      display:inline-block;
      margin-top: 16px;
      padding: 10px 14px;
      border-radius: 999px;
      background: linear-gradient(135deg,#2563eb,#1d4ed8);
      color: #fff;
      text-decoration:none;
      font-weight:800;
    }
  </style>
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
            <li><a href="index.php#news" class="active">News</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<div class="article-wrap">
  <div class="article-card">
    <h2 style="margin:0;"><?php echo htmlspecialchars($news['title']); ?></h2>
    <div class="article-meta">
      Published: <?php echo htmlspecialchars($news['created_at'] ?? ''); ?>
    </div>

    <div class="article-body">
      <?php echo nl2br(htmlspecialchars($news['body'] ?? '')); ?>
    </div>

    <a class="back-btn" href="index.php#news">← Back to Home</a>
  </div>
</div>

<footer class="main-footer">
    <p>© 2025 Smart City Web Portal - Fushe Kosova</p>
</footer>

</body>
</html>
