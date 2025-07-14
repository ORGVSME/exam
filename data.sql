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

CREATE TABLE images_objet (
    id_image INT PRIMARY KEY AUTO_INCREMENT,
    id_objet INT, 
    nom_image VARCHAR(100), 
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet) 
);

CREATE TABLE emprunt (
    id_emprunt INT PRIMARY KEY AUTO_INCREMENT, 
    id_objet INT, 
    id_membre INT, 
    date_emprunt DATE, 
    date_retour DATE, 
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet), 
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre) 
);


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
  (1, '../assets/picture/1.jpeg'),
  (2, '../assets/picture/2.jpeg'),
  (3, '../assets/picture/3.jpeg'),
  (4, '../assets/picture/4.jpeg'),
  (5, '../assets/picture/5.jpeg'),
  (6, '../assets/picture/6.jpeg'),
  (7, '../assets/picture/7.jpeg'),
  (8, '../assets/picture/8.jpeg'),
  (9, '../assets/picture/9.jpeg'),
  (10, '../assets/picture/10.jpeg'),
  (11, '../assets/picture/11.jpeg'),
  (12, '../assets/picture/12.jpeg'),
  (13, '../assets/picture/13.jpeg'),
  (14, '../assets/picture/14.jpeg'),
  (15, '../assets/picture/15.jpeg'),
  (16, '../assets/picture/16.jpeg'),
  (17, '../assets/picture/17.jpeg'),
  (18, '../assets/picture/18.jpeg'),
  (19, '../assets/picture/19.jpeg'),
  (20, '../assets/picture/20.jpeg'),
  (21, '../assets/picture/21.jpeg'),
  (22, '../assets/picture/22.jpeg'),
  (23, '../assets/picture/23.jpeg'),
  (24, '../assets/picture/24.jpeg'),
  (25, '../assets/picture/25.jpeg'),
  (26, '../assets/picture/26.jpeg'),
  (27, '../assets/picture/27.jpeg'),
  (28, '../assets/picture/28.jpeg'),
  (29, '../assets/picture/29.jpeg'),
  (30, '../assets/picture/30.jpeg'),
  (31, '../assets/picture/31.jpeg'),
  (32, '../assets/picture/32.jpeg'),
  (33, '../assets/picture/33.jpeg'),
  (34, '../assets/picture/34.jpeg'),
  (35, '../assets/picture/35.jpeg'),
  (36, '../assets/picture/36.jpeg'),
  (37, '../assets/picture/37.jpeg'),
  (38, '../assets/picture/38.jpeg'),
  (39, '../assets/picture/39.jpeg'),
  (40, '../assets/picture/40.jpeg');


INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2025-06-01', '2025-06-10'),
(3, 3, '2025-06-05', NULL),
(11, 4, '2025-06-07', '2025-06-15'),
(15, 1, '2025-06-10', NULL),
(21, 2, '2025-06-12', '2025-06-20'),
(23, 4, '2025-06-15', NULL),
(31, 3, '2025-06-18', '2025-06-25'),
(33, 1, '2025-06-20', NULL),
(5, 4, '2025-06-22', '2025-06-30'),
(25, 2, '2025-06-25', NULL);

ALTER TABLE objet CHANGE bgbbb nom_objet VARCHAR(50);
