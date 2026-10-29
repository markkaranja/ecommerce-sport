<?php

declare(strict_types=1);

$pdo = require __DIR__ . '/../src/database.php';

try {
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
    <link rel="stylesheet" href="css/style.css">
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

