<?phpsession_start();
$user = $_SESSION['user'] ?? null;
?>
<DOCTYPE html>
    <html lang="en">
   <head>
  <meta charset="UTF-8">
 <title>Healthcare Services</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../css/healthcare.css">
</head>
<body>

<header class="main-header">
<div class="logo-area">
<img src="../images/logo.fk.png" alt="Fushe Kosova Logo">
 <span class="portal-name">Fushe Kosova</span>
</div>

  <nav class="main-nav">
 <ul>
    <li><a href="../index.php">Home</a></li>
    <li><a href="../about.php">About us</a></li>
     <li><a href="../services.php" class="active">Services</a></li>
    <li><a href="../contact.php">Contact</a></li>