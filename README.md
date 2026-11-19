# ecommerce-sport

Site e-commerce de sport fictif (**GoatSport**) : catalogue, panier, commandes.
Développé en **PHP 8 orienté objet**, **MySQL** et **JavaScript**, sans framework.

## Fonctionnalités

### Déjà réalisées
- **Catalogue des produits** : nom, prix au format français (`89,99 €`), catégorie, mention « Rupture de stock » quand le stock est à 0.
- **Recherche** dans le nom et la description des produits (sans tenir compte des majuscules ni des accents).
- **Filtre par catégorie** (Chaussures, Vêtements, Ballons, Accessoires), combinable avec la recherche.
- **Sécurité** :
  - requêtes préparées contre l'injection SQL ;
  - textes affichés protégés avec `htmlspecialchars()` contre le XSS ;
  - erreurs techniques écrites dans le journal du serveur, jamais affichées au visiteur (code HTTP 500 et message neutre).

### Prévues
1. Page détail d'un produit
2. Inscription et connexion (clients et administrateurs)
3. Panier
4. Passage de commande
5. Espace administrateur

## Technologies
- PHP 8.1 ou plus (orienté objet, `declare(strict_types=1)`)
- MySQL 8 avec PDO
- Composer (chargement automatique des classes, PSR-4)
- HTML / CSS

## Organisation du projet
```
config/              Configuration de la base (config.php non versionné)
docs/                Diagramme de classes UML et diagramme de la base
public/              Racine du site (pages accessibles depuis le navigateur)
├── index.php        Catalogue avec recherche et filtre
└── css/style.css
sql/
├── schema.sql       Création des 5 tables
└── data.sql         Données de démonstration (4 catégories, 13 produits)
src/                 Classes PHP
├── Database/MyPdo.php                  Connexion unique à la base (singleton)
├── Entity/Produit.php, Categorie.php   Les objets métier
├── Entity/Collection/                  Lecture des listes en base (ProduitCollection, CategorieCollection)
└── Html/WebPage.php, AppWebPage.php    Construction des pages HTML
```

## Base de données
5 tables : `utilisateurs`, `categories`, `produits`, `commandes`, `lignes_commandes`.
- Clients et administrateurs sont dans la même table `utilisateurs` (colonne `role`).
- Le panier est une commande au statut `EN_ATTENTE`.
- `lignes_commandes` garde le prix du produit au moment de l'achat.
- Des contraintes vérifient les données (prix > 0, stock ≥ 0, note entre 0 et 5, statut de commande valide…).

## Installation
1. Cloner le dépôt dans le dossier web du serveur (par exemple `C:\Ampps\www`).
2. Installer l'autoload de Composer :
   ```
   composer install
   ```
3. Créer la base de données, puis importer dans l'ordre `sql/schema.sql` et `sql/data.sql`.
4. Copier `config/config.example.php` en `config/config.php` et y mettre les identifiants de la base.
5. Ouvrir `http://localhost/ecommerce-sport/public/`.

## Licence
MIT
