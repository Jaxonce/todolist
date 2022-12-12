DROP TABLE IF EXISTS Task,Liste,Utilisateur;

CREATE TABLE Utilisateur (
    id bigint(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom varchar(50) NOT NULL,
    email varchar(50) NOT NULL,
    password varchar(256) NOT NULL
);

CREATE TABLE Liste (
   id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
   nom varchar(50) NOT NULL,
   dateCreation timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   dateModification timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   possesseur bigint(20) UNSIGNED DEFAULT NULL,
   FOREIGN KEY (possesseur) REFERENCES Utilisateur(id) ON DELETE CASCADE,
   PRIMARY KEY (id)
);


CREATE TABLE Task (
   id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
   nom varchar(50) NOT NULL,
   descriptionTache varchar(200) DEFAULT NULL,
   importance numeric(1) NOT NULL,
   dateCreation timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   dateModification timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   listeId bigint(20) UNSIGNED NOT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (listeId) REFERENCES Liste(id) ON DELETE CASCADE
);

INSERT INTO Utilisateur(nom, email, password) VALUES
    ('malanone', 'dupontJean@gmail.com', '1234');

INSERT INTO Liste(nom, possesseur) VALUES
    ('Liste de course', (SELECT id FROM Utilisateur WHERE nom = 'Dupont')),
    ('Liste du mois', NULL);


INSERT INTO Task(nom, descriptionTache, importance,listeID) VALUES
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

