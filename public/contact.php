<?php
session_start();
$user= $_SESSION['user'] ?? null;
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

        <form id="contactForm" class="contact-form">
            <label>Name</label>
            <input id="name" type="text" name="name" required>

            <label>Email</label>
            <input id="email" type="email" name="email" required>

            <label>Message</label>
            <textarea id"message" name="message" rows="4" required></textarea>

            <p id="contactError" class="form-error"></p>

            <button type="submit" class="btn-primary">Send</button>
        </form>
    </section>

<footer class="main-footer">
    <p>@ 2025 Smart City Web Portal - Fushe Kosova</p>
</footer>

<script src="js/index.js"></script>
</body>
</html>
