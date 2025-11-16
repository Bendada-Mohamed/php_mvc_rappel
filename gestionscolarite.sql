-- ============================================
-- Base de données : GESTIONSCOLARITE
-- Architecture : MVC en PHP
-- ============================================

-- Créer la base de données
CREATE DATABASE IF NOT EXISTS gestionscolarite;
USE gestionscolarite;

-- ============================================
-- Table 1: ETUDIANT
-- ============================================
CREATE TABLE ETUDIANT (
  NEtudiant INT PRIMARY KEY AUTO_INCREMENT,
  Nom VARCHAR(100) NOT NULL,
  Prenom VARCHAR(100) NOT NULL
);

-- ============================================
-- Table 2: MATIERE
-- ============================================
CREATE TABLE MATIERE (
  CodeMat INT PRIMARY KEY AUTO_INCREMENT,
  LibelleMat VARCHAR(150) NOT NULL,
  CoeffMat DECIMAL(4,2) NOT NULL CHECK (CoeffMat > 0)
);

-- ============================================
-- Table 3: EVALUER (Junction table)
-- ============================================
CREATE TABLE EVALUER (
  NEtudiant INT NOT NULL,
  CodeMat INT NOT NULL,
  Date DATE NOT NULL,
  Note DECIMAL(4,2) NOT NULL CHECK (Note >= 0 AND Note <= 20),
  PRIMARY KEY (NEtudiant, CodeMat, Date),
  FOREIGN KEY (NEtudiant) REFERENCES ETUDIANT(NEtudiant) ON DELETE CASCADE,
  FOREIGN KEY (CodeMat) REFERENCES MATIERE(CodeMat) ON DELETE CASCADE
);

-- ============================================
-- Données de test (Optionnel)
-- ============================================

-- Insérer des étudiants
INSERT INTO ETUDIANT (Nom, Prenom) VALUES
('Dupont', 'Jean'),
('Martin', 'Marie'),
('Bernard', 'Pierre'),
('Thomas', 'Sophie'),
('Robert', 'Luc'),
('Richard', 'Anne'),
('Petit', 'Jacques'),
('Durand', 'Isabelle');

-- Insérer des matières
INSERT INTO MATIERE (LibelleMat, CoeffMat) VALUES
('Mathématiques', 3.5),
('Français', 2.0),
('Histoire', 1.5),
('Informatique', 4.0),
('Anglais', 2.5),
('Physique', 3.0);

-- Insérer des évaluations
INSERT INTO EVALUER (NEtudiant, CodeMat, Date, Note) VALUES
(1, 1, '2025-10-15', 15.5),
(1, 2, '2025-10-16', 14.0),
(1, 3, '2025-10-17', 16.5),
(1, 4, '2025-10-18', 18.0),
(2, 1, '2025-10-15', 12.0),
(2, 2, '2025-10-16', 13.5),
(2, 3, '2025-10-17', 14.0),
(2, 4, '2025-10-18', 16.5),
(3, 1, '2025-10-15', 18.5),
(3, 2, '2025-10-16', 17.0),
(3, 3, '2025-10-17', 15.5),
(3, 4, '2025-10-18', 19.0),
(4, 1, '2025-10-15', 14.0),
(4, 2, '2025-10-16', 15.5),
(4, 3, '2025-10-17', 13.0),
(4, 4, '2025-10-18', 17.5),
(5, 1, '2025-10-15', 16.5),
(5, 2, '2025-10-16', 18.0),
(5, 3, '2025-10-17', 17.0),
(5, 4, '2025-10-18', 15.5),
(6, 1, '2025-10-15', 13.5),
(6, 2, '2025-10-16', 12.5),
(6, 3, '2025-10-17', 14.5),
(6, 4, '2025-10-18', 16.0),
(7, 1, '2025-10-15', 11.0),
(7, 2, '2025-10-16', 12.0),
(7, 3, '2025-10-17', 10.5),
(7, 4, '2025-10-18', 14.0),
(8, 1, '2025-10-15', 17.0),
(8, 2, '2025-10-16', 16.5),
(8, 3, '2025-10-17', 18.0),
(8, 4, '2025-10-18', 17.5);

-- ============================================
-- Vérification des données
-- ============================================
SELECT COUNT(*) as NbEtudiants FROM ETUDIANT;
SELECT COUNT(*) as NbMatieres FROM MATIERE;
SELECT COUNT(*) as NbEvaluations FROM EVALUER;
