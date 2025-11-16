# 📋 COMPTE RENDU DU PROJET

## Gestion Scolarité - Architecture MVC en PHP

**Date** : 16 novembre 2025  
**Auteur** : Bendada Mohamed  
**Projet** : TP de rappel du langage PHP et l'architecture MVC  
**Statut** : ✅ Complété

---

## 📑 Table des matières

1. [Présentation générale](#présentation-générale)
2. [Arborescence complète](#arborescence-complète)
3. [Architecture et conception](#architecture-et-conception)
4. [Fonctionnalités implémentées](#fonctionnalités-implémentées)
5. [Explications techniques](#explications-techniques)
6. [Points clés du projet](#points-clés-du-projet)
7. [Conclusion](#conclusion)

---

## 🎯 Présentation générale

### Objectif du projet

Créer une application web en PHP adoptant l'architecture **MVC (Model-View-Controller)** pour gérer :

- Les informations des **étudiants**
- Les **matières** d'enseignement
- Les **évaluations** (notes) des étudiants
- Un **tableau de bord** pour le suivi académique

### Technologies utilisées

| Composant           | Technologie                 |
| ------------------- | --------------------------- |
| **Langage**         | PHP 7.2+                    |
| **Base de données** | MySQL 5.7+                  |
| **Frontend**        | HTML5, CSS3, Bootstrap 5.3  |
| **Interactivité**   | JavaScript ES6+             |
| **Accès BD**        | PDO avec requêtes préparées |

### Règles de gestion respectées

✅ Note ∈ [0, 20]  
✅ CoeffMat > 0  
✅ (NEtudiant, CodeMat, Date) unique  
✅ Moyenne pondérée = Σ(Note × CoeffMat) / Σ(CoeffMat)  
✅ Moyenne matière = moyenne des notes

---

## 📁 Arborescence complète du projet

```
php_mvc_rappel/
├── 📄 index.php                          # Point d'entrée (routeur principal)
├── 📄 README.md                          # Documentation du projet
├── 📄 INSTALLATION.md                    # Guide d'installation
├── 📄 CALCULS.md                         # Documentation des formules et calculs
├── 📄 COMPTE_RENDU.md                    # Ce fichier
├── 📄 gestionscolarite.sql               # Script de création BD
│
├── 📁 config/
│   └── 📄 db.php                         # Configuration base de données
│       - Classe Gestionscolarite
│       - Méthode connect() pour PDO
│
├── 📁 controlleurs/                      # Couche Contrôleur (MVC)
│   ├── 📄 etudiantControlleur.php        # Gestion des étudiants
│   │   - Méthodes : lister(), Ajouter(), Modifier(), Supprimer()
│   ├── 📄 matiereControlleur.php         # Gestion des matières
│   │   - Méthodes : lister(), ajouter(), modifier(), supprimer()
│   ├── 📄 evaluationControlleur.php      # Gestion des évaluations
│   │   - Méthodes : lister(), ajouter(), modifier(), supprimer()
│   └── 📄 tableauDeBordControlleur.php   # Tableau de bord
│       - Méthode : index()
│
├── 📁 models/                            # Couche Modèle (MVC)
│   ├── 📄 etudiantModel.php              # Modèle Étudiant
│   │   - lister() : Liste avec pagination et recherche
│   │   - Ajouter() : Insertion en BD
│   │   - Modifier() : Mise à jour
│   │   - Supprimer() : Suppression avec transaction
│   │   - countAll() : Compte les étudiants
│   ├── 📄 matiereModel.php               # Modèle Matière
│   │   - lister() : Liste avec pagination
│   │   - rechercher() : Recherche par libellé
│   │   - modifier() : Mise à jour
│   │   - Supprimer() : Suppression avec transaction
│   │   - Ajouter() : Insertion
│   ├── 📄 evaluationModel.php            # Modèle Évaluation
│   │   - lister() : Affiche toutes les évaluations
│   │   - ajouter() : Ajout d'une évaluation
│   │   - modifier() : Modification d'une évaluation
│   │   - supprimer() : Suppression d'une évaluation
│   └── 📄 tableauDeBordModel.php         # Modèle Tableau de bord
│       - index() : Statistiques et top 5
│
├── 📁 vues/                              # Couche Vue (MVC)
│   ├── 📁 layout/                        # Éléments partagés
│   │   ├── 📄 Header.php                 # Navigation principale (Bootstrap)
│   │   └── 📄 Footer.php                 # Pied de page
│   │
│   ├── 📁 Etudiants/                     # Vues pour les étudiants
│   │   ├── 📄 index.php                  # Page principale
│   │   ├── 📄 Liste.php                  # Tableau des étudiants
│   │   ├── 📄 FormAjouter.php            # Formulaire d'ajout
│   │   ├── 📄 FormModifier.php           # Formulaire de modification
│   │   └── 📄 FormRechercher.php         # Barre de recherche
│   │
│   ├── 📁 Matières/                      # Vues pour les matières
│   │   ├── 📄 index.php                  # Page principale
│   │   ├── 📄 Liste.php                  # Tableau des matières
│   │   ├── 📄 FormAjouter.php            # Formulaire d'ajout
│   │   ├── 📄 FormModifier.php           # Formulaire de modification
│   │   └── 📄 FormRechercher.php         # Barre de recherche
│   │
│   ├── 📁 Evaluations/                   # Vues pour les évaluations
│   │   ├── 📄 index.php                  # Page principale
│   │   ├── 📄 Liste.php                  # Tableau des évaluations
│   │   ├── 📄 FormAjouter.php            # Formulaire d'ajout
│   │   ├── 📄 FormModifier.php           # Formulaire de modification
│   │   └── 📄 FormRechercher.php         # Barre de recherche
│   │
│   └── 📁 TableauDeBord/                 # Vues du tableau de bord
│       ├── 📄 index.php                  # Page principale
│       ├── 📄 Nombre.php                 # Statistiques (compteurs)
│       └── 📄 top5.php                   # Top 5 étudiants/matières
│
├── 📁 assets/                            # Fichiers statiques
│   ├── 📁 CSS/
│   │   └── 📄 styles.css                 # Feuille de style personnalisée
│   └── 📁 JS/
│       ├── 📄 etudiants.js               # Logique pour les étudiants
│       ├── 📄 evaluation.js              # Logique pour les évaluations
│       └── 📄 matiere.js                 # Logique pour les matières
│
└── 📁 public/                            # Dossier public (optionnel)
    └── (Fichiers statiques accessibles directement)
```

**Total de fichiers** :

- 📄 PHP : 20 fichiers
- 📄 Markdown : 4 fichiers
- 📄 CSS : 1 fichier
- 📄 JavaScript : 3 fichiers
- 📄 SQL : 1 fichier

---

## 🏗️ Architecture et conception

### Pattern MVC appliqué

```
┌─────────────────────────────────────────────────────────────┐
│                    NAVIGATEUR (HTML/CSS/JS)                 │
└──────────────────────┬──────────────────────────────────────┘
                       │
                       ▼
┌─────────────────────────────────────────────────────────────┐
│                  INDEX.PHP (ROUTEUR)                        │
│         Détecte l'action et appelle le contrôleur           │
└──────────────────────┬──────────────────────────────────────┘
                       │
                       ▼
┌─────────────────────────────────────────────────────────────┐
│             CONTROLLEUR (Logique métier)                    │
│  - etudiantControlleur.php                                  │
│  - matiereControlleur.php                                   │
│  - evaluationControlleur.php                                │
│  - tableauDeBordControlleur.php                             │
└──────────────────────┬──────────────────────────────────────┘
                       │
          ┌────────────┴────────────┐
          ▼                         ▼
    ┌──────────────┐         ┌──────────────┐
    │   MODÈLE     │         │     VUE      │
    │  (Requêtes   │         │  (Affichage) │
    │    SQL)      │         │              │
    └──────┬───────┘         └──────┬───────┘
           │                        │
           ▼                        ▼
    ┌──────────────┐         ┌──────────────┐
    │   BASE DE    │         │   HTML/CSS   │
    │    DONNÉES   │         │  Bootstrap   │
    └──────────────┘         └──────────────┘
```

### Flux de requête typique

```
Utilisateur clique sur un lien
        ↓
index.php?action=Etudiant
        ↓
Router (switch sur $action)
        ↓
EtudiantControlleur::lister()
        ↓
EtudiantModel::lister() → PDO → MySQL
        ↓
Retour des données
        ↓
Vue : vues/Etudiants/index.php
        ↓
Affichage HTML Bootstrap
```

---

## ✨ Fonctionnalités implémentées

### 1️⃣ **Gestion des Étudiants**

#### Lister les étudiants

- ✅ Affichage en tableau avec pagination
- ✅ Recherche par nom/prénom
- ✅ Affichage : NEtudiant, Nom, Prénom, Nombre d'évaluations, Moyenne pondérée
- ✅ Calcul en temps réel de la moyenne pondérée
- ✅ Actions : Modifier, Supprimer

**Code SQL utilisé** :

```sql
SELECT et.NEtudiant, et.Nom, et.Prenom,
  COUNT(m.CodeMat) AS NombreEvaluation,
  SUM(ev.Note * m.CoeffMat) AS AditionProduit,
  SUM(m.CoeffMat) AS AditionCoef
FROM etudiant et
JOIN evaluer ev ON et.NEtudiant = ev.NEtudiant
JOIN matiere m ON m.CodeMat = ev.CodeMat
GROUP BY et.NEtudiant
```

#### Ajouter un étudiant

- ✅ Formulaire modal avec Bootstrap
- ✅ Validation : Nom et Prénom requis
- ✅ Insertion via requête préparée

#### Modifier un étudiant

- ✅ Remplissage automatique du formulaire
- ✅ Mise à jour des données
- ✅ Rafraîchissement du tableau

#### Supprimer un étudiant

- ✅ Transaction SQL : Suppression des évaluations → Suppression étudiant
- ✅ Validation avant suppression
- ✅ Gestion des clés étrangères

---

### 2️⃣ **Gestion des Matières**

#### Lister les matières

- ✅ Affichage en tableau avec pagination
- ✅ Recherche par libellé
- ✅ Affichage : CodeMat, Libellé, Coefficient, Moyenne
- ✅ Calcul de la moyenne : SUM(Note) / COUNT(Note)
- ✅ Actions : Modifier, Supprimer

**Code SQL utilisé** :

```sql
SELECT m.CodeMat, m.LibelleMat, m.CoeffMat,
  SUM(ev.Note) / COUNT(ev.Note) AS Moyenne
FROM evaluer ev
JOIN matiere m ON ev.CodeMat = m.CodeMat
GROUP BY ev.CodeMat
```

#### Ajouter une matière

- ✅ Validation : Libellé requis, Coefficient > 0
- ✅ Contrôle au niveau BD (CONSTRAINT CHECK)
- ✅ Requête préparée sécurisée

#### Modifier une matière

- ✅ Modification du libellé et du coefficient
- ✅ Validation : Coefficient > 0

#### Supprimer une matière

- ✅ Transaction SQL
- ✅ Suppression en cascade des évaluations

---

### 3️⃣ **Gestion des Évaluations**

#### Lister les évaluations

- ✅ Affichage complet : NEtudiant, CodeMat, Date, Note
- ✅ Affichage des noms d'étudiants et libellés matières
- ✅ Tri par date décroissante
- ✅ Actions : Modifier, Supprimer

**Colonnes affichées** :

- Nom Étudiant
- Prénom Étudiant
- Matière
- Date
- Note (0-20)

#### Ajouter une évaluation

- ✅ Sélection étudiant (dropdown)
- ✅ Sélection matière (dropdown)
- ✅ Saisie date et note
- ✅ Validation : Note ∈ [0, 20]
- ✅ Contrainte unique (NEtudiant, CodeMat, Date)

#### Modifier une évaluation

- ✅ Mise à jour de la note
- ✅ Modification de la date
- ✅ Respect de la contrainte unique

#### Supprimer une évaluation

- ✅ Suppression simple

---

### 4️⃣ **Tableau de Bord (Accueil)**

#### Statistiques générales

- ✅ Nombre total d'étudiants
- ✅ Nombre total de matières
- ✅ Nombre total d'évaluations
- ✅ Affichage avec des cartes Bootstrap colorées

#### Top 5 Étudiants

- ✅ Classement par moyenne pondérée (décroissant)
- ✅ Affichage : Rang, Nom, Prénom, Nombre matières, Moyenne
- ✅ Tableau stylisé avec indicateurs visuels

**Requête** :

```sql
SELECT et.NEtudiant, CONCAT(et.Nom, ' ', et.Prenom) as Etudiant,
  COUNT(m.CodeMat) AS Nb_matiere,
  SUM(ev.Note * m.CoeffMat) / SUM(m.CoeffMat) AS Moyenne
FROM etudiant et
JOIN evaluer ev ON et.NEtudiant = ev.NEtudiant
JOIN matiere m ON m.CodeMat = ev.CodeMat
GROUP BY et.NEtudiant
ORDER BY Moyenne DESC
LIMIT 5
```

#### Top 5 Matières

- ✅ Classement par moyenne (décroissant)
- ✅ Affichage : Rang, Libellé, Coefficient, Nombre étudiants, Moyenne
- ✅ Tableau stylisé

---

## 🔧 Explications techniques

### 1. **Sécurité - Requêtes préparées**

❌ **DANGEREUX (SQL Injection)** :

```php
$sql = "SELECT * FROM etudiant WHERE Nom = '" . $_GET['nom'] . "'";
```

✅ **SÉCURISÉ (Notre approche)** :

```php
$stmt = $conn->prepare("SELECT * FROM etudiant WHERE Nom = :nom");
$stmt->execute([':nom' => $_GET['nom']]);
```

**Avantages** :

- Protection contre les injections SQL
- Séparation code/données
- Meilleure performance

---

### 2. **Transactions pour l'intégrité**

**Exemple : Suppression d'un étudiant**

```php
$conn->beginTransaction();
  // D'abord supprimer les évaluations (clé étrangère)
  $stmt1->execute([':NEtudiant' => $id]);
  // Puis supprimer l'étudiant
  $stmt2->execute([':NEtudiant' => $id]);
$conn->commit();
```

**Avantages** :

- Tout s'exécute ou rien (atomicité)
- Pas de données orphelines
- Cohérence garantie

---

### 3. **Calcul de la moyenne pondérée**

**Formula mathématique** :
$$\text{Moyenne Pondérée} = \frac{\sum (\text{Note} \times \text{CoeffMat})}{\sum \text{CoeffMat}}$$

**Exemple concret** :

- Mathématiques : Note = 15, Coeff = 3.5
- Français : Note = 14, Coeff = 2.0
- Informatique : Note = 18, Coeff = 4.0

$$\text{Moyenne} = \frac{(15 \times 3.5) + (14 \times 2) + (18 \times 4)}{3.5 + 2 + 4} = \frac{152.5}{9.5} = 16.05$$

**Code SQL** :

```sql
SUM(ev.Note * m.CoeffMat) / SUM(m.CoeffMat) AS MoyennePonderee
```

---

### 4. **Pagination**

**Implémentation** :

```php
$limit = 10;  // Par page
$offset = ($page - 1) * $limit;

$sql = "... LIMIT :offset, :limit";
$stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
```

**Calcul du nombre de pages** :

```php
$totalPages = ceil($totalCount / $limit);
```

---

### 5. **Gestion des erreurs PDO**

```php
try {
  $stmt = $conn->prepare($sql);
  $stmt->execute($params);
  return $stmt->fetchAll();
} catch (PDOException $e) {
  echo "Erreur SQL : " . $e->getMessage();
  return [];
}
```

---

## 🎨 Interface utilisateur

### Bootstrap 5 utilisé pour :

- **Navigation** : Navbar responsive
- **Formulaires** : Inputs stylisés, validation
- **Tableaux** : Responsive, striped, hover
- **Modales** : Popups pour les formulaires
- **Alertes** : Messages de succès/erreur
- **Icônes** : Bootstrap Icons

### Personnalisation CSS

- Fichier `assets/CSS/styles.css`
- Couleurs harmonieuses
- Responsive design (mobile-friendly)

---

## 📊 Schéma de base de données

```sql
┌─────────────┐         ┌──────────────┐
│  ETUDIANT   │         │   MATIERE    │
├─────────────┤         ├──────────────┤
│ NEtudiant   │◄────┐   │ CodeMat      │
│ Nom         │     │   │ LibelleMat   │
│ Prenom      │     │   │ CoeffMat > 0 │
└─────────────┘     │   └──────────────┘
                    │
                    │
            ┌───────┴────────┐
            │    EVALUER     │
            ├────────────────┤
            │ NEtudiant (FK) │
            │ CodeMat (FK)   │
            │ Date           │
            │ Note [0-20]    │
            │ PK: (NEtudiant,│
            │     CodeMat,   │
            │     Date)      │
            └────────────────┘
```

**Contraintes** :

- `CHECK (Note >= 0 AND Note <= 20)`
- `CHECK (CoeffMat > 0)`
- `UNIQUE (NEtudiant, CodeMat, Date)`
- Clés étrangères avec intégrité référentielle

---

## ✅ Critères de validation du TP

| Critère                    | Statut | Détails                                       |
| -------------------------- | ------ | --------------------------------------------- |
| Architecture MVC           | ✅     | Modèles, Contrôleurs, Vues bien séparés       |
| Gestion Étudiants (CRUD)   | ✅     | Lister, Ajouter, Modifier, Supprimer          |
| Gestion Matières (CRUD)    | ✅     | Lister, Ajouter, Modifier, Supprimer          |
| Gestion Évaluations (CRUD) | ✅     | Lister, Ajouter, Modifier, Supprimer          |
| Recherche/Filtrage         | ✅     | Nom/Prénom étudiant, Libellé matière          |
| Pagination                 | ✅     | 10 étudiants par page                         |
| Moyenne pondérée           | ✅     | Formule correcte : Σ(Note × Coeff) / Σ(Coeff) |
| Moyenne matière            | ✅     | SUM/COUNT ou AVG                              |
| Top 5 étudiants            | ✅     | Classement par moyenne                        |
| Top 5 matières             | ✅     | Classement par moyenne                        |
| Tableau de bord            | ✅     | Statistiques + Top 5                          |
| Requêtes préparées         | ✅     | PDO - protection SQL Injection                |
| Transactions               | ✅     | Suppressions en cascade                       |
| Bootstrap                  | ✅     | Interface moderne et responsive               |
| Validation données         | ✅     | Note [0-20], Coeff > 0, champs requis         |

---

## 🚀 Points clés du projet

### 1. **Robustesse**

- ✅ Requêtes préparées (sécurité)
- ✅ Transactions (intégrité)
- ✅ Gestion des erreurs PDO
- ✅ Validation côté serveur

### 2. **Ergonomie**

- ✅ Interface Bootstrap responsive
- ✅ Modales pour les formulaires
- ✅ Navigation claire et intuitive
- ✅ Recherche et pagination

### 3. **Performance**

- ✅ Requêtes optimisées (JOINs)
- ✅ Pagination des résultats
- ✅ Pas de N+1 queries
- ✅ Connexion BD réutilisée

### 4. **Maintenabilité**

- ✅ Code organisé en MVC
- ✅ Noms explicites
- ✅ Commentaires
- ✅ Fichiers README et documentation

---

## 🎓 Concepts PHP apprris et maîtrisés

### 1. **Programmation Orientée Objet (POO)**

- Classes statiques
- Encapsulation (public/private)
- Gestion des dépendances

### 2. **Traitement des données**

- Tableaux et tableaux associatifs
- Boucles (foreach)
- Conditions avancées

### 3. **Base de données**

- PDO pour l'accès BD
- Requêtes préparées
- Transactions
- JOINs SQL avancés

### 4. **Formulaires web**

- Envoi GET/POST
- Traitement des données
- Validation côté serveur

### 5. **Architecture**

- Pattern MVC
- Séparation des responsabilités
- Routeur simple

---

## 📚 Technologies maîtrisées

```
Frontend:
├── HTML5 (structure sémantique)
├── CSS3 (flexbox, grid)
├── Bootstrap 5 (components, grid system)
├── Bootstrap Icons (icônes)
└── JavaScript ES6+ (interactivité)

Backend:
├── PHP 7.2+ (langage)
├── PDO (abstraction BD)
├── MySQL (base de données)
└── Architecture MVC

Outils:
├── Git (version control)
├── GitHub (collaboration)
└── PhpMyAdmin (gestion BD)
```

---

## 📝 Fichiers de documentation

| Fichier           | Contenu                                   |
| ----------------- | ----------------------------------------- |
| `README.md`       | Vue d'ensemble, installation, utilisation |
| `INSTALLATION.md` | Guide pas à pas pour installer            |
| `CALCULS.md`      | Formules mathématiques et implémentations |
| `COMPTE_RENDU.md` | Ce fichier - rapport détaillé             |

---

## 🔍 Exemple d'utilisation

### Scénario : Ajouter une évaluation

```
1. Cliquer sur "Évaluations" → "Ajouter"
2. Sélectionner un étudiant (dropdown)
3. Sélectionner une matière (dropdown)
4. Saisir la date
5. Saisir la note (0-20)
6. Valider
7. La BD insère : INSERT INTO EVALUER (NEtudiant, CodeMat, Date, Note)
8. Retour à la liste mise à jour
9. Les moyennes se recalculent automatiquement
```

### Scénario : Supprimer un étudiant

```
1. Aller à la page Étudiants
2. Cliquer sur "Supprimer" pour un étudiant
3. Confirmation requise
4. Exécution :
   - BEGIN TRANSACTION
   - DELETE FROM EVALUER WHERE NEtudiant = ?
   - DELETE FROM ETUDIANT WHERE NEtudiant = ?
   - COMMIT
5. Retour à la liste (étudiant et ses notes disparus)
```

---

## 🎯 Conclusion

Ce projet **démontre une maîtrise complète** :

✅ **De l'architecture MVC** - Séparation claire des responsabilités  
✅ **De PHP moderne** - POO, PDO, gestion d'erreurs  
✅ **De SQL avancé** - JOINs, transactions, contraintes  
✅ **D'ergonomie web** - Bootstrap, responsive, accessible  
✅ **De sécurité** - Requêtes préparées, validation

Le projet est **prêt pour la production** (dans un contexte éducatif) et peut servir de **base solide** pour des développements futurs.

### Améliorations possibles

Pour une version v2.0, on pourrait ajouter :

- 🔐 Système d'authentification
- 📊 Graphiques de progression (Chart.js)
- 📧 Notifications par email
- 📱 API REST
- 🧪 Tests unitaires (PHPUnit)
- 🐳 Containerisation (Docker)
- ☁️ Déploiement cloud

---

**Rapport généré le** : 16 novembre 2025  
**Version du projet** : 1.0  
**Statut** : ✅ Complété et validé
