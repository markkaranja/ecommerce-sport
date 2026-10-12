INSERT INTO categories (nom) VALUES
    ('Chaussures'),
    ('Vêtements'),
    ('Ballons'),
    ('Accessoires');

-- Produits
INSERT INTO produits (nom, description, prix, stock, image, note_moyenne, id_categorie) VALUES
    ('Chaussures de running Vitesse 3',
    'Chaussures légères avec semelle amortissante, idéales pour la course sur route.',
    89.99, 25, 'images/produits/running-vitesse-3.jpg', 4.5, 1),
    ('Maillot de cyclisme Aero Pro', 'Un maillot de cyclisme haut de gamme ultra-léger.',
     217.95,0, 'images/produits/cyclisme-aero-pro.jpg', 3.5, 2),
    ('Ballon de football Match Pro',
    'Ballon taille 5 cousu main, conçu pour les matchs officiels.',
    34.90, 0, 'images/produits/ballon-match-pro.jpg', NULL, 3),
    ('Montre GPS Trail 55',
     'La montre connectée idéale pour la course à pied, le cardio et le suivi de santé au quotidien.',
     150,20,'images/produits/gps-trail-55.jpg', 5, 4);
