<?php

declare(strict_types=1);

namespace Entity;

/**
 * Une catégorie de produits (table categories).
 */
class Categorie
{
    private int $id;
    private string $nom;

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }
}
