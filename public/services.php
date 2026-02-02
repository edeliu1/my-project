<?php
session_start();
$user = $_SESSION['user'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/services.css">
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
                <li><a href="services.php" class="active">Services</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="offers.php">Offers</a></li>

                <?php if ($user): ?>
                    <?php if(strtolower((string)$user['role']) === 'admin'): ?>
                        <li><a href="dashboard.php">Dashboard</a></li>
                    <?php endif; ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul> 
        </nav>
    </header>

    <section id="services" class="content-section services-section">
        <h2>Our Services</h2>
        <div class="service-grid">
            <a href="services/healthcare.php" class="service-card">
                <span class="icon-circle">🏥</span>
                <h3>Healthcare</h3>
            </a>

            <a href="services/education.php" class="service-card">
                <span class="icon-circle">🎓</span>
                <h3>Education</h3>
            </a>

            <a href="services/municipal.php" class="service-card">
                <span class="icon-circle">🏛️</span>
                <h3>Municipal Administration</h3>
            </a>

            <a href="services/transport.php" class="service-card">
                <span class="icon-circle">🚆</span>
                <h3>Transport</h3>
            </a>

            <a href="services/documents.php" class="service-card">
                <span class="icon-circle">📄</span>
                <h3>Documents</h3>
            </a>

            <a href="services/requests.php" class="service-card">
                <span class="icon-circle">✔️</span>
                <h3>Online Requests</h3>
            </a>
        </div>
    </section>

    <footer class="main-footer">
        <p>© 2025 Smart City Web Portal - Fushe Kosova</p>
    </footer>
    <script src="js/services.js"></script>
</body>
</html>