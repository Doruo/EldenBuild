

INSERT INTO voiture(immatriculation,marque,couleur,nbSieges)
VALUES('AB123CD', 'Renault', 'Rouge', 5),
      ('EF456GH', 'Peugeot', 'Bleu', 5),
      ('IJ789KL', 'Citroen', 'Blanc', 4),
      ('MN012OP', 'Toyota', 'Noir', 7),
      ('QR345ST', 'Honda', 'Gris', 5),
      ('UV678WX', 'BMW', 'Rouge', 5),
      ('YZ901AB', 'Mercedes', 'Bleu', 5),
      ('CD234EF', 'Audi', 'Blanc', 4),
      ('GH567IJ', 'Volkswagen', 'Noir', 5),
      ('KL890MN', 'Ford', 'Gris', 7),
      ('OP123QR', 'Fiat', 'Rouge', 4),
      ('ST456UV', 'Nissan', 'Bleu', 5),
      ('WX789YZ', 'Kia', 'Blanc', 7),
      ('AB012CD', 'Hyundai', 'Noir', 5),
      ('EF345GH', 'Mazda', 'Gris', 5),
      ('IJ678KL', 'Chevrolet', 'Rouge', 7),
      ('MN901OP', 'Jeep', 'Bleu', 5),
      ('QR234ST', 'Subaru', 'Blanc', 5),
      ('UV567WX', 'Lexus', 'Noir', 5);

INSERT INTO utilisateur (login, nom, prenom)
VALUES
    ('jdoe', 'Doe', 'John'),
    ('asmith', 'Smith', 'Alice'),
    ('bwhite', 'White', 'Bob'),
    ('cjones', 'Jones', 'Clara');

INSERT INTO trajet (depart, arrivee, date, nbPlaces, prix, conducteurLogin)
VALUES
    ('Paris', 'Lyon', '2024-07-01', 3, 50, 'jdoe'),
    ('Marseille', 'Nice', '2024-07-02', 4, 30, 'asmith'),
    ('Bordeaux', 'Toulouse', '2024-07-03', 2, 20, 'bwhite'),
    ('Nantes', 'Rennes', '2024-07-04', 3, 15, 'cjones');

INSERT INTO passager (trajetId, passagerLogin)
VALUES
    (1, 'asmith'),
    (1, 'bwhite'),
    (2, 'cjones'),
    (2, 'jdoe'),
    (3, 'asmith'),
    (3, 'cjones'),
    (4, 'jdoe'),
    (4, 'bwhite');

-- TEST
SELECT * FROM voiture;
SELECT * FROM utilisateur;
SELECT * FROM trajet;
SELECT * FROM passager;

