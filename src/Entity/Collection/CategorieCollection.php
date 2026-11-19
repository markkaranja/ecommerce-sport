<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Categorie;
use PDO;

class CategorieCollection
{
    /**
     * Toutes les catégories, triées par nom.
     *
     * @return Categorie[]
     */
    public static function findAll(): array
    {
        // id_categorie AS id : on renomme la colonne pour qu'elle corresponde à l'attribut $id de Categorie
        $stmt = MyPdo::getInstance()->query('SELECT id_categorie AS id, nom FROM categories ORDER BY nom');

        return $stmt->fetchAll(PDO::FETCH_CLASS, Categorie::class);
    }
}
