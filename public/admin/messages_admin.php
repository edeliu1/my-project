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
  <link rel="stylesheet" href="users_admin.css">

<header class="topbar">
  <div class="brand">Admin Dashboard</div>
  <nav class="nav">
    <a href="dashboard.php">Dashboard</a>
    <a href="news_admin.php">News</a>
    <a class="active" href="messages_admin.php">Messages</a>
    <a href="users_admin.php">Users</a>
    <a href="../index.php">Home</a>
  </nav>
</header>

<body>
<h2>Contact Messages</h2>

<main class="wrap">
  <div class="header-row">
    <h1>Contact Messages</h1>
    <div class="hint">View messages sent from the contact form.</div>
  </div>

  <div class="card">
    <div class="table-wrap">
      <table border="1" cellpadding="8">
<tr><th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Date</th><th>Open</th></tr>
<?php foreach($rows as $r): ?>
<tr>
  <td><?= (int)$r['id'] ?></td>
  <td><?= htmlspecialchars($r['name']) ?></td>
  <td><?= htmlspecialchars($r['email']) ?></td>
  <td><?= htmlspecialchars($r['subject']) ?></td>
  <td><?= htmlspecialchars($r['created_at']) ?></td>
  <td><a class="btn" href="message_view.php?id=<?php echo (int)$r['id']; ?>">View</a></td>
</tr>
<?php endforeach; ?>
</table>
    </div>
  </div>
</main>

</body>
</html>
