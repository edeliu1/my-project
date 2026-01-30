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

 





 
