<?php
require _DIR_ . '/_guard.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $name  = trim($_POST['name'] ?? '');
 $email = trim($_POST['email'] ?? '');

 if ($name === '' || $email === '') {
     $error = "Fill in your name and email.";
 }  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
                                               
   }
 }
}               


$stmt = $pdo->prepare("SELECT id, name, email, role, created_at FROM users WHERE id = ? LIMIT 1");
 $stmt->execute([(int)$user['id']]);
$me = $stmt->fetch();
 ?>
 <!DOCTYPE html>
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

        <?php if ($error): ?>
                <div style="padding:12px;border:1px solid fecaca;background:#fff1f2;border-radius:12px;margin:14px 0;">
                          <?php echo htmlspecialchars($error); ?>
        </div>
          <?php endif; ?>

            <?php if ($success): ?>
                    <div style="padding:12px;border:1px solid #bbf7d0;background:#f0fdf4;border-radius:12px;margin:14px 0;">
                              <?php echo htmlspecialchars($success); ?>
            </div>
              <?php endif; ?>

                <form method="post" class="contact-form">
                        <label>Name</label>
                            <input name="name" value="<?php echo htmlspecialchars($me['name'] ?? ''); ?>" required>

                                <label>Email</label>
                                    <input type="email" name="email" value="<?php echo htmlspecialchars($me['email'] ?? ''); ?>" required>

                                        <button class="btn-primary" type="submit">Save</button>
            </form>

              <p style="margin-top:18px;opacity:.8;">
                    Account created: <?php echo htmlspecialchars($me['created_at'] ?? ''); ?>
            </p>

              <div class="actions" style="margin-top:18px;">
                    <a class="logout" href="dashboard.php">Back</a>
            </div>
            </div>
            </body>
            </html>
   

                     





 
