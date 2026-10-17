<?php

declare(strict_types=1);

$config = require __DIR__ . '/../config/config.php';

$dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset'] . ';port=' . $config['port'];

try {
    $pdo = new PDO($dsn, $config['user'], $config['password']);
    echo "Connexion réussi";
    $stmt = $pdo->query('SELECT COUNT(*) FROM `produits`');
    echo $stmt->fetchColumn();
} catch (PDOException $e) {
    exit($e->getMessage());
}