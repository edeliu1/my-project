<?php
session_start();
$user = $_SESSION['user'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/details.css">
</head>
<body>
    <section class="details-wrap">
        <div class="details-card">
            <h2 id="service-title">Loading...</h2>
            <p id="service-description"></p>
            <a class="back-link" href="index.html#services"> Back to services</a>
        </div>
    </section>
</body>
</html>

