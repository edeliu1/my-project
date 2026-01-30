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

         





 
