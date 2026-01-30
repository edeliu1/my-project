 <?php
session_start();
$user = $_SESSION['user'] ?? null;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Documents - Smart City</title>
  <link rel="stylesheet" href="../css/index.css">
  <link rel="stylesheet" href="documents.css">
</head>

<body>
    <header class="headeri">
        <div class="llogo">
            <img src="../images/logo.fk.png" alt="Fushe Kosova Logo">
            <span class="emri-portalit">Fushe Kosova</span>
</div>
<nav class="navigation-bar">
    <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="../about.php">About us</a></li>
        <li><a href="../services.php" class="active">Services</a></li>
        <li><a href="../contact.php">Contact</a></li>
        <li><a href="../login.php">Login</a></li>
</ul>
</nav>
</header>

<div class="faqja-service">
    <div class="pjesa-lart">
        <div>
            <div class="breadcrumbs">Services / Documents</div>
            <h2 class="titulli-faqes">Documents</h2>
            <p class="subtitle">Here you will find the most requested documents and certificates in the municipality (demo). For each document: what is required, where to apply and how long it takes.</p>
</div>
<a class="button" href="../services.php">Back</a>
</div>

<div class="grid2">
    <div class="karta">
        <h3 class="section-title">Common Documents</h3>
        <div class="lista" id="lista-dokumenteve">
            <div class="gjerat">
                <h4><span class="tag">Civil Status</span>Birth Certificate</h4>
                <div class="meta">It is often required for registrations, employment, banking.</div>
                <div class="meta"><b>Documents: </b>Passport • (if for someone else: authorization)</div>
                <div class="meta"><b>Time: </b> 5-15 minutes</div>
            </div>
            <div class="gjerat">
                <h4><span class="tag">Civil Status</span>Marriage Certificate</h4>
                <div class="meta"><b>Documents: </b>ID card • Spouses' data</div>
                <div class="meta"><b>Time: </b> 5-15 minutes</div>
            </div>
            <div class="gjerat">
                <h4><span class="tag">Civil Status</span>Death Certificate</h4>
                <div class="meta"><b>Documents: </b>ID card • Family Relationship (when required)</div>
                <div class="meta"><b>Time: </b> 10-20 minutes</div>
            </div>
            <div class="gjerat">
                <h4><span class="tag">Residence</span>Residence Certificate</h4>
                <div class="meta"><b>Documents: </b>ID card • Correct Address</div>
                <div class="meta"><b>Time: </b> 10-30 minutes</div>
            </div>
            <div class="gjerat">
                <h4><span class="tag">Family</span>Family Certificate</h4>
                <div class="meta"><b>Documents: </b>ID card • (when required) Personal Number</div>
                <div class="meta"><b>Time: </b> 5-15 minutes</div>
            </div>
            <div class="gjerat">
                <h4><span class="tag">Property</span>Ownership Certificate / Register</h4>
                <div class="meta"><b>Documents: </b>ID card • Parcel / Property Number</div>
                <div class="meta"><b>Time: </b> 1–3 business days (depending on the procedure)</div>
            </div>
            <div class="gjerat">
                <h4><span class="tag">Business</span>Business Activity Certificate</h4>
                <div class="meta"><b>Documents: </b>ID card • Business Data</div>
                <div class="meta"><b>Time: </b> 1 business day</div>
            </div>
            <div class="gjerat">
                <h4><span class="tag">General</span>Certification / General Declaration</h4>
                <div class="meta"><b>Documents: </b>Passport • Request Description</div>
                <div class="meta"><b>Time: </b> 15-60 minutes</div>
            </div>
        </div>

        <div class="karta">
            <h3 class="section-title">Search Document</h3>
            
            <div class="searchbox">
                <input id="q" type="text" placeholder="example:residential, family, property...">
                <button class="butoni" type="button" onclick="filterDocs()">Search</button>
            </div>

            <h4 class="titull-mini">Orari</h4>
            <div class="meta">Monday-Friday: 08:00-16:00</div>
            <div class="meta">Pause: 12:00-12:30</div>

            <h4 class="titull-mini spaced">Advice</h4>
            <div class="meta">If you are requesting a document for someone else, you usually need <b>authorization</b> or proof of family relationship.</div>
    </div>
</div>
<script src="documents.js"></script>
</body>
</html>



