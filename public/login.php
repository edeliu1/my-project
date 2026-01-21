<?php
session_start();

require __DIR__ . '/../app/core/Database.php';
$config = require __DIR__ . '/../config/config.php';
$db = new Database($config);

$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if($email === '' || $password === '') {
        $error = 'Ploteso email dhe password!';
    }else{
        $stmt = $db -> getPdo() -> prepare("SELECT id, name, email, password_hash, role FROM users WHERE email = ? LIMIT 1");
        $stmt -> execute([$email]);
        $user = $stmt -> fetch();

        if ($user && password_verify($password, $user['password_hash'])){
            $_SESSION['user'] = [
                'id' => (int)$user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ];
            $_SESSION['user'] = [ /* ... */ ];
echo "SESSION SET OK. <pre>"; print_r($_SESSION); echo "</pre>";
exit;


            if($user['role'] === 'admin'){
                header("Location: /my-project/public/dashboard.php");
            }else{
                header("Location: /my-project/public/index.html");
            }
            exit;
        }else{
            $error = 'Email ose password eshte gabim!';
        }
    }
}

include __DIR__ . '/login.html';
