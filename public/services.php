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
                <li><a href="index.php#about">About us</a></li>
                <li><a href="services.php" class="active">Services</a></li>
                <li><a href="index.php#contact">Contact</a></li>
                
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

    <section class="services-section">
        <div class="services-header">
            <h1>Our City Services</h1>
            <p>Smart digital solutions for everyday city life in Fushe Kosova</p>
        </div>

        <div class="kartat">
            <div class="service-box">
                <span class="service-icon">🚆</span>
                    <h2>Public Transport</h2>
                    <p>Fast and reliable transportation across the city.</p>
            </div>
        
            <div class="service-box">
                <span class="service-icon">♻️</span>
                    <h2>Waste Management</h2>
                    <p>Eco-friendly waste collection and recycling system.</p>
            </div>

            <div class="service-box">
                <span class="service-icon">🚑</span>
                    <h2>Emergency Services</h2>
                    <p>24/7 police, fire, and medical assistance.</p>
            </div>
        </div>
    </section>

    <footer class="main-footer">
        <p>© 2025 Smart City Web Portal - Fushe Kosova</p>
    </footer>
    <script src="js/services.js"></script>
</body>
</html>