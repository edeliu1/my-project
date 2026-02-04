<?php
require __DIR__ . '/_guard.php';
require __DIR__ . '/_db.php';

$rows = $pdo->query(
    "SELECT a.id, a.action, a.description, a.ip_address, a.created_at,
            u.name AS admin_name, u.email
     FROM admin_audit_log a
     JOIN users u ON u.id = a.admin_id
     ORDER BY a.id DESC
     LIMIT 200"
)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Audit Log</title>
  <link rel="stylesheet" href="users_admin.css">
</head>
<body>

<header class="topbar">
  <div class="brand">Admin Dashboard</div>
  <nav class="nav">
    <a href="dashboard.php">Dashboard</a>
    <a href="news_admin.php">News</a>
    <a href="messages_admin.php">Messages</a>
    <a href="users_admin.php">Users</a>
    <a class="active" href="audit_log.php">Audit Log</a>
    <a href="../index.php">Home</a>
  </nav>
</header>

<main class="wrap">
  <div class="header-row">
    <h1>Audit Log</h1>
    <div class="hint">Admin actions history</div>
  </div>

  <div class="card">
    <div class="table-wrap">
      <table class="admin-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Admin</th>
            <th>Action</th>
            <th>Description</th>
            <th>IP</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $r): ?>
          <tr>
            <td><?= (int)$r['id'] ?></td>
            <td>
              <?= htmlspecialchars($r['admin_name']) ?><br>
              <small><?= htmlspecialchars($r['email']) ?></small>
            </td>
            <td><b><?= htmlspecialchars($r['action']) ?></b></td>
            <td><?= htmlspecialchars($r['description']) ?></td>
            <td><?= htmlspecialchars($r['ip_address']) ?></td>
            <td><?= htmlspecialchars($r['created_at']) ?></td>
          </tr>
        <?php endforeach; ?>

        <?php if (!$rows): ?>
          <tr><td colspan="6" class="empty">No audit logs.</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

</body>
</html>
