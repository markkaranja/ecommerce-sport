<?php

declare(strict_types=1);

$config = require __DIR__ . '/../config/config.php';

$dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset'] . ';port=' . $config['port'];

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // erreurs SQL = exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,                  // vraies requêtes préparées
];

try {
    $pdo = new PDO($dsn, $config['user'], $config['password'], $options);
} catch (PDOException $e) {
    error_log('Connexion à la base impossible : ' . $e->getMessage());
    http_response_code(500);
    exit('Le site est momentanément indisponible. Veuillez réessayer plus tard.');
}

return $pdo;