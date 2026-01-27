<?php
session_start();

require __DIR__ . '/../app/core/Database.php';
$config = require __DIR__ . '/../config/config.php';

$db = new Database($config);

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email'] ?? ''); 
    $password = $_POST['password'] ?? '';

    if($email === '' || $password === '') {
        $error = 'Ploteso email dhe password!';
    } else {
        $stmt = $db->getPdo()->prepare("SELECT id,name,email,password_hash, role FROM users WHERE email =? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password,$user['password_hash'])){
            $_SESSION['user'] = [
                'id' => (int)$user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ];

            if (strtolower((string)$user['role']) === 'admin'){
                header("Location:/my-project/public/dashboard.php");
                exit;
            }
            header("Location:/my-project/public/index.php");
            exit;
        } else {
            $error = 'Email ose password eshte gabimi!';
        }
    }
}

include __DIR__ . '/login.view.php';