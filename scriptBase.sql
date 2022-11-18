DROP TABLE IF EXISTS Tache, Utilisateur, Liste;

CREATE TABLE Utilisateur (
    id bigint(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom varchar(50) NOT NULL,
    prenom varchar(50) NOT NULL,
    email varchar(50) NOT NULL,
    password varchar(256) NOT NULL
);

CREATE TABLE Liste (
   id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
   nom varchar(50) NOT NULL,
   dateModification date NOT NULL DEFAULT NOW(),
   possesseur bigint(20) UNSIGNED DEFAULT NULL,
   FOREIGN KEY (possesseur) REFERENCES Utilisateur(id),
   PRIMARY KEY (id)
);


CREATE TABLE Tache (
   id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
   nom varchar(50) NOT NULL,
   descriptionTache varchar(200) DEFAULT NULL,
   importance numeric(1) NOT NULL,
   dateCreation date NOT NULL DEFAULT NOW(),
   dateModification date NOT NULL DEFAULT NOW(),
   listeId bigint(20) UNSIGNED NOT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (listeId) REFERENCES Liste(id)
);

INSERT INTO Utilisateur(nom, prenom, email, password) VALUES
    ('Dupont', 'Jean', 'dupontJean@gmail.com', '1234');

INSERT INTO Liste(nom, dateModification, possesseur) VALUES
    ('Liste de course', '2022-11-08', (SELECT id FROM Utilisateur WHERE nom = 'Dupont')),
    ('Liste du mois', '2022-11-08', NULL);


INSERT INTO Tache(nom, descriptionTache, importance,listeID) VALUES
    ('Faire le ménage', 'Faire le ménage de la maison', 1,(SELECT id FROM Liste WHERE nom = 'Liste de course')),
    ('Faire les courses', 'Faire les courses de la semaine', 3,(SELECT id FROM Liste WHERE nom = 'Liste de course')),
    ('Faire le repas', 'Faire le repas du soir', 2,(SELECT id FROM Liste WHERE nom = 'Liste de course')),
    ('Tondre', 'tondre le ptit coin au fond', 1,(SELECT id FROM Liste WHERE nom = 'Liste de course')),
    ('Manger', 'Les restes', 1,(SELECT id FROM Liste WHERE nom = 'Liste de course')),
    ('Dodo', NULL, 1,(SELECT id FROM Liste WHERE nom = 'Liste de course')),
    ('Mettre sa casquette', NULL,2,(SELECT id FROM Liste WHERE nom = 'Liste de course')),
    ('réparer les pc', NULL, 1,(SELECT id FROM Liste WHERE nom = 'Liste du mois')),
    ('Sortir les poubelles', NULL, 1,(SELECT id FROM Liste WHERE nom = 'Liste du mois')),
    ('caresser le chien', NULL, 1,(SELECT id FROM Liste WHERE nom = 'Liste du mois'));

