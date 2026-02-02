<?php
session_start();
$user = $_SESSION['user'] ?? null;
$isAdmin = $user && strtolower(trim((string)($user['role'] ?? ''))) === 'admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us – Smart City Fushe Kosova</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/aboutus.css">
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
    <li><a href="about.php" class="active">About us</a></li>
    <li><a href="services.php">Services</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a href="offers.php">Offers</a></li>

    <?php if ($user): ?>
      <?php if ($isAdmin): ?>
        <li><a href="admin/dashboard.php">Dashboard</a></li>
      <?php endif; ?>
      <li><a href="logout.php">Logout</a></li>
    <?php else: ?>
      <li><a href="login.php">Login</a></li>
    <?php endif; ?>
  </ul>
</nav>

    </header>

    <section class="permbajtja">
        <h2>About us</h2>
        <p>This Smart City Platform provides digital access to administrative services, such as: healthcare,
            education, transportation, and documents directly to citizens of Fushe Kosova.
        </p>
    </section>

    <section class="permbajtja">
        <h2>Our Mission</h2>
        <p>Our mission is to make municipal services faster, simpler, and more transparent through modern digital tools.</p>
    </section>

    <section class="permbajtja">
        <h2>What you can do here!</h2>
        <p>Through this platform you can browse services, read announcements, submit requests online, and contact the municipality from one place.</p>
    </section>

    <footer class="perfundimi">
        <p>© 2025 Smart City Web Portal - Fushe Kosova</p>
    </footer>
    <script src="js/aboutus.js"></script>
</body>
</html>
