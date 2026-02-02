<?php
session_start();

$user = $_SESSION['user'] ?? null;
$isAdmin = $user && strtolower(trim((string)($user['role'] ?? ''))) === 'admin';


require __DIR__ . '/../app/core/Database.php';
$config = require __DIR__ . '/../config/config.php';
$db = new Database($config);
$pdo = $db->getPdo();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $subject === '' || $message === '') {
        $error = "Plotëso krejt fushat.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email jo valid.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO contact_messages (name,email,subject,message) VALUES (?,?,?,?)");
        $stmt->execute([$name,$email,$subject,$message]);
        $success = "Mesazhi u dërgua me sukses!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Contact - Smart City Fushe Kosova</title>
        <link rel="stylesheet" href="css/index.css">
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
                <li><a href="contact.php" class="active">Contact</a></li>
                <li><a href="offers.php">Offers</a></li>

                <?php if($user): ?>
                    <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                        <?php endif; ?>
                        </ul>
                    </nav>
                </header>


    <section id="contact" class="content-section">
        <h2>Contact</h2>
        <p>For any issues, suggestions or support, you can contact the municipal administration</p>

        <form class="contact-form" method="post" action="contact.php">
  <label>Name</label>
  <input type="text" name="name" required>

  <label>Email</label>
  <input type="email" name="email" required>

  <label>Subject</label>
  <input type="text" name="subject" required>

  <label>Message</label>
  <textarea name="message" rows="4" required></textarea>

  <button type="submit" class="btn-primary">Send</button>
</form>

    </section>

<footer class="main-footer">
    <p>@ 2025 Smart City Web Portal - Fushe Kosova</p>
</footer>

<script src="js/index.js"></script>
</body>
</html>
