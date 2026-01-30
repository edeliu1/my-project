<?php
session_start();

require_once _DIR_ . '/../admin/_db.php';

if (isset($_SESSION['user'])) {
        header("Location: ../login.php");
        exit;
}

$user = $_SESSION['user'];

if (($user['role'] ?? '') === 'admin') {
        header("Location: ../admin/dashboard.php");
        exit;
}
        ?>
        <DOCTYPE html>
         <html lang="en">
            <head>
   <meta charset="UTF-8">
     <meta name="viewport"
      content="width=device-width, initial-scale=1.0">
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
     logout            </a>
</li>
</ul>
</div>
</body>
</html>