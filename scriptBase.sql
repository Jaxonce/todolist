DROP TABLE IF EXISTS Tache, Utilisateur, Liste;

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

CREATE TABLE Liste (
     id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
     nom varchar(50) NOT NULL,
     dateModification date NOT NULL DEFAULT NOW(),
     possesseur bigint(20) UNSIGNED DEFAULT NULL,
     FOREIGN KEY (possesseur) REFERENCES Utilisateur(id),
     PRIMARY KEY (id);
);


CREATE TABLE Utilisateur (
     id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
     nom varchar(50) NOT NULL,
     prenom varchar(50) NOT NULL,
     email varchar(50) NOT NULL,
     password varchar() NOT NULL,
     PRIMARY KEY (id);
);


INSERT INTO Tache(nom, descriptionTache, importance, dateCreation, dateModification) VALUES
    ('Faire le ménage', 'Faire le ménage de la maison', '1'),
    ('Faire les courses', 'Faire les courses de la semaine', '3'),
    ('Faire le repas', 'Faire le repas du soir', '2'),
    ('Tondre', 'tondre le ptit coin au fond', '1'),
    ('Manger', 'Les restes', '1'),
    ('Dodo', NULL, '1'),
    ('Mettre sa casquette', NULL),
    ('réparer les pc', NULL, '1', '2022-11-08', '2022-11-08'),
    ('Sortir les poubelles', NULL, '1', '2022-11-08', '2022-11-08'),
    ('caresser le chien', NULL, '1', '2022-11-08', '2022-11-08')

INSERT INTO Liste(nom, dateModification, possesseur) VALUES
    ('Liste de course', '2022-11-08', '1'),
    ('Liste du mois', '2022-11-08', NULL)

INSERT INTO Utilisateur(nom, prenom, email, password) VALUES
    ('Dupont', 'Jean', 'dupontJean@gmail.com', '1234')