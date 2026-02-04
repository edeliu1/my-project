<?php
require __DIR__ . '/_guard.php';
require __DIR__ . '/_db.php';
require __DIR__ . '/_csrf.php';
require __DIR__ . '/_audit.php';

audit_log(
    $pdo,
    (int)$_SESSION['user']['id'],
    'UPDATE_USER_ROLE',
    "Changed role of user ID $id to $role"
);


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: users_admin.php");
    exit;
}

csrf_check();

$id = (int)($_POST['id'] ?? 0);
$role = $_POST['role'] ?? 'user';
$role = ($role === 'admin') ? 'admin' : 'user';

if ($id <= 0) {
    header("Location: users_admin.php?err=badid");
    exit;
}

$myId = (int)($_SESSION['user']['id'] ?? 0);
if ($id === $myId) {
    header("Location: users_admin.php?err=self");
    exit;
}

$stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
$stmt->execute([$role, $id]);

header("Location: users_admin.php?ok=role");
exit;
