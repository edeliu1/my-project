<?php
function audit_log(PDO $pdo, int $adminId, string $action, string $description): void
{
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

    $stmt = $pdo->prepare(
        "INSERT INTO admin_audit_log (admin_id, action, description, ip_address)
         VALUES (?, ?, ?, ?)"
    );
    $stmt->execute([$adminId, $action, $description, $ip]);
}
