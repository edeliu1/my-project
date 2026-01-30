<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

if (isset($_SESSION['user'])) {
        header("Location: ../login.php");
        exit;
}

$user = $_SESSION['user'];

if (strtolower((string)($user['role'] ?? '')) === 'admin') {
        header("Location: ../admin/dashboard.php");
        exit;
}

if (strtolower((string)($user['role'] ?? '')) !== 'user') {
    header("Location: ../index.php");
    exit;
}
?>
<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../admin/dashboard.css">
</head>
<body>
    <div class="page">
     <h2>User Dashboard</h2>

      <p class="welcome">
         Welcome,
             <?php echo htmlspecialchars($user['name']); ?>
                      (<?php echo htmlspecialchars($user['email']); ?>)
                                                    <span class="badge">USER</span>
</p>

    <ul class="menu">
  <li>
        <a href="../index.php">
         <span class="icon">🏠</span>
           Home
</a>
</li>

        <li>
 <a href="../logout.php">
     <span class="icon">🚪</span>
     Logout            </a>
</li>
</ul>
</div>
</body>
</html>