<?php
session_start();

require __DIR__ . '/../app/core/Database.php';
$config = require __DIR__ . '/../config/config.php';
$db = new Database($config);
$pdo = $db->getPdo();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($name === '' || $email === '' || $password === '') {
        $error = 'Ploteso te gjitha fushat!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Email jo valid!';
    } elseif (mb_strlen($password) < 6) {
        $error = 'Password duhet te kete min 6 karaktere!';
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $exists = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($exists) {
            $error = 'Ky email ekziston. Provo Login.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO users (name, email, password_hash, role, created_at)
                                   VALUES (?, ?, ?, 'user', NOW())");
            $stmt->execute([$name, $email, $hash]);

            $newId = (int)$pdo->lastInsertId();

            $_SESSION['user'] = [
                'id' => $newId,
                'name' => $name,
                'email' => $email,
                'role' => 'user'
            ];

            header("Location: index.php");
            exit;
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  <div class="hyrja-wrapper">
    <h2>Register</h2>

    <?php if ($error): ?>
      <div id="gabim" style="margin-bottom:12px;">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <form method="post" action="register.php">
      <label>Name</label>
      <input type="text" name="name" required>

      <label>Email</label>
      <input type="email" name="email" required>

      <label>Password</label>
      <input type="password" name="password" required>

      <button type="submit">Create account</button>
      <p class="small-text">Ke llogari? <a href="login.php">Login</a></p>
    </form>
  </div>
</body>
</html>
