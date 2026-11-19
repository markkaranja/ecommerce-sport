<?php

declare(strict_types=1);

$pdo = require __DIR__ . '/../src/database.php';

try {
    $stmt = $pdo->query('SELECT nom, prix FROM `produits`');
    $produits = $stmt->fetchAll();
} catch (PDOException $e) {
    // Détail technique dans le journal du serveur, message neutre pour le visiteur
    error_log('Lecture des produits impossible : ' . $e->getMessage());
    http_response_code(500);
    exit('Une erreur est survenue. Veuillez réessayer plus tard.');
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
        echo '<li>' . htmlspecialchars($produit['nom']) . ' - ' . number_format((float) $produit['prix'], 2, ',', ' ') . ' €</li>' . "\n";
    }

    ?>
</ul>

</body>
</html>

