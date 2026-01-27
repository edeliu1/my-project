<?php
session_start();

require_DIR_.'/../app/core/Database.php';
$config = require_DIR_.'/../config/config.php';
$db = new Database($config);


$error = '';

if ($_SERVER['REQUEST_METHOD'] ==='POST'){
$email = trim ( $_POST['email']??"); 

$password = $_POST['password'] ??";






}
