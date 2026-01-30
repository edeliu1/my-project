<?phprequire _DIR_ . '/_guard.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $name  = trim($_POST['name'] ?? '');
 $email = trim($_POST['email'] ?? '');

 if ($name === '' || $email === '') {
     $error = "Fill in your name and email.";
 }  elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = "Email not valid.";
 } else {

 $chk = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id <> ?");
$chk->execute([$email, (int)$user['id']]);
   if ($chk->fetch()) {
    $error = "This email is already in use by another user.";
   }else {
       $upd = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
         $upd->execute([$name, $email, (int)$user['id']]);

   $_SESSION['user']['name'] = $name;
     $_SESSION['user']['email'] = $email;
     $user = $_SESSION['user'];
                           
     $success = "Profile updated successfully.";
                                               
                                           


$stmt = $pdo->prepare("SELECT id, name, email, role, created_at FROM users WHERE id = ? LIMIT 1");
 $stmt->execute([(int)$user['id']]);
$me = $stmt->fetch();
 ?>
 <doctype html>
 <html>
 <head>
        <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>My Profile</title>
     <link rel="stylesheet" href="../admin/dashboard.css">
</head>
<body>
    <div class="page">
          <h2>My Profile</h2>

                     





 
