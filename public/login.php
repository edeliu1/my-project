<?php
session_start();

$user = $_SESSION['user'] ?? null;
$isAdmin = $user && strtolower(trim((string)($user['role'] ?? ''))) === 'admin';

require __DIR__ . '/../app/core/Database.php';
$config = require __DIR__ . '/../config/config.php';
$db = new Database($config);

$error = '';

$base = rtrim(str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']), '/') . '/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $error = 'Ploteso email dhe password!';
    } else {
        $stmt = $db->getPdo()->prepare("SELECT id, name, email, password_hash, role FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {

            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ];

            $role = strtolower(trim((string)$user['role']));

            if ($role === 'admin') {
                header("Location: " . $base . "admin/dashboard.php");
                exit;
            } else {
                header("Location: " . $base . "index.php");
                exit;
            }

        } else {
            $error = 'Email or password is incorrect!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="css/login.css">
</head>
<body>
    <header class="main-header">
    <div class="logo-area">
        <img src="images/logo.fk.png" alt="Fushe Kosova Logo">
        <span class="portal-name">Fushe Kosova</span>
    </div>

    <nav class="main-nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About us</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="offers.php">Offers</a></li>

            <?php if ($user): ?>
                <?php if ($isAdmin): ?>
                    <li><a href="admin/dashboard.php">Dashboard</a></li>
                <?php endif; ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php" class="active">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

    <div class="hyrja-wrapper">
        <h2>Login</h2>

        <?php if ($error): ?>
            <p style="color:red; margin-bottom:10px;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="post" action="">
            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>

            <p>S'ke llogari? <a href="register.php">Register</a></p>
        </form>
    </div>
</body>
</html>
