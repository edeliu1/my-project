<?php
require __DIR__ . '/../app/core/Database.php';

$config = require __DIR__ . '/../config/config.php';

try {
    $db = new Database($config);
    echo "DB connected successfully ✅";
} catch (Throwable $e) {
    echo "DB connection failed ❌<br>";
    echo $e->getMessage();
}
