<?php
require __DIR__ . '/_guard.php';
require __DIR__ . '/_db.php';

$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
}
header("Location: products_admin.php");
exit;
