# Documentation des Calculs - Gestion Scolarité

## 1. Moyenne Pondérée d'un Étudiant

### Formule

$$\text{Moyenne Pondérée} = \frac{\sum (\text{Note} \times \text{CoeffMat})}{\sum \text{CoeffMat}}$$

### Explication

- **Note** : La note obtenue par l'étudiant (entre 0 et 20)
- **CoeffMat** : Le coefficient de la matière
- On fait la somme de (Note × Coefficient) pour toutes les matières
- On divise par la somme de tous les coefficients

### Exemple

Étudiant : Jean Dupont

- Mathématiques : Note = 15, Coefficient = 3.5
- Français : Note = 14, Coefficient = 2.0
- Informatique : Note = 18, Coefficient = 4.0

**Calcul :**
$$\text{Moyenne} = \frac{(15 \times 3.5) + (14 \times 2.0) + (18 \times 4.0)}{3.5 + 2.0 + 4.0}$$
$$= \frac{52.5 + 28 + 72}{9.5}$$
$$= \frac{152.5}{9.5}$$
$$= 16.05$$

### Code SQL

```sql
SELECT
  e.NEtudiant,
  e.Nom,
  e.Prenom,
  ROUND(SUM(ev.Note * m.CoeffMat) / SUM(m.CoeffMat), 2) as MoyennePonderee
FROM ETUDIANT e
LEFT JOIN EVALUER ev ON e.NEtudiant = ev.NEtudiant
LEFT JOIN MATIERE m ON ev.CodeMat = m.CodeMat
GROUP BY e.NEtudiant, e.Nom, e.Prenom
ORDER BY MoyennePonderee DESC;
```

### Code PHP (Modèle - EtudiantModel.php)

**Implémentation actuelle dans votre projet :**

```php
public static function lister($recherche = '', $offset = 0, $limit = 10) {
  $conn = Gestionscolarite::connect();
  $requete = "SELECT et.NEtudiant, et.Nom, et.Prenom,
    COUNT(m.CodeMat) AS NombreEvaluation,
    SUM(ev.Note * m.CoeffMat) AS AditionProduit,
    SUM(m.CoeffMat) AS AditionCoef
  FROM etudiant et
  JOIN evaluer ev ON et.NEtudiant = ev.NEtudiant
  JOIN matiere m ON m.CodeMat = ev.CodeMat";

  // ... filtrage et pagination

  // La moyenne pondérée est calculée dans la vue :
  // $moyenne = $student['AditionProduit'] / $student['AditionCoef'];
}
```

**La moyenne pondérée est calculée dans la vue à partir des valeurs retournées :**

- `AditionProduit` = SUM(Note × CoeffMat)
- `AditionCoef` = SUM(CoeffMat)
- Moyenne pondérée = AditionProduit / AditionCoef

---

## 2. Moyenne d'une Matière

### Formule

$$\text{Moyenne Matière} = \frac{\sum \text{Notes pour cette matière}}{n}$$

où $n$ = nombre d'étudiants évalués

### Explication

- On prend toutes les notes saisies pour une matière donnée
- On les additionne
- On divise par le nombre de notes (nombre d'étudiants évalués)

### Exemple

Matière : Mathématiques

- Étudiant 1 : 15
- Étudiant 2 : 12
- Étudiant 3 : 18
- Étudiant 4 : 14
- Étudiant 5 : 16

**Calcul :**
$$\text{Moyenne} = \frac{15 + 12 + 18 + 14 + 16}{5} = \frac{75}{5} = 15$$

### Code SQL

```sql
SELECT
  m.CodeMat,
  m.LibelleMat,
  m.CoeffMat,
  ROUND(AVG(ev.Note), 2) as MoyenneMatiere,
  COUNT(DISTINCT ev.NEtudiant) as NbEtudiants
FROM MATIERE m
LEFT JOIN EVALUER ev ON m.CodeMat = ev.CodeMat
GROUP BY m.CodeMat, m.LibelleMat, m.CoeffMat
ORDER BY MoyenneMatiere DESC;
```

### Code PHP (Modèle - MatiereModel.php)

**Implémentation actuelle dans votre projet :**

```php
public static function lister($offset = 0, $limit = 10){
  $conn = Gestionscolarite::connect();
  $stmt = $conn->prepare(
    "SELECT m.CodeMat,
      m.LibelleMat,
      m.CoeffMat,
      SUM(ev.Note) / COUNT(ev.Note) AS 'Moyenne'
    FROM evaluer ev
    JOIN matiere m ON ev.CodeMat = m.CodeMat
    GROUP BY ev.CodeMat
    LIMIT :offset, :limit");
  // ...
}
```

**Formule appliquée dans la requête :**

- `SUM(ev.Note) / COUNT(ev.Note)` = Moyenne arithmétique des notes
- Cette formule est équivalente à `AVG(ev.Note)`

---

## 3. Top 5 Étudiants par Moyenne Pondérée

### Requête SQL (TableauDeBordModel.php)

**Implémentation actuelle dans votre projet :**

```sql
SELECT et.NEtudiant,
  CONCAT(et.Nom, ' ', et.Prenom) as Etudiant,
  COUNT(m.CodeMat) AS 'Nb. matiere',
  SUM(ev.Note * m.CoeffMat) / SUM(m.CoeffMat) AS Moyenne
FROM etudiant et
JOIN evaluer ev ON et.NEtudiant = ev.NEtudiant
JOIN matiere m ON m.CodeMat = ev.CodeMat
GROUP BY et.NEtudiant
ORDER BY Moyenne DESC
LIMIT 5
```

**Points clés :**

- Calcul direct de la moyenne pondérée : `SUM(ev.Note * m.CoeffMat) / SUM(m.CoeffMat)`
- Tri décroissant par moyenne
- Limite aux 5 premiers résultats

### Résultat exemple

| NEtudiant | Nom     | Prenom   | MoyennePonderee |
| --------- | ------- | -------- | --------------- |
| 3         | Bernard | Pierre   | 18.23           |
| 8         | Durand  | Isabelle | 17.56           |
| 1         | Dupont  | Jean     | 16.05           |
| 5         | Robert  | Luc      | 15.89           |
| 4         | Thomas  | Sophie   | 14.78           |

---

## 4. Top 5 Matières par Moyenne

### Requête SQL (TableauDeBordModel.php)

**Implémentation actuelle dans votre projet :**

```sql
SELECT m.CodeMat,
  m.LibelleMat,
  m.CoeffMat,
  SUM(ev.Note) / COUNT(ev.CodeMat) AS Moyenne
FROM matiere m
JOIN evaluer ev ON ev.CodeMat = m.CodeMat
GROUP BY ev.CodeMat
ORDER BY Moyenne DESC
LIMIT 5
```

**Points clés :**

- Moyenne simple des notes : `SUM(ev.Note) / COUNT(ev.CodeMat)`
- Tri décroissant par moyenne
- Limite aux 5 premiers résultats

### Résultat exemple

| CodeMat | LibelleMat    | CoeffMat | MoyenneMatiere | NbEtudiants |
| ------- | ------------- | -------- | -------------- | ----------- |
| 4       | Informatique  | 4.00     | 16.81          | 8           |
| 1       | Mathématiques | 3.50     | 15.19          | 8           |
| 3       | Histoire      | 1.50     | 14.88          | 8           |
| 6       | Physique      | 3.00     | 14.56          | 8           |
| 5       | Anglais       | 2.50     | 14.25          | 8           |

---

## 5. Statistiques Générales du Tableau de Bord

### Nombre d'Étudiants

```sql
SELECT COUNT(*) as NbEtudiants FROM ETUDIANT;
```

### Nombre de Matières

```sql
SELECT COUNT(*) as NbMatieres FROM MATIERE;
```

### Nombre d'Évaluations

```sql
SELECT COUNT(*) as NbEvaluations FROM EVALUER;
```

### Moyenne Générale (tous les étudiants)

```sql
SELECT ROUND(AVG(Note), 2) as MoyenneGenerale FROM EVALUER;
```

### Note Maximale

```sql
SELECT MAX(Note) as NoteMax FROM EVALUER;
```

### Note Minimale

```sql
SELECT MIN(Note) as NoteMin FROM EVALUER;
```

---

## ⚠️ Important : Note sur l'Implémentation

### Différence entre la théorie et l'implémentation

Le CALCULS.md contient les formules **théoriques** du TP, mais votre implémentation PHP a fait des **choix d'optimisation** :

#### 1. **Moyenne Pondérée d'un Étudiant**

- **Théorie (TP)** : Toutes les matières, même sans évaluation

  ```sql
  LEFT JOIN EVALUER -- pour les matières sans notes
  ```

- **Implémentation** : Seules les matières évaluées
  ```sql
  JOIN EVALUER -- seulement matières avec notes
  ```

**Conséquence** : Un étudiant sans notes = pas d'entrée affichée (non listé)

---

#### 2. **Moyenne de Matière**

- **Théorie (TP)** : `ROUND(AVG(Note), 2)`

- **Implémentation** : `SUM(ev.Note) / COUNT(ev.Note)` (équivalent mathématiquement)

**Résultat identique**, mais implémentation directe du calcul

---

#### 3. **Top 5 Étudiants et Matières**

- Votre implémentation utilise `JOIN` (pas `LEFT JOIN`)
- Les étudiants/matières sans évaluation ne sont pas listés
- Cela évite les valeurs NULL et les divisions par zéro

---

## Formule Théorique vs Implémentation

| Aspect               | Théorie (TP)                | Votre Projet                |
| -------------------- | --------------------------- | --------------------------- |
| Étudiants sans notes | Affichés (moyenne = 0/NULL) | Non affichés                |
| Matières sans notes  | Affichées (moyenne = NULL)  | Non affichées               |
| Type de jointure     | LEFT JOIN                   | JOIN                        |
| Arrondissement       | ROUND(..., 2)               | Pas d'arrondissement en SQL |
| Calcul de moyenne    | AVG()                       | SUM/COUNT                   |

---

## ✅ Vérification du Calcul

Pour vérifier que vos calculs sont corrects, vous pouvez utiliser ces requêtes de test :

### ⚠️ Cas des étudiants sans évaluation

- Si un étudiant n'a pas d'évaluation, sa moyenne pondérée = 0 ou NULL
- La requête utilise `LEFT JOIN` pour inclure les étudiants sans notes

### ⚠️ Cas des matières sans évaluation

- Si une matière n'a pas d'évaluation, sa moyenne = NULL
- La requête utilise `LEFT JOIN` pour inclure les matières sans notes

### ✅ Cas à gérer en PHP

```php
// Éviter la division par zéro
if ($sommeCoeff > 0) {
  $moyenne = $sommePonds / $sommeCoeff;
} else {
  $moyenne = 0; // Pas d'évaluation
}

// Arrondir à 2 décimales
$moyenne = round($moyenne, 2);
```

---

## Implémentation du Tableau de Bord (TableauDeBordModel.php)

```php
public static function index(){
  $conn = Gestionscolarite::connect();

  // Nombre d'étudiants
  $requete1 = "SELECT COUNT(*) as nbr FROM etudiant";

  // Nombre de matières
  $requete2 = "SELECT COUNT(*) as nbr FROM matiere";

  // Nombre d'évaluations
  $requete3 = "SELECT COUNT(*) as nbr FROM evaluer";

  // Top 5 Étudiants par moyenne pondérée
  $requete4 =
  "SELECT et.NEtudiant,
    CONCAT(et.Nom, ' ', et.Prenom) as Etudiant,
    COUNT(m.CodeMat) AS 'Nb. matiere',
    SUM(ev.Note * m.CoeffMat) / SUM(m.CoeffMat) AS Moyenne
  FROM etudiant et
  JOIN evaluer ev ON et.NEtudiant = ev.NEtudiant
  JOIN matiere m ON m.CodeMat = ev.CodeMat
  GROUP BY et.NEtudiant
  ORDER BY Moyenne DESC
  LIMIT 5";

  // Top 5 Matières par moyenne
  $requete5 =
  "SELECT m.CodeMat,
    m.LibelleMat,
    m.CoeffMat,
    SUM(ev.Note) / COUNT(ev.CodeMat) AS Moyenne
  FROM matiere m
  JOIN evaluer ev ON ev.CodeMat = m.CodeMat
  GROUP BY ev.CodeMat
  ORDER BY Moyenne DESC
  LIMIT 5";

  // Exécution des requêtes
  $nbrEtu = $conn->query($requete1)->fetchAll();
  $nbrMat = $conn->query($requete2)->fetchAll();
  $nbrEva = $conn->query($requete3)->fetchAll();
  $topEtu = $conn->query($requete4)->fetchAll();
  $topMat = $conn->query($requete5)->fetchAll();

  return [
    'nbrEtu' => $nbrEtu,
    'nbrMat' => $nbrMat,
    'nbrEva' => $nbrEva,
    'topEtu' => $topEtu,
    'topMat' => $topMat
  ];
}
```

---

## 🧪 Requêtes de Vérification dans PhpMyAdmin

### 1. Vérifier les données de base

```sql
-- Nombre d'étudiants
SELECT COUNT(*) as NbEtudiants FROM etudiant;

-- Nombre de matières
SELECT COUNT(*) as NbMatieres FROM matiere;

-- Nombre d'évaluations
SELECT COUNT(*) as NbEvaluations FROM evaluer;
```

### 2. Vérifier les moyennes d'un étudiant spécifique

```sql
-- Étudiant #1 avec détail
SELECT
  e.NEtudiant,
  CONCAT(e.Nom, ' ', e.Prenom) as Etudiant,
  m.LibelleMat,
  ev.Note,
  m.CoeffMat,
  ev.Note * m.CoeffMat as Produit
FROM etudiant e
JOIN evaluer ev ON e.NEtudiant = ev.NEtudiant
JOIN matiere m ON ev.CodeMat = m.CodeMat
WHERE e.NEtudiant = 1
ORDER BY m.LibelleMat;

-- Moyenne pondérée de l'étudiant #1
SELECT
  e.NEtudiant,
  CONCAT(e.Nom, ' ', e.Prenom) as Etudiant,
  ROUND(SUM(ev.Note * m.CoeffMat) / SUM(m.CoeffMat), 2) as MoyennePonderee
FROM etudiant e
JOIN evaluer ev ON e.NEtudiant = ev.NEtudiant
JOIN matiere m ON ev.CodeMat = m.CodeMat
WHERE e.NEtudiant = 1;
```

### 3. Vérifier les moyennes d'une matière spécifique

```sql
-- Matière #1 avec détail
SELECT
  m.CodeMat,
  m.LibelleMat,
  m.CoeffMat,
  e.Nom,
  e.Prenom,
  ev.Note,
  ev.Date
FROM matiere m
JOIN evaluer ev ON m.CodeMat = ev.CodeMat
JOIN etudiant e ON ev.NEtudiant = e.NEtudiant
WHERE m.CodeMat = 1
ORDER BY e.Nom;

-- Moyenne de la matière #1
SELECT
  m.CodeMat,
  m.LibelleMat,
  m.CoeffMat,
  ROUND(AVG(ev.Note), 2) as MoyenneMatiere,
  COUNT(DISTINCT ev.NEtudiant) as NbEtudiants
FROM matiere m
JOIN evaluer ev ON m.CodeMat = ev.CodeMat
WHERE m.CodeMat = 1;
```

### 4. Top 5 complet avec détail

```sql
-- Top 5 Étudiants avec notes
SELECT
  e.NEtudiant,
  CONCAT(e.Nom, ' ', e.Prenom) as Etudiant,
  ROUND(SUM(ev.Note * m.CoeffMat) / SUM(m.CoeffMat), 2) as Moyenne,
  COUNT(DISTINCT m.CodeMat) as NbMatieres
FROM etudiant e
JOIN evaluer ev ON e.NEtudiant = ev.NEtudiant
JOIN matiere m ON ev.CodeMat = m.CodeMat
GROUP BY e.NEtudiant
ORDER BY Moyenne DESC
LIMIT 5;

-- Top 5 Matières avec notes
SELECT
  m.CodeMat,
  m.LibelleMat,
  m.CoeffMat,
  ROUND(AVG(ev.Note), 2) as Moyenne,
  COUNT(DISTINCT ev.NEtudiant) as NbEtudiants
FROM matiere m
JOIN evaluer ev ON m.CodeMat = ev.CodeMat
GROUP BY m.CodeMat
ORDER BY Moyenne DESC
LIMIT 5;
```

---

**Créé le :** 16 novembre 2025
**Mis à jour le :** 16 novembre 2025 - Synchronisation avec l'implémentation réelle
