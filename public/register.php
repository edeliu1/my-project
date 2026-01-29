<?php
session_start();

require __DIR__ . '/../app/core/Database.php';
$config = require __DIR__ . '/../config/config.php';
$db = new Database($config);

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if($name === '' || $email === '' || $password === ''){
        $error = "Ploteso te gjitha fushat!";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Email nuk eshte valide!";
    } elseif(strlen($password) < 6){
        $error = "Password duhet te kete te pakten 6 karaktere!";
    } else{
        $stmt = $db->getPdo()->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $exists = $stmt->fetch(PDO::FETCH_ASSOC);

        if($exists){
            $error = "Kjo email ekziston! Provo login.";
        } else{
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $db->getPdo()->prepare("INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, 'user')");
            $stmt->execute([$name, $email, $hash]);

            header("Location: login.php");
            exit;
        }
    }
}
?>

<div class="hyrja-wrapper">
    <h2>Register</h2>

    <?php if (!empty($error)) : ?>
        <div id="gabim"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" action="register.php">
        <label>Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Create account</button>

        <p>Ke llogari? <a href="login.php">Login</a></p>
    </form>
</div>