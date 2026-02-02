<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

if (strtolower((string)$_SESSION['user']['role']) !== 'admin') {
    header("Location: ../index.php");
    exit;
}

require __DIR__ . '/_db.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM contact_messages WHERE id = ?");
$stmt->execute([$id]);
$msg = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$msg) {
    header("Location: contact_messages.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Message</title>
</head>
<body>

<h2><?= htmlspecialchars($msg['subject']) ?></h2>
<p><b>Emri:</b> <?= htmlspecialchars($msg['name']) ?></p>
<p><b>Email:</b> <?= htmlspecialchars($msg['email']) ?></p>
<p><b>Data:</b> <?= $msg['created_at'] ?></p>
<hr>
<p><?= nl2br(htmlspecialchars($msg['message'])) ?></p>

<a href="contact_messages.php">← Kthehu</a>

</body>
</html>
