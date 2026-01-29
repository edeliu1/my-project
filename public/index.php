<?php
session_start();
$user = $_SESSION['user'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart City - Fushe Kosova</title>
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
                <li><a href="index.php" class="active">Home</a></li>                        
                <li><a href="about.php">About us</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">Login</a></li>

            </ul> 
        </nav>
       

    </header>

    <section id="hero" class="hero" style="background-image: url('images/background.img.png');">
        <div class="hero-overlay">
            <h1>Smart City</h1>
            <p>Connecting citizens with municipal services in Fushe Kosova.</p>
            <a href="services.php" class="btn-primary">Get Started</a>
        </div>
    </section>

    <section id="about" class="content-section">
        <h2>About Us</h2>
        <p>This Smart City Platform provides digital access to administrative services: healthcare, education, transportation and documents-directly to citizens of Fushe Kosova.</p>
    </section>

    <section id="services" class="content-section services-section">
        <h2>Our Services</h2>
        <div class="service-grid">
            <a href="details.html?service=health" class="service-card">
                <span class="icon-circle">🏥</span>
                <h3>Healthcare</h3>
            </a>
            <a href="details.html?service=education" class="service-card">
                <span class="icon-circle">🎓</span>
                <h3>Education</h3>
            </a>
            <a href="details.html?service=admin" class="service-card">
                <span class="icon-circle">🏛️</span>
                <h3>Municipal Administration</h3>
            </a>
            <a href="details.html?service=transport" class="service-card">
                <span class="icon-circle">🚆</span>
                <h3>Transport</h3>
            </a>
            <a href="details.html?service=documents" class="service-card">
                <span class="icon-circle">📄</span>
                <h3>Documents</h3>
            </a>
            <a href="details.html?service=requests" class="service-card">
                <span class="icon-circle">✔️</span>
                <h3>Online Requests</h3>
            </a>
        </div>
    </section>

    <section id="events" class="content-section events-section">
        
        <div class="event-card glass-box">
            <h3>Smart City Innovation Day</h3>
            <p>Date: 12 April 2025</p>
            <p>Location: Fushe Kosove Municipality Hall</p>
            <p>Join us to explore new digital services and meet local innovators.</p>
        </div>
        <div class="event-card glass-box">
            <h3>Community Clean-Up</h3>
            <p>Date: 25 April 2025</p>
            <p>Volunteers will gather in the city park to support a cleaner environment.</p>

        </div>    
    </section>
    
    <section id="news" class="content-section news-section">   
         <h2>Latest Announcements</h2>
         <div class="news-grid">
            <div class="news-card">
                <h3>Road Infratstructure Update</h3>
                <p>The municipality has started road reconstruction in the central area. Expected completion: March 2025.</p>
            </div>

            <div class="news-card">
                <h3>New School Renovation</h3>
                <p>Renovation of "Dardania" School is underway with new classrooms and digital equipment.</p>
            </div>

            <div class="news-card">
                <h3>Train Schedules Changes</h3>
                <p>Update Train schedules for Prishtina-Fushe Kosova route starting next week.</p>
            </div>
        </div>
    </section>
    <section  id="statistics" class="content-section stats-section">
        <h2>City statistics</h2>
        <div class="stats-grid">
            <div class="stat-box">
                <h3>Population</h3>
                <p>38,000+</p>
            </div>
            <div class="stat-box">
                <h3>Public Schools</h3>
                <p>12</p>
            </div>
            <div class="stat-box">
                <h3>Daily Train Passengers</h3>
                <p>5,500+</p>
            </div>
        </div>        
    </section>

    <section id="emergency" class="content-section">
        <h2>Emergency Contacts</h2>
        <div class="emergency-grid">
            <div class="emergency-box">
                <h3>Police</h3>
                <p>192</p>
            </div>
            <div class="emergency-box">
                <h3>Fire Department</h3>
                <p>193</p>
            </div>
            <div class="emergency-box">
                <h3>Ambulance</h3>
                <p>194</p>
            </div>
        </div>
    </section>

    <section id="contact" class="content-section">
        <h2>Contact</h2>
        <p>For any issues, suggestions or support, you can contact the municipal administration</p>
        
        <form id="contactForm" class="contact-form">

            <label>Name</label>
            <input type="text" name="name" required>
            
            <label>Email</label>
            <input type="email" name="email" required>

            <label>Message</label>
            <textarea name="message" rows="4" required></textarea>

            <p id="contactError" class="form-error"></p>

            <button type="submit" class="btn-primary">Send</button>
        </form>
    </section>


    <section id="login" class="content-section login-section">
        <h2>Login</h2>

        <form method="post" action="login.php" class="login-form">

            <label>Email Address</label>
            <input type="email" name="email" placeholder="Enter your email" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>

            <button type="submit" class="btn-primary">Login</button>

            <p class="small-text">
                Don't have an account?.
                <a href="register.php">Register</a>
            </p>

        </form>
    </section>


    <section id="faq" class="content-section faq-section">
        <h2>FAQ</h2>
        <div class="faq-item">
            <h3>How can i access online services?</h3>
            <p>You can browse through the Services section and choose the service you need.</p>
        </div>
        <div class="faq-item">
            <h3>Where can i find contact information?</h3>
            <p>All contact details are listed in the Conatct section at the bottom of the page.</p>
        </div>
    </section>  
    
    <section id="alerts" class="content-section alerts-section">
        <h2>Emergency Alerts</h2>
        <div class="alert-box">
            <strong>Traffic Alert:</strong> Road blocked near City Center due tto maintenance work.
        </div>

        <div class="alert-box">
            <strong>Weather Warning:</strong>Heavy rain expected tonight. Drive safely.</strong>
        </div>
    </section>
                
    <footer class="main-footer">
        <p>© 2025 Smart City Web Portal - Fushe Kosova</p>
    </footer>

    <script src="js/index.js"></script>

</body>
</html>
