-- ============================================================
-- Schéma de la base e-commerce (MySQL 8)
-- ============================================================

-- Suppression dans l'ordre INVERSE de la création
DROP TABLE IF EXISTS lignes_commandes;
DROP TABLE IF EXISTS commandes;
DROP TABLE IF EXISTS produits;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS utilisateurs;

-- ============================================================
-- Table : utilisateurs  (héritage Utilisateur/Client/Admin, méthode "une seule table")
-- ============================================================
CREATE TABLE utilisateurs (
    id_utilisateur INT          AUTO_INCREMENT PRIMARY KEY,
    nom            VARCHAR(100) NOT NULL,
    prenom         VARCHAR(100) NOT NULL,
    email          VARCHAR(255) NOT NULL UNIQUE,
    mot_de_passe   VARCHAR(255) NOT NULL,                  -- hachage password_hash()
    role           VARCHAR(10)  NOT NULL DEFAULT 'CLIENT', -- discriminant
    telephone      VARCHAR(20)  NULL,                      -- NULL pour un admin
    adresse        VARCHAR(255) NULL,                      -- NULL pour un admin

    CONSTRAINT CHK_EMAIL CHECK (email LIKE '%_@_%._%'),
    CONSTRAINT CHK_ROLE  CHECK (role IN ('CLIENT', 'ADMIN'))
);

-- ============================================================
-- Table : categories
-- ============================================================
CREATE TABLE categories (
    id_categorie INT          AUTO_INCREMENT PRIMARY KEY,
    nom          VARCHAR(100) NOT NULL UNIQUE
);

-- ============================================================
-- Table : produits
-- ============================================================
CREATE TABLE produits (
    id_produit   INT           AUTO_INCREMENT PRIMARY KEY,
    nom          VARCHAR(150)  NOT NULL,
    description  TEXT          NULL,
    prix         DECIMAL(10,2) NOT NULL,
    stock        INT           NOT NULL DEFAULT 0,
    image        VARCHAR(255)  NULL,                -- chemin : images/nike-air.jpg
    note_moyenne DECIMAL(2,1)  NULL,                -- NULL = pas encore noté
    id_categorie INT           NOT NULL,            -- max 1 côté Categorie

    CONSTRAINT CHK_PRIX  CHECK (prix > 0),
    CONSTRAINT CHK_STOCK CHECK (stock >= 0),
    CONSTRAINT CHK_NOTE  CHECK (note_moyenne BETWEEN 0 AND 5),

    CONSTRAINT FK_PRODUIT_CATEGORIE FOREIGN KEY (id_categorie)
        REFERENCES categories (id_categorie)
);

-- ============================================================
-- Table : commandes  (le panier = une commande EN_ATTENTE)
-- ============================================================
CREATE TABLE commandes (
    id_commande     INT         AUTO_INCREMENT PRIMARY KEY,
    date_commande   DATETIME    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_expedition DATETIME    NULL,               -- inconnue à la création
    date_livraison  DATETIME    NULL,               -- inconnue à la création
    statut          VARCHAR(20) NOT NULL DEFAULT 'EN_ATTENTE',
    id_utilisateur  INT         NOT NULL,           -- max 1 côté Client

    CONSTRAINT CHK_STATUT CHECK (statut IN ('EN_ATTENTE', 'PAYEE', 'EXPEDIEE', 'LIVREE', 'ANNULEE')),
    CONSTRAINT CHK_DATE_EXPEDITION CHECK (date_expedition >= date_commande),
    CONSTRAINT CHK_DATE_LIVRAISON  CHECK (date_livraison  >= date_expedition),

    CONSTRAINT FK_COMMANDE_UTILISATEUR FOREIGN KEY (id_utilisateur)
        REFERENCES utilisateurs (id_utilisateur)
);

-- ============================================================
-- Table : lignes_commandes  (classe d'association Commande–Produit)
-- ============================================================
CREATE TABLE lignes_commandes (
    id_commande   INT           NOT NULL,
    id_produit    INT           NOT NULL,
    quantite      INT           NOT NULL,
    prix_unitaire DECIMAL(10,2) NOT NULL,           -- prix figé au moment de l'achat

    CONSTRAINT PK_LIGNES_COMMANDES PRIMARY KEY (id_commande, id_produit),
    CONSTRAINT CHK_QUANTITE  CHECK (quantite > 0),
    CONSTRAINT CHK_PRIX_UNIT CHECK (prix_unitaire >= 0),

    CONSTRAINT FK_LIGNE_COMMANDE FOREIGN KEY (id_commande)
        REFERENCES commandes (id_commande)
        ON DELETE CASCADE,                          -- composition
    CONSTRAINT FK_LIGNE_PRODUIT FOREIGN KEY (id_produit)
        REFERENCES produits (id_produit)
);

