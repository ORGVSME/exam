-- Active: 1741526926061@@127.0.0.1@3306@gestion_emprunt

CREATE DATABASE gestion_emprunt;
USE gestion_emprunt;

CREATE TABLE membre (
    id_membre INT PRIMARY KEY AUTO_INCREMENT, 
    nom VARCHAR(50),
    date_naissance DATE,
    genre CHAR(1), 
    email VARCHAR(50),
    ville VARCHAR(50),
    mot_de_passe VARCHAR(50),
    photo VARCHAR(100) 
);

CREATE TABLE categorie_objet (
    id_categorie INT PRIMARY KEY AUTO_INCREMENT, 
    nom_categorie VARCHAR(50)
);



CREATE TABLE objet (
    id_objet INT PRIMARY KEY AUTO_INCREMENT, 
    nom_objet VARCHAR(50), 
    id_categorie INT,
    id_membre INT, 
    FOREIGN KEY (id_categorie) REFERENCES categorie_objet(id_categorie), 
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre) 
);

ALTER TABLE objet
ADD COLUMN id_membre_emprunteur INT NULL,
ADD CONSTRAINT fk_objet_emprunteur FOREIGN KEY (id_membre_emprunteur) REFERENCES membre(id_membre);

CREATE TABLE images_objet (
    id_image INT PRIMARY KEY AUTO_INCREMENT,
    id_objet INT, 
    nom_image VARCHAR(100), 
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet) 
);
drop table images_objet;

CREATE TABLE emprunt (
    id_emprunt INT PRIMARY KEY AUTO_INCREMENT, 
    id_objet INT, 
    id_proprietaire INT,
    id_emprunteur INT,
    date_emprunt DATE, 
    date_retour DATE, 
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet), 
    FOREIGN KEY (id_proprietaire) REFERENCES membre(id_membre),
    FOREIGN KEY (id_emprunteur) REFERENCES membre(id_membre)
);

INSERT INTO emprunt (id_objet, id_proprietaire, id_emprunteur, date_emprunt, date_retour) VALUES
(1, 1, 2, '2025-07-01', '2025-07-10'),
(3, 1, 3, '2025-07-05', '2025-07-12'),
(11, 2, 4, '2025-07-08', '2025-07-15'),
(15, 2, 1, '2025-07-10', '2025-07-17'),
(21, 3, 2, '2025-07-12', '2025-07-20'),
(23, 4, 3, '2025-07-14', '2025-07-21'),
(31, 3, 4, '2025-07-16', '2025-07-24'),
(33, 4, 1, '2025-07-18', '2025-07-26'),
(5, 1, 4, '2025-07-20', '2025-07-28'),
(25, 2, 3, '2025-07-22', '2025-07-30');



INSERT INTO membre (nom, date_naissance, genre, email, ville, mot_de_passe, photo) VALUES
('Alice Dupont', '1990-05-15', 'F', 'alice.dupont@email.com', 'Paris', 'pass123', 'alice.jpg'),
('Bob Martin', '1985-08-22', 'M', 'bob.martin@email.com', 'Lyon', 'pass456', 'bob.jpg'),
('Claire Lefevre', '1995-03-10', 'F', 'claire.lefevre@email.com', 'Marseille', 'pass789', 'claire.jpg'),
('David Dubois', '1988-11-30', 'M', 'david.dubois@email.com', 'Toulouse', 'pass101', 'david.jpg');


INSERT INTO categorie_objet (nom_categorie) VALUES
('Esthétique'),
('Bricolage'),
('Mécanique'),
('Cuisine');

INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Miroir décoratif', 1, 1),
('Parfum de luxe', 1, 1),
('Perceuse électrique', 2, 1),
('Marteau', 2, 1),
('Clé à molette', 3, 1),
('Tournevis', 3, 1),
('Mixeur', 4, 1),
('Poêle antiadhésive', 4, 1),
('Cadre photo', 1, 1),
('Couteau de chef', 4, 1),
('Lampe design', 1, 2),
('Maquillage', 1, 2),
('Scie manuelle', 2, 2),
('Boîte à outils', 2, 2),
('Pompe à vélo', 3, 2),
('Clé dynamométrique', 3, 2),
('Blender', 4, 2),
('Casseroles', 4, 2),
('Vase décoratif', 1, 2),
('Planche à découper', 4, 2),
('Miroir de poche', 1, 3),
('Bijoux fantaisie', 1, 3),
('Pinceau de peinture', 2, 3),
('Niveau à bulle', 2, 3),
('Clé à pipe', 3, 3),
('Outil multifonction', 3, 3),
('Robot de cuisine', 4, 3),
('Moule à gâteau', 4, 3),
('Rideau décoratif', 1, 3),
('Éplucheur', 4, 3),
('Tableau moderne', 1, 4),
('Bougie parfumée', 1, 4),
('Perceuse sans fil', 2, 4),
('Escabeau', 2, 4), 
('Cric de voiture', 3, 4),
('Clé à cliquet', 3, 4),
('Grille-pain', 4, 4),
('Mixeur plongeant', 4, 4),
('Tapis décoratif', 1, 4),
('Couteau électrique', 4, 4);

INSERT INTO images_objet (id_objet, nom_image) VALUES
 (1, '1.jpeg'),
(2, '2.jpeg'),
(3, '3.jpeg'),
(4, '4.jpeg'),
(5, '5.jpeg'),
(6, '6.jpeg'),
(7, '7.jpeg'),
(8, '8.jpeg'),
(9, '9.jpeg'),
(10, '10.jpeg'),
(11, '11.jpeg'),
(12, '12.jpeg'),
(13, '13.jpeg'),
(14, '14.jpeg'),
(15, '15.jpeg'),
(16, '16.jpeg'),
(17, '17.jpeg'),
(18, '18.jpeg'),
(19, '19.jpeg'),
(20, '20.jpeg'),
(21, '21.jpeg'),
(22, '22.jpeg'),
(23, '23.jpeg'),
(24, '24.jpeg'),
(25, '25.jpeg'),
(26, '26.jpeg'),
(27, '27.jpeg'),
(28, '28.jpeg'),
(29, '29.jpeg'),
(30, '30.jpeg'),
(31, '31.jpeg'),
(32, '32.jpeg'),
(33, '33.jpeg'),
(34, '34.jpeg'),
(35, '35.jpeg'),
(36, '36.jpeg'),
(37, '37.jpeg'),
(38, '38.jpeg'),
(39, '39.jpeg'),
(40, '40.jpeg');

ALTER TABLE emprunt DROP FOREIGN KEY emprunt_ibfk_2; -- clé étrangère sur id_membre
ALTER TABLE emprunt DROP COLUMN id_membre;


ALTER TABLE objet CHANGE bgbbb nom_objet VARCHAR(50);
