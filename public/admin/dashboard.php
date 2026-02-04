<?php

session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

if(!isset($_SESSION['user'])){
    header("Location: ../login.php");
    exit;
}

if(strtolower((string)($_SESSION['user']['role'] ?? '')) !=='admin'){
    header("Location: ../index.php");
    exit;
}

$user = $_SESSION['user'];

require __DIR__ . '/_db.php';

$newsCount = $pdo->query("SELECT COUNT(*) FROM news")->fetchColumn();
$productsCount = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$messagesCount = $pdo->query("SELECT COUNT(*) FROM contact_messages")->fetchColumn();

$usersCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();

$auditCount = 0;
try{
    $auditCount = $pdo->query("SELECT COUNT(*) FROM admin_audit_log")->fetchColumn();
}catch(Exception $e){
    $auditCount = 0;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="karta">
        <h2>Admin Dashboard</h2>

        <p>Welcome,
        <?php echo htmlspecialchars($user['name']); ?>
        (<?php echo htmlspecialchars($user['email']); ?>)
        <span class="badge">ADMIN</span>
        </p>
    </div>

    <div class="stats">
        <div class="stat">📰 News: <b><?= (int)$newsCount ?></b></div>
        <div class="stat">📦 Products: <b><?= (int)$productsCount ?></b></div>
        <div class="stat">✉️ Messages: <b><?= (int)$messagesCount ?></b></div>
        <div class="stat">👥 Users: <b><?= (int)$usersCount ?></b></div>
        <div class="stat">🧾 Logs: <b><?= (int)$auditCount ?></b></div>
    </div>

    <ul class="menu">
        <li>
            <a href="news_admin.php">
                <span class="icon">📰</span>
                <span>Manage News</span>
            </a>
        </li>

        <li>
            <a href="products_admin.php">
                <span class="icon">📦</span>
                <span>Manage Products</span>
            </a>
        </li>

        <li>
            <a href="messages_admin.php">
                <span class="icon">✉️</span>
                <span>Contact Messages</span>
            </a>
        </li>

        <li>
            <a href="users_admin.php">
                <span class="icon">👥</span>
                <span>Manage Users</span>
            </a>
        </li>

        <li>
            <a href="audit_log.php">
                <span class="icon">🧾</span>
                <span>Audit Log</span>
            </a>
        </li>
    </ul>

    <div class="actions">
        <a class="btn-home" href="../index.php">← Home</a>
        <a class="logout" href="../logout.php">Logout</a>
    </div>

</body>
</html>
