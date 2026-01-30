<?php
session_start();

require_once _DIR_ . '/../admin/_db.php';

if (isset($_SESSION['user'])) {
        header("Location: ../login.php");
        exit;
}
