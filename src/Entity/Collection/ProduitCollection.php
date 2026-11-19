<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Produit;
use PDO;

class ProduitCollection
{
    /**
     * Rechercher des produits par texte (dans le nom ou la description) et par catégorie.
     *
     * @param string $texte Texte recherché ('' = tous les produits)
     * @param int $idCategorie Catégorie choisie (0 = toutes)
     *
     * @return Produit[]
     */
    public static function rechercher(string $texte, int $idCategorie): array
    {
        $sql = 'SELECT p.id_produit AS id, p.nom, p.description, p.prix, p.stock, p.image,
                       p.note_moyenne AS noteMoyenne, p.id_categorie AS idCategorie,
                       c.nom AS nomCategorie
                FROM produits p
                JOIN categories c ON c.id_categorie = p.id_categorie
                WHERE (p.nom LIKE :nom OR p.description LIKE :description)';

        // Si une catégorie est choisie, on ajoute ce filtre
        if ($idCategorie > 0) {
            $sql .= ' AND p.id_categorie = :idCategorie';
        }

        $sql .= ' ORDER BY p.nom';

        $stmt = MyPdo::getInstance()->prepare($sql);

        $stmt->bindValue(':nom', '%' . $texte . '%');
        $stmt->bindValue(':description', '%' . $texte . '%');

        if ($idCategorie > 0) {
            $stmt->bindValue(':idCategorie', $idCategorie, PDO::PARAM_INT);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Produit::class);
    }
}
