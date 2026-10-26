<?php

declare(strict_types=1);

$config = require __DIR__ . '/../config/config.php';

$dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset'] . ';port=' . $config['port'];

$options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

try {
    $pdo = new PDO($dsn, $config['user'], $config['password'], $options);
} catch (PDOException $e) {
    exit('Erreur : ' . $e->getMessage());
}

return $pdo;