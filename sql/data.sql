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
     150,20,'images/produits/gps-trail-55.jpg', 5, 4),
    ('Chaussures de sprint',
     'Chaussures légères, idéales pour le sprint.',
     142.99,20,'images/produits/chaussures-sprint.jpg', 2, 1),
    ('Chaussures de foot',
     'Chaussures légères, idéales pour le foot.',
     120.95,20,'images/produits/chaussures-foot.jpg', 3.5, 1),
    ('Chaussures de basket',
     'Chaussures légères, idéales pour le basket.',
     70.99,20,'images/produits/chaussures-basket.jpg', NULL, 1),
    ('Maillot de foot FC Horizon',
     'Maillot domicile du FC Horizon, tissu respirant pour homme.',
     79.99, 24, 'images/produits/maillot-foot-fc-horizon.jpg', 4.7, 2),
    ('T-shirt Muscu Fit',
     'Un t-shirt de compression très agréable pour tout type d''entraînement.',
     29.99, 50, 'images/produits/t-shirt-muscu-fit.jpg', 4.9, 2),
    ('Ballon de basket',
     'Ballon taille 6, conçu pour les matchs officiels.',
     25.90, 30, 'images/produits/ballon-basket.jpg', 1.2, 3),
    ('Balles de tennis (tube de 3)',
     'Balles pressurisées adaptées à toutes les surfaces, du club au tournoi.',
     6.99, 5, 'images/produits/balles-tennis.jpg', NULL, 3),
    ('Bandes élastiques de musculation',
     'Résistants, les élastiques tiennent le choc face à vos séances les plus intenses.',
     24.99, 20, 'images/produits/bandes-elastiques.jpg', 3.1, 4),
    ('Coussin d''équilibre fitness',
     'Ce coussin d''équilibre fitness accompagne vos séances de gainage et de rééducation.',
     34.99, 1, 'images/produits/coussin-equilibre.jpg', 2.1, 4);



