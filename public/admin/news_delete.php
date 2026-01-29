<?php
if(!isset($_SESSION['user'])){
    header("Location: ../login.php");
    exit;
}
if(strtolower((string)($_SESSION['user']['role'] ?? '')) !== 'admin'){
    header("Location: ../index.php");
    exit;
}
require __DIR__ . '/_guard.php';
require __DIR__ . '/_db.php';
require __DIR__ . '/_csrf.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: news_admin.php");
    exit;
}

csrf_check();

$id = (int)($_POST['id'] ?? 0);
if($id <= 0){
    header("Location: news_admin.php?err=invalid");
    exit;
}

$stmt =$pdo->prepare("DELETE FROM news WHERE id = ?");
$stmt->execute([$id]);

header("Location: news_admin.php?msg=deleted");
exit;
