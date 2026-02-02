<?php
session_start();
if(!isset($_SESSION['user'])){ header("Location: ../login.php"); exit; }
if(strtolower((string)($_SESSION['user']['role'] ?? '')) !== 'admin'){ header("Location: ../index.php"); exit; }

require __DIR__ . '/_db.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM contact_messages WHERE id=?");
$stmt->execute([$id]);
$m = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$m){ header("Location: messages_admin.php"); exit; }
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Message</title></head>
<body>
<h2><?= htmlspecialchars($m['subject']) ?></h2>
<p><b>From:</b> <?= htmlspecialchars($m['name']) ?> (<?= htmlspecialchars($m['email']) ?>)</p>
<p><b>Date:</b> <?= htmlspecialchars($m['created_at']) ?></p>
<hr>
<p><?= nl2br(htmlspecialchars($m['message'])) ?></p>
<p><a href="messages_admin.php">Back</a></p>
</body>
</html>
