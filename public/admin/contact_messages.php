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

$messages = $pdo->query(
    "SELECT id, name, email, subject, created_at 
     FROM contact_messages 
     ORDER BY created_at DESC"
)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contact Messages</title>
<style>
table { border-collapse: collapse; width: 100%; }
th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
th { background: #f4f4f4; }
</style>
</head>
<body>

<h2>Mesazhet nga Contact Form</h2>

<table>
  <tr>
    <th>ID</th>
    <th>Emri</th>
    <th>Email</th>
    <th>Subjekti</th>
    <th>Data</th>
    <th>Lexo</th>
  </tr>

  <?php foreach ($messages as $m): ?>
  <tr>
    <td><?= $m['id'] ?></td>
    <td><?= htmlspecialchars($m['name']) ?></td>
    <td><?= htmlspecialchars($m['email']) ?></td>
    <td><?= htmlspecialchars($m['subject']) ?></td>
    <td><?= $m['created_at'] ?></td>
    <td>
      <a href="contact_message_view.php?id=<?= $m['id'] ?>">Hap</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>

</body>
</html>
