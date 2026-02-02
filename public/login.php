<?php
session_start();

require __DIR__ . '/../app/core/Database.php';
$config = require __DIR__ . '/../config/config.php';

$db = new Database($config);

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email'] ?? ''); 
    $password = $_POST['password'] ?? '';

    if($email === '' || $password === '') {
        $error = 'Ploteso email dhe password!';
    } else{
        $stmt = $db->getPdo()->prepare("SELECT id,name,email,password_hash, role FROM users WHERE email =? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password,$user['password_hash'])){
            $_SESSION['user'] = [
                'id' => (int)$user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ];

            $base = '/my-project/public/';
            
            if (strtolower((string)$user['role']) === 'admin'){
                header("Location: " . $base . "admin/dashboard.php");
                exit;
            } else{
                header("Location: " . $base . "users/dashboard.php");        
            }
        } else{
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
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <header class="main-header">
</header>
    <div class="hyrja-wrapper">
    <h2>Login</h2>

    <?php if (!empty($error)) : ?>
        <div id="gabim"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" action="login.php">
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