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
    </ul>

    <div class="actions">
        <a class="btn-home" href="../index.php">← Home</a>
        <a class="logout" href="../logout.php">Logout</a>
    </div>


</body>
</html>