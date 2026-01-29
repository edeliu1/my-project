<?php

require __DIR__ . '/_guard.php';

require __DIR__ . '/../../app/core/Database.php';
$config = require __DIR__ . '/../../config/config.php';

$db = new Database($config);
$pdo = $db ->getPdo();