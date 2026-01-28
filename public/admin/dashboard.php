<?php

session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

if(strtolower((string)($_SESSION['user']['role'] ?? '')) !=='admin'){
    header("Location: index.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Admin Dashboard</h2>
    
    <p>Welcome, 
    <?php echo htmlspecialchars($user['name']); ?>
    (<?php echo htmlspecialchars($user['email']); ?>)
    </p>

    <ul>
        <li><a href="news_admin.php">Manage News</a></li>
        <li><a href="products_admin.php">Manage Products</a></li>
        <li><a href="messages_admin.php">Contact Messages</a></li>
    </ul>

    <p><a href="logout.php">Logout</a></p>
</body>
</html>