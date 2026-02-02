<?php
session_start();
if(!isset($_SESSION['user'])){ header("Location: ../login.php"); exit; }
if(strtolower((string)($_SESSION['user']['role'] ?? '')) !== 'admin'){ header("Location: ../index.php"); exit; }

require __DIR__ . '/_db.php';

$rows = $pdo->query("SELECT id,name,email,subject,created_at FROM contact_messages ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Messages</title></head>
<body>
<h2>Contact Messages</h2>
<table border="1" cellpadding="8">
<tr><th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Date</th><th>Open</th></tr>
<?php foreach($rows as $r): ?>
<tr>
  <td><?= (int)$r['id'] ?></td>
  <td><?= htmlspecialchars($r['name']) ?></td>
  <td><?= htmlspecialchars($r['email']) ?></td>
  <td><?= htmlspecialchars($r['subject']) ?></td>
  <td><?= htmlspecialchars($r['created_at']) ?></td>
  <td><a href="message_view.php?id=<?= (int)$r['id'] ?>">View</a></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
