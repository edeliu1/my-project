<?php
require __DIR__ . '/_guard.php';
require __DIR__ . '/_db.php';
require __DIR__ . '/_csrf.php';
require __DIR__ . '/_audit.php';

audit_log(
    $pdo,
    (int)$_SESSION['user']['id'],
    'DELETE_USER',
    "Deleted user ID $id"
);


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: users_admin.php");
    exit;
}

csrf_check();

$id = (int)($_POST['id'] ?? 0);

if ($id <= 0) {
    header("Location: users_admin.php?err=badid");
    exit;
}

$myId = (int)($_SESSION['user']['id'] ?? 0);
if ($id === $myId) {
    header("Location: users_admin.php?err=self");
    exit;
}

$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$id]);

header("Location: users_admin.php?ok=deleted");
exit;
