# TP : Rappel du langage PHP et l'architecture MVC

## Gestion Scolarité - Système de Gestion Académique

Un système d'information académique complet construit avec l'architecture **MVC (Model-View-Controller)** en PHP. Ce projet permet de gérer les étudiants, les matières et leurs évaluations (notes) avec une interface ergonomique en Bootstrap.

**Objet du TP :** Structurer un projet PHP en MVC, manipuler une BD relationnelle via PDO avec requêtes préparées, et produire des vues professionnelles.

## 📋 Table des matières

- [Description](#description)
- [Spécifications](#spécifications)
- [Fonctionnalités](#fonctionnalités)
- [Schéma de la Base de Données](#schéma-de-la-base-de-données)
- [Règles de Gestion](#règles-de-gestion)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Structure du projet](#structure-du-projet)
- [Utilisation](#utilisation)
- [Technologies](#technologies)

## 📖 Description

**Gestion Scolarité** est une application web PHP qui implémente le pattern **MVC** pour gérer efficacement :

- Les informations des étudiants
- Les évaluations et les résultats des étudiants
- Les matières d'enseignement
- Un tableau de bord centralisé pour visualiser les statistiques académiques
- Le calcul des moyennes pondérées et matières

Cette application est idéale pour les écoles, universités et centres de formation souhaitant disposer d'un système léger et performant de gestion académique.

## 🎯 Spécifications

### Objectifs du TP

- ✅ Structurer un projet PHP en MVC (contrôleurs → modèles → vues)
- ✅ Manipuler une BD relationnelle (CRUD, jointures) via **PDO** (requêtes préparées)
- ✅ Produire des vues ergonomiques (HTML/CSS) en utilisant **Bootstrap**
- ✅ Implémenter les règles de gestion métier
- ✅ Gérer les validations et les contraintes

## 📊 Schéma de la Base de Données

### Tables

#### 1. ETUDIANT

| Colonne       | Type         | Contrainte                 |
| ------------- | ------------ | -------------------------- |
| **NEtudiant** | INT          | PRIMARY KEY AUTO_INCREMENT |
| Nom           | VARCHAR(100) | NOT NULL                   |
| Prenom        | VARCHAR(100) | NOT NULL                   |

#### 2. MATIERE

| Colonne     | Type         | Contrainte                 |
| ----------- | ------------ | -------------------------- |
| **CodeMat** | INT          | PRIMARY KEY AUTO_INCREMENT |
| LibelleMat  | VARCHAR(150) | NOT NULL                   |
| CoeffMat    | DECIMAL(4,2) | NOT NULL, CHECK > 0        |

#### 3. EVALUER (Jointure)

| Colonne        | Type         | Contrainte                 |
| -------------- | ------------ | -------------------------- |
| **#NEtudiant** | INT          | PRIMARY KEY, FK → ETUDIANT |
| **#CodeMat**   | INT          | PRIMARY KEY, FK → MATIERE  |
| **Date**       | DATE         | PRIMARY KEY                |
| Note           | DECIMAL(4,2) | NOT NULL, CHECK [0, 20]    |

**Clé composite :** (NEtudiant, CodeMat, Date) est unique

### Diagramme Relationnel

```text
ETUDIANT ─────┐
              ├─── EVALUER ───── MATIERE


## 📏 Règles de Gestion

### Validations des données

- ✅ **Note** ∈ [0, 20]
- ✅ **CoeffMat** > 0 (entier ou réel)
- ✅ Une combinaison **(NEtudiant, CodeMat, Date)** est unique
  - Une évaluation par jour et matière pour un étudiant

### Calculs

- **Moyenne pondérée d'un étudiant** = Σ(Note × CoeffMat) / Σ(CoeffMat)
  - Calculée sur toutes les matières évaluées
- **Moyenne d'une matière** = Moyenne des notes saisies pour cette matière

## ✨ Fonctionnalités

### 1️⃣ Gestion des Étudiants

- 📝 **Lister** tous les étudiants avec :
  - 🔍 Recherche par nom/prénom
  - 📄 Pagination des résultats
- ✏️ **Créer** un nouvel étudiant
- ✏️ **Modifier** les informations d'un étudiant
- 🗑️ **Supprimer** un étudiant
- 📊 **Détail d'un étudiant** :
  - Informations personnelles
  - Liste de toutes ses évaluations
  - **Moyenne pondérée calculée** (Σ(Note × CoeffMat) / Σ(CoeffMat))

### 2️⃣ Gestion des Matières

- 📚 **Lister** toutes les matières avec :
  - 🔍 Recherche par libellé
- ✏️ **Créer** une nouvelle matière (validation CoeffMat > 0)
- ✏️ **Modifier** une matière
- 🗑️ **Supprimer** une matière
- 📊 **Détail d'une matière** :
  - Informations (libellé, coefficient)
  - Toutes les évaluations liées
  - **Moyenne de la matière** (moyenne des notes)

### 3️⃣ Gestion des Évaluations

- 📋 **Lister** toutes les évaluations
- ✏️ **Créer** une nouvelle évaluation avec :
  - Validation des contraintes (Note ∈ [0, 20])
  - Vérification de l'unicité (NEtudiant, CodeMat, Date)
- ✏️ **Modifier** une évaluation
- 🗑️ **Supprimer** une évaluation

### 4️⃣ Tableau de Bord (Page d'accueil)

- 📊 **Statistiques générales** :
  - Nombre total d'étudiants
  - Nombre total de matières
  - Nombre total d'évaluations
- 🏆 **Top 5 étudiants** par moyenne pondérée
- 🏆 **Top 5 matières** par moyenne

## 🔧 Prérequis

- **PHP** >= 7.2
- **MySQL** >= 5.7 ou MariaDB
- **Apache** (avec support de .htaccess)
- **XAMPP**, LAMP ou similaire
- **Bootstrap** 4.x (CDN inclus)

## 💻 Installation

### 1. Cloner le projet

```bash
git clone https://github.com/Bendada-Mohamed/php_mvc_rappel.git
cd php_mvc_rappel
```

### 2. Configurer la base de données

#### Méthode 1 : PHPMyAdmin (Recommandé)

1. Ouvrez PHPMyAdmin : `http://localhost/phpmyadmin`
2. Cliquez sur "Importer"
3. Sélectionnez le fichier `gestionscolarite.sql`
4. Cliquez sur "Exécuter"

#### Méthode 2 : Ligne de commande MySQL

```bash
mysql -u root -p < gestionscolarite.sql
```

#### Méthode 3 : Script SQL manuel

```sql
CREATE DATABASE IF NOT EXISTS gestionscolarite;
USE gestionscolarite;

-- Exécutez le contenu du fichier gestionscolarite.sql
```

### 3. Configurer les paramètres de connexion

Modifiez le fichier `config/db.php` selon votre configuration :

```php
// Par défaut (XAMPP)
$db = new PDO("mysql:host=localhost;dbname=gestionscolarite", "root", "");

// Si vous avez un mot de passe
$db = new PDO("mysql:host=localhost;dbname=gestionscolarite", "root", "votre_mot_de_passe");

// Pour un serveur distant
$db = new PDO("mysql:host=192.168.1.100;dbname=gestionscolarite", "utilisateur", "mot_de_passe");
```

### 4. Placer le projet dans le serveur web

```bash
# Pour XAMPP (Windows)
xcopy php_mvc_rappel C:\xampp\htdocs\ /E

# Pour Linux/Mac
cp -r php_mvc_rappel /var/www/html/
```

### 5. Accéder à l'application

Ouvrez votre navigateur et accédez à :

```
http://localhost/php_mvc_rappel
```

La page d'accueil (tableau de bord) s'affichera par défaut.

## 📁 Structure du projet

```
php_mvc_rappel/
│
├── index.php                      # Point d'entrée (Front-Controller)
├── README.md                      # Documentation
├── gestionscolarite.sql           # Script de création BD + données de test
│
├── config/
│   └── db.php                     # Classe de connexion PDO (Singleton)
│
├── controlleurs/                  # Couche Contrôleur (MVC)
│   ├── etudiantControlleur.php    # Logique métier Étudiants
│   ├── evaluationControlleur.php  # Logique métier Évaluations
│   ├── matiereControlleur.php     # Logique métier Matières
│   └── tableauDeBordControlleur.php # Logique métier Tableau de bord
│
├── models/                        # Couche Modèle (MVC)
│   ├── etudiantModel.php          # Accès BD Étudiants (CRUD + moyenne)
│   ├── evaluationModel.php        # Accès BD Évaluations (CRUD + requêtes)
│   ├── matiereModel.php           # Accès BD Matières (CRUD + moyenne)
│   └── tableauDeBordModel.php     # Requêtes statistiques (Top 5, etc.)
│
├── vues/                          # Couche Vue (MVC)
│   ├── Etudiants/
│   │   ├── index.php              # Page principale Étudiants
│   │   ├── Liste.php              # Tableau des étudiants
│   │   ├── FormAjouter.php        # Formulaire d'ajout
│   │   ├── FormModifier.php       # Formulaire de modification
│   │   ├── FormRechercher.php     # Barre de recherche
│   │   └── [Autres fichiers]
│   │
│   ├── Evaluations/
│   │   ├── index.php              # Page principale Évaluations
│   │   ├── Liste.php              # Tableau des évaluations
│   │   ├── FormAjouter.php        # Formulaire d'ajout
│   │   ├── FormModifier.php       # Formulaire de modification
│   │   └── [Autres fichiers]
│   │
│   ├── Matieres/
│   │   ├── index.php              # Page principale Matières
│   │   ├── Liste.php              # Tableau des matières
│   │   ├── FormAjouter.php        # Formulaire d'ajout
│   │   ├── FormModifier.php       # Formulaire de modification
│   │   └── [Autres fichiers]
│   │
│   ├── TableauDeBord/
│   │   ├── index.php              # Page principale TB
│   │   ├── Nombre.php             # Statistiques
│   │   └── top5.php               # Top 5 étudiants et matières
│   │
│   └── layout/
│       ├── Header.php             # En-tête (navigation)
│       └── Footer.php             # Pied de page
│
├── assets/                        # Fichiers statiques
│   ├── CSS/
│   │   └── styles.css             # Styles personnalisés
│   └── JS/
│       ├── etudiants.js           # Validations formulaires Étudiants
│       ├── evaluation.js          # Validations formulaires Évaluations
│       └── matiere.js             # Validations formulaires Matières
│
└── public/                        # Dossier de uploads (optionnel)
```

```

## 🚀 Utilisation

### Navigation principale

L'application utilise un système de routage par paramètre `action` (Front-Controller Pattern) :

```

http://localhost/php_mvc_rappel/index.php?action=Etudiant

```

### Actions disponibles

#### 1. Tableau de Bord (Page d'accueil)
```

http://localhost/php_mvc_rappel/
http://localhost/php_mvc_rappel/index.php
http://localhost/php_mvc_rappel/index.php?action=

```
- Affiche les statistiques et top 5

#### 2. Étudiants
```

?action=Etudiant → Lister tous les étudiants (avec recherche/pagination)
?action=AjouterEtudiant → Formulaire d'ajout
?action=ModifierEtudiant → Formulaire de modification
?action=SupprimerEtudiant → Suppression avec confirmation
?action=RechercherEtudiant → Recherche (nom/prénom)
?action=DetailEtudiant → Détail + évaluations + moyenne pondérée

```

#### 3. Matières
```

?action=Matieres → Lister toutes les matières
?action=AjouterMatiere → Formulaire d'ajout
?action=ModifierMatiere → Formulaire de modification
?action=SupprimerMatiere → Suppression avec confirmation
?action=RechercherMatiere → Recherche par libellé
?action=DetailMatiere → Détail + évaluations + moyenne

```

#### 4. Évaluations
```

?action=Evaluation → Lister toutes les évaluations
?action=AjouterEvaluation → Formulaire d'ajout
?action=ModifierEvaluation → Formulaire de modification
?action=SupprimerEvaluation → Suppression avec confirmation
?action=RechercherEvaluation → Recherche

```

### Exemples d'utilisation

#### Consulter le tableau de bord
```

http://localhost/php_mvc_rappel/

````

#### Ajouter un étudiant
1. Accédez à `?action=Etudiant`
2. Cliquez sur "Ajouter un étudiant"
3. Complétez le formulaire (Nom, Prénom)
4. Cliquez sur "Ajouter"

#### Consulter le détail d'un étudiant
1. Accédez à `?action=Etudiant`
2. Cliquez sur le nom d'un étudiant
3. Visualisez ses évaluations et sa moyenne pondérée

#### Ajouter une évaluation
1. Accédez à `?action=Evaluation`
2. Cliquez sur "Ajouter une évaluation"
3. Sélectionnez : Étudiant, Matière, Date, Note (0-20)
4. Cliquez sur "Ajouter"

## 🛠️ Technologies

| Technologie | Version | Utilisation |
|-----------|---------|------------|
| **PHP** | 7.2+ | Langage de programmation côté serveur |
| **MySQL/MariaDB** | 5.7+ | Base de données relationnelle |
| **PDO** | Native | Couche d'abstraction BD avec requêtes préparées |
| **HTML5** | 5 | Structure des pages web |
| **CSS3** | 3 | Stylisation des pages |
| **Bootstrap** | 4.x | Framework CSS responsive (CDN) |
| **JavaScript** | ES6+ | Interactivité côté client |
| **Apache** | 2.4+ | Serveur web HTTP |

## 📐 Architecture MVC

Ce projet implémente le pattern **Model-View-Controller** (MVC) pour une meilleure séparation des responsabilités :

### 1. Couche Modèle (Models)
Les fichiers dans `models/` gèrent l'accès à la base de données :
- Requêtes SQL (CRUD : Create, Read, Update, Delete)
- Calculs métier (moyennes pondérées, statistiques)
- Requêtes préparées PDO (sécurité contre les injections SQL)

**Exemple :** `etudiantModel.php`
```php
public function lister($page = 1, $limite = 10) {
  // Récupère les étudiants avec pagination
}

public function getMoyennePonderee($netudiiant) {
  // Calcule la moyenne pondérée : Σ(Note × CoeffMat) / Σ(CoeffMat)
}
````

### 2. Couche Contrôleur (Controllers)

Les fichiers dans `controlleurs/` orchestrent les flux :

- Reçoivent les requêtes HTTP (via `?action=`)
- Appellent les modèles pour les données
- Passent les données aux vues

**Exemple :** `etudiantControlleur.php`

```php
public static function lister() {
  $model = new EtudiantModel();
  $etudiants = $model->lister(); // Appel du modèle
  include "vues/Etudiants/index.php"; // Affichage de la vue
}
```

### 3. Couche Vue (Views)

Les fichiers dans `vues/` affichent les données :

- HTML/CSS/Bootstrap pour la présentation
- Variables PHP injectées par le contrôleur
- Formulaires pour l'interaction utilisateur

**Exemple :** `vues/Etudiants/Liste.php`

```php
<?php foreach ($etudiants as $etudiant) { ?>
  <tr>
    <td><?= $etudiant['Nom'] ?></td>
    <td><?= $etudiant['Prenom'] ?></td>
  </tr>
<?php } ?>
```

### Flux de traitement

```
1. Requête HTTP
   ↓
   http://localhost/php_mvc_rappel/index.php?action=Etudiant
   ↓
2. Front-Controller (index.php)
   ↓
   Extrait action, appelle le contrôleur approprié
   ↓
3. Contrôleur (EtudiantControlleur)
   ↓
   Crée une instance du modèle
   ↓
4. Modèle (EtudiantModel)
   ↓
   Exécute les requêtes BD, retourne les données
   ↓
5. Contrôleur
   ↓
   Inclut la vue avec les données
   ↓
6. Vue (Etudiants/index.php)
   ↓
   Rend le HTML au navigateur
   ↓
7. Réponse HTTP (Page web)
```

## 🔒 Sécurité

### Requêtes Préparées (PDO)

Toutes les requêtes utilisent les requêtes préparées pour éviter les injections SQL :

```php
// ✅ SÉCURISÉ
$stmt = $db->prepare("SELECT * FROM ETUDIANT WHERE Nom = ?");
$stmt->execute([$nom]);

// ❌ NON SÉCURISÉ (évité dans ce projet)
$result = $db->query("SELECT * FROM ETUDIANT WHERE Nom = '$nom'");
```

### Validations

- Validation des notes : [0, 20]
- Validation des coefficients : > 0
- Vérification de l'unicité : (NEtudiant, CodeMat, Date)

## 📊 Diagramme Entité-Relation (MER)

```
┌─────────────────┐
│    ETUDIANT     │
├─────────────────┤
│ NEtudiant (PK)  │
│ Nom             │
│ Prenom          │
└────────┬────────┘
         │
         │ 1,N
         │
         ├─────────────────────┐
         │                     │
         │                     │
      ┌──▼──────────────────┐
      │     EVALUER         │
      ├─────────────────────┤
      │ NEtudiant (PK, FK)  │
      │ CodeMat (PK, FK)    │
      │ Date (PK)           │
      │ Note                │
      └──┬──────────────────┘
         │
         │ 1,N
         │
┌────────▼────────┐
│     MATIERE     │
├─────────────────┤
│ CodeMat (PK)    │
│ LibelleMat      │
│ CoeffMat        │
└─────────────────┘
```

## 🐛 Dépannage

### ⚠️ Erreur de connexion à la base de données

**Symptôme :** "Erreur de Connexion : SQLSTATE[HY000]"

**Solutions :**

1. Vérifiez que MySQL/MariaDB est en cours d'exécution
2. Vérifiez les identifiants dans `config/db.php` (utilisateur, mot de passe)
3. Assurez-vous que la base de données `gestionscolarite` existe
4. Testez la connexion avec PHPMyAdmin

### ⚠️ Erreur 404 ou page vierge

**Symptôme :** "Page non trouvée" ou rien ne s'affiche

**Solutions :**

1. Vérifiez l'orthographe du paramètre `action`
2. Vérifiez que le fichier du contrôleur existe dans `controlleurs/`
3. Consultez les logs PHP : `C:\xampp\apache\logs\error.log`
4. Activez le mode débogage en PHP

### ⚠️ Erreur de permissions

**Symptôme :** "Permission denied" ou "Access Forbidden"

**Solutions :**

1. Vérifiez les permissions des dossiers (755 pour les dossiers)
2. Vérifiez les permissions des fichiers (644 pour les fichiers)
3. Assurez-vous que le serveur web a les droits de lecture

### ⚠️ Note invalide ou formulaire rejeté

**Symptôme :** "Erreur lors de l'ajout de l'évaluation"

**Vérifications :**

- Note doit être entre 0 et 20
- Coefficient de la matière doit être > 0
- La combinaison (NEtudiant, CodeMat, Date) doit être unique

### 💡 Conseil de débogage

Activez les erreurs PHP dans `config/db.php` :

```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

## 📚 Ressources supplémentaires

### Documentation officielle

- [PHP Manual](https://www.php.net/manual/fr/)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [PDO Documentation](https://www.php.net/manual/fr/book.pdo.php)
- [Bootstrap Documentation](https://getbootstrap.com/docs/4.0/)

### Tutoriels MVC

- [MVC Pattern Explained](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)
- [PDO Prepared Statements](https://www.php.net/manual/fr/pdo.prepared-statements.php)

## 📋 Checklist de validation du TP

- ✅ Architecture MVC implémentée
- ✅ Base de données relationnelle (3 tables)
- ✅ CRUD complet pour Étudiants, Matières, Évaluations
- ✅ Requêtes préparées PDO (sécurité)
- ✅ Vues ergonomiques avec Bootstrap
- ✅ Validations métier (notes, coefficients)
- ✅ Calculs moyennes pondérées et matières
- ✅ Tableau de bord avec statistiques
- ✅ Top 5 étudiants et matières
- ✅ Pagination des résultats
- ✅ Recherche par nom/prénom/libellé
- ✅ Gestion des erreurs et exceptions

## 👨‍💻 Auteur

**Bendada Mohamed**

- GitHub : [@Bendada-Mohamed](https://github.com/Bendada-Mohamed)
- Projet : [php_mvc_rappel](https://github.com/Bendada-Mohamed/php_mvc_rappel)

## 📄 Licence

Ce projet est open source. Vous êtes libre de l'utiliser, le modifier et le distribuer.

---

### Notes importantes

**Ceci est un projet d'apprentissage** du pattern MVC en PHP. Il démontre :

- L'architecture MVC classique
- Les bonnes pratiques PHP
- L'utilisation de PDO
- La gestion d'une BD relationnelle
- L'ergonomie web avec Bootstrap

**Pour la production**, considérez :

- L'utilisation d'un framework PHP : [Laravel](https://laravel.com), [Symfony](https://symfony.com), [Yii](https://www.yiiframework.com/)
- La mise en place d'un ORM : Eloquent, Doctrine
- Les systèmes de cache : Redis, Memcached
- La documentation API : Swagger/OpenAPI
- Les tests automatisés : PHPUnit

---

**Dernière mise à jour :** 16 novembre 2025
