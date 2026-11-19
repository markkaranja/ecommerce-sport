<?php

declare(strict_types=1);

namespace Entity;

/**
 * Un produit du catalogue (table produits).
 */
class Produit
{
    private int $id;
    private string $nom;
    private ?string $description;
    private float $prix;
    private int $stock;
    private ?string $image;
    private ?float $noteMoyenne;
    private int $idCategorie;
    private ?string $nomCategorie = null; // rempli par la jointure avec categories

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getNoteMoyenne(): ?float
    {
        return $this->noteMoyenne;
    }

    public function getIdCategorie(): int
    {
        return $this->idCategorie;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    /**
     * Le produit est-il en rupture de stock ?
     */
    public function estEnRupture(): bool
    {
        return $this->stock === 0;
    }
}
