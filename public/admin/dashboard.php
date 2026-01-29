<?php

session_start();

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
    <link rel="stylesheet" href="../admin/dashboard.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Admin Dashboard</h2>
    
    <p>Welcome, 
    <?php echo htmlspecialchars($user['name']); ?>
    (<?php echo htmlspecialchars($user['email']); ?>)
    <span class="badge">ADMIN</span>
    </p>

    <ul class="menu">
        <li>
            <a href="news_admin.php">
                <span class="icon">📰</span>
                Manage News
            </a>
        </li>
        <li>
            <a href="products_admin.php">
                <span class="icon">📦</span>
                Manage Products
            </a>
        </li>
        <li>
            <a href="messages_admin.php">
                <span class="icon">✉️</span>
                Contact Messages
            </a>
        </li>
    </ul>

    <div class="actions">
        <a class="logout" href="../logout.php">Logout</a>
    </div>
</body>
</html>