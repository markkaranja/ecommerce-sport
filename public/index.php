<?php

declare(strict_types=1);

$config = require __DIR__ . '/../config/config.php';

$dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset'] . ';port=' . $config['port'];

$options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

try {
    $pdo = new PDO($dsn, $config['user'], $config['password'], $options);
    $stmt = $pdo->query('SELECT nom, prix FROM `produits`');
    $produits = $stmt->fetchAll();
} catch (PDOException $e) {
    exit($e->getMessage());
}

?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>GoatSport</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h1>Nos produits</h1>
<ul>

    <?php

    foreach ($produits as $produit) {
        echo '<li>' . htmlspecialchars($produit['nom']) . ' - ' . htmlspecialchars($produit['prix']) . ' €</li>' . "\n";
    }

    ?>
</ul>

</body>
</html>

