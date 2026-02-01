<?php
require __DIR__ . '/admin/_db.php';

$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("
    SELECT title, body, image_path, created_at
    FROM news
    WHERE id = ?
    LIMIT 1
");
$stmt->execute([$id]);
$news = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$news) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($news['title']) ?></title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/news.css">
</head>
<body>

<header class="main-header">
</header>

<div class="news-full">
    <h1><?= htmlspecialchars($news['title']) ?></h1>

    <div class="news-date">
        <?= date('d M Y', strtotime($news['created_at'])) ?>
    </div>

    <?php if (!empty($news['image_path'])): ?>
        <img src="<?= htmlspecialchars($news['image_path']) ?>" class="news-image">
    <?php endif; ?>

    <div class="news-body">
        <?= nl2br(htmlspecialchars($news['body'])) ?>
    </div>

    <a href="index.php" class="btn-back">← Back to Home</a>
</div>

</body>
</html>
