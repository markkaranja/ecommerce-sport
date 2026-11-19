<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Database\MyPdo;
use Entity\Collection\CategorieCollection;
use Entity\Collection\ProduitCollection;
use Html\AppWebPage;

// Configuration de la connexion à partir de config/config.php
$config = require __DIR__ . '/../config/config.php';
MyPdo::setConfiguration(
    "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}",
    $config['user'],
    $config['password'],
    [PDO::ATTR_EMULATE_PREPARES => false] // vraies requêtes préparées
);

// Ce que l'utilisateur a choisi dans le formulaire (dans l'URL)
$recherche   = trim((string) ($_GET['q'] ?? ''));   // texte tapé ('' si rien)
$idCategorie = (int) ($_GET['categorie'] ?? 0);      // numéro de catégorie (0 = toutes)

$webPage = new AppWebPage('Nos produits');

try {
    $categories = CategorieCollection::findAll();
    $produits   = ProduitCollection::rechercher($recherche, $idCategorie);
} catch (PDOException $e) {
    // Détail technique dans le journal du serveur, message neutre pour le visiteur
    error_log('Lecture des produits impossible : ' . $e->getMessage());
    http_response_code(500);
    $webPage->appendContent('<p>Une erreur est survenue. Veuillez réessayer plus tard.</p>');
    echo $webPage->toHTML();
    exit();
}

// ---------- Formulaire de recherche ----------
$rechercheSecurisee = $webPage->escapeString($recherche);

$formHtml = <<<HTML
<form method="get" action="index.php" class="recherche">
    <label for="q">Rechercher</label>
    <input type="search" id="q" name="q" value="{$rechercheSecurisee}">

    <label for="categorie">Catégorie</label>
    <select id="categorie" name="categorie">
        <option value="0">Toutes</option>
HTML;

foreach ($categories as $categorie) {
    $selected = ($categorie->getId() === $idCategorie) ? 'selected' : '';
    $nomCategorie = $webPage->escapeString($categorie->getNom());
    $formHtml .= "<option value=\"{$categorie->getId()}\" {$selected}>{$nomCategorie}</option>\n";
}

$formHtml .= <<<HTML
    </select>

    <button type="submit">Rechercher</button>
</form>
HTML;

$webPage->appendContent($formHtml);

// ---------- Nombre de résultats ----------
$nombre = count($produits);
$webPage->appendContent(<<<HTML
<p class="resultats">
    {$nombre} produit(s) trouvé(s) — <a href="index.php">Afficher tous les produits</a>
</p>
HTML);

// ---------- Liste des produits ----------
if ($nombre === 0) {
    $webPage->appendContent('<p>Aucun produit ne correspond à votre recherche.</p>');
} else {
    $webPage->appendContent("<ul>\n");

    foreach ($produits as $produit) {
        $nom = $webPage->escapeString($produit->getNom());
        $prix = number_format($produit->getPrix(), 2, ',', ' ');
        $categorie = $webPage->escapeString($produit->getNomCategorie());
        $rupture = $produit->estEnRupture() ? '<strong class="rupture">Rupture de stock</strong>' : '';

        $webPage->appendContent(<<<HTML
            <li>
                {$nom} - {$prix} €
                <span class="categorie">({$categorie})</span>
                {$rupture}
            </li>\n
        HTML);
    }

    $webPage->appendContent("</ul>\n");
}

echo $webPage->toHTML();
