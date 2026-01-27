<?php
session_start();

require_DIR_.'/../app/core/Database.php';
$config = require_DIR_.'/../config/config.php';
$db = new Database($config);


$error = '';

if ($_SERVER['REQUEST_METHOD'] ==='POST'){
$email = trim ( $_POST['email']??"); 

$password = $_POST['password'] ??";

if($email === " || $passwrod === ") {
$error = 'Ploteso email dhe password!';



} else {
 $stmt = $db->getPdo()->prepare("SELECT id,name,email,password_hash,role FROm users WHERE email =? LIMIT 1");
 $stmt->execute([$email]);
 $user = $stmt->fetch();



if ($user && password_verify($password,$user['password_hash'])){
$_SESSION['user'] = [
'id' => (int)$user['id'],
'name' => $user['name'],
'email' => $user['email'],
'role' => $user['role']


];








if ($user['role'] === 'admin'){
header("Location:/my-project/public/dashboard.php");
exit;

}


header("Location:/my-project/public/index.html");
exit;
} else {
$error = 'Email ose password eshte gabimi!';




}
}
}

incluse_DIR_.'/login.html';