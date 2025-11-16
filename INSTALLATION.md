# Guide d'Installation Détaillé - Gestion Scolarité

## 📋 Table des matières

1. [Prérequis](#prérequis)
2. [Installation XAMPP](#installation-xampp)
3. [Configuration Base de Données](#configuration-base-de-données)
4. [Configuration du Projet](#configuration-du-projet)
5. [Vérification](#vérification)
6. [Dépannage](#dépannage)

---

## Prérequis

### Système d'exploitation

- Windows 7, 8, 10, 11
- macOS 10.12+
- Linux (Ubuntu 16.04+, CentOS 7+)

### Logiciels requis

- **PHP** 7.2 ou supérieur (inclus dans XAMPP)
- **MySQL/MariaDB** 5.7+ (inclus dans XAMPP)
- **Apache** 2.4+ (inclus dans XAMPP)
- **Navigateur moderne** (Chrome, Firefox, Edge, Safari)

### Extensions PHP nécessaires

- PDO (PHP Data Objects) ✅
- PDO MySQL Driver ✅
- OpenSSL ✅

---

## Installation XAMPP

### Étape 1 : Télécharger XAMPP

1. Accédez au site [Apache Friends](https://www.apachefriends.org)
2. Téléchargez la version **XAMPP 7.2+** (ou PHP 8.x recommandé)
3. Choisissez votre système d'exploitation

### Étape 2 : Installer XAMPP

#### ✅ Windows

```
1. Double-cliquez sur xampp-windows-x64-X.X.X-installer.exe
2. Acceptez les conditions
3. Choisissez le dossier d'installation : C:\xampp
4. Complétez l'installation
5. Lancez le XAMPP Control Panel
```

#### ✅ macOS

```
1. Ouvrez xampp-osx-X.X.X-installer.dmg
2. Glissez-déposez le dossier XAMPP dans Applications
3. Lancez /Applications/XAMPP/manager-osx.app
```

#### ✅ Linux

```bash
sudo tar xvfz xampp-linux-x64-X.X.X-installer.tar.gz -C /opt
sudo /opt/lampp/manager-linux.run
```

### Étape 3 : Vérifier XAMPP

1. Ouvrez le XAMPP Control Panel
2. Cliquez sur "Start" pour :
   - **Apache** (serveur web)
   - **MySQL** (base de données)
3. Les deux services doivent être "Running" (vert)

#### Vérification par navigateur

```
http://localhost/dashboard/
```

---

## Configuration Base de Données

### Méthode 1 : PHPMyAdmin (Recommandée - Graphique)

#### Étape 1 : Accéder à PHPMyAdmin

```
http://localhost/phpmyadmin/
```

#### Étape 2 : Importer le script SQL

1. Cliquez sur l'onglet **"Importer"**
2. Cliquez sur **"Parcourir"**
3. Sélectionnez le fichier `gestionscolarite.sql`
4. Cliquez sur **"Exécuter"**

✅ Résultat : Base de données créée avec tous les tableaux et données de test

### Méthode 2 : MySQL Workbench (GUI)

1. Ouvrez MySQL Workbench
2. Connectez-vous au serveur MySQL local
3. Allez dans **File → Open SQL Script**
4. Sélectionnez `gestionscolarite.sql`
5. Cliquez sur **Execute** (⚡)

### Méthode 3 : Ligne de commande MySQL

#### Windows

```powershell
# Ouvrir le terminal MySQL
cd C:\xampp\mysql\bin

# Exécuter le script
mysql -u root -p < "C:\chemin\vers\gestionscolarite.sql"

# (Appuyez sur Entrée quand demandé pour le mot de passe - laisser vide si aucun)
```

#### Linux/Mac

```bash
# Terminal
mysql -u root -p < gestionscolarite.sql

# Ou directement depuis le fichier
mysql -u root -p << EOF
$(cat gestionscolarite.sql)
EOF
```

### Méthode 4 : Créer manuellement

```sql
-- Étape 1 : Créer la base de données
CREATE DATABASE gestionscolarite;
USE gestionscolarite;

-- Étape 2 : Créer les tables (copier-coller le contenu de gestionscolarite.sql)

-- Étape 3 : Insérer les données de test

-- Étape 4 : Vérifier
SHOW TABLES;
SELECT COUNT(*) FROM ETUDIANT;
```

---

## Configuration du Projet

### Étape 1 : Cloner le repository

#### Via Git (Recommandé)

```bash
# Terminal/PowerShell
cd C:\xampp\htdocs

# Cloner le projet
git clone https://github.com/Bendada-Mohamed/php_mvc_rappel.git
```

#### Via téléchargement ZIP

1. Accédez à [le GitHub du projet](https://github.com/Bendada-Mohamed/php_mvc_rappel)
2. Cliquez sur **"Code"** → **"Download ZIP"**
3. Extrayez le fichier dans `C:\xampp\htdocs\`

### Étape 2 : Placer le projet au bon endroit

```
C:\xampp\htdocs\
├── php_mvc_rappel/          ← Votre projet ici
├── phpmyadmin/
├── webalizer/
└── dashboard/
```

### Étape 3 : Configurer la base de données

Ouvrez le fichier `config/db.php` :

```php
<?php
class Gestionscolarite {
  public static function connect() {
    try {
      // Configuration par défaut (XAMPP)
      $db = new PDO("mysql:host=localhost;dbname=gestionscolarite", "root", "");

      // SI vous avez changé le mot de passe MySQL, décommentez et modifiez :
      // $db = new PDO("mysql:host=localhost;dbname=gestionscolarite", "root", "votre_mot_de_passe");

      // SI votre serveur est distant :
      // $db = new PDO("mysql:host=192.168.1.100;dbname=gestionscolarite", "user", "password");

      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      return $db;
    } catch(PDOException $e) {
      die("Erreur de Connexion :" . $e->getMessage());
    }
  }
}
```

### Étape 4 : Permissions (Linux/Mac uniquement)

```bash
# Donner les permissions appropriées
chmod -R 755 /var/www/html/php_mvc_rappel/
chmod -R 644 /var/www/html/php_mvc_rappel/*.*
```

---

## Vérification

### ✅ Test 1 : Accéder à l'application

```
http://localhost/php_mvc_rappel/
```

**Résultat attendu :** Page d'accueil avec tableau de bord

### ✅ Test 2 : Naviguer dans les pages

1. **Étudiants** : `http://localhost/php_mvc_rappel/?action=Etudiant`

   - Doit afficher la liste des 8 étudiants de test

2. **Matières** : `http://localhost/php_mvc_rappel/?action=Matieres`

   - Doit afficher la liste des 6 matières de test

3. **Évaluations** : `http://localhost/php_mvc_rappel/?action=Evaluation`
   - Doit afficher la liste des 32 évaluations de test

### ✅ Test 3 : Ajouter un étudiant

1. Allez dans Étudiants
2. Cliquez sur "Ajouter un étudiant"
3. Remplissez le formulaire (Nom, Prénom)
4. Cliquez sur "Ajouter"

**Résultat attendu :** L'étudiant s'ajoute et la liste se met à jour

### ✅ Test 4 : Consulter le détail

1. Cliquez sur un étudiant
2. Vous devez voir :
   - Ses informations
   - Ses évaluations
   - Sa moyenne pondérée

### ✅ Test 5 : Rechercher

1. Allez dans Étudiants
2. Entrez un nom dans le champ "Rechercher"
3. Les résultats doivent se filtrer

---

## Dépannage

### ❌ Erreur : "Erreur de Connexion"

**Cause probable :** MySQL n'est pas en cours d'exécution

**Solution :**

1. Ouvrez XAMPP Control Panel
2. Cliquez sur "Start" pour MySQL
3. Attendez 3-5 secondes
4. Rafraîchissez la page

### ❌ Erreur : "Base de données introuvable"

**Cause probable :** Le script SQL n'a pas été exécuté

**Solution :**

1. Ouvrez PHPMyAdmin : `http://localhost/phpmyadmin/`
2. Onglet "Importer"
3. Sélectionnez `gestionscolarite.sql`
4. Cliquez sur "Exécuter"

### ❌ Erreur : "Fatal error: Class not found"

**Cause probable :** Le chemin du fichier est incorrect

**Solution :**

1. Vérifiez les chemins dans `index.php`
2. Les fichiers `controlleurs/` doivent être présents
3. Vérifiez la casse (majuscules/minuscules) sous Linux

### ❌ Erreur : "Parse error"

**Cause probable :** Erreur de syntaxe PHP

**Solution :**

1. Vérifiez les accolades fermées `}`
2. Vérifiez les guillemets
3. Activez l'affichage des erreurs dans `config/db.php` :

```php
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

### ❌ Page blanche

**Cause probable :** Erreur PHP non affichée

**Solution :**

1. Consultez les logs Apache : `C:\xampp\apache\logs\error.log`
2. Activez le mode débogage (voir ci-dessus)
3. Vérifiez que `config/db.php` est accessible

### ❌ Erreur "404 Not Found"

**Cause probable :** Dossier mal placé

**Solution :**

1. Vérifiez l'URL : doit être `http://localhost/php_mvc_rappel/`
2. Vérifiez que le dossier existe : `C:\xampp\htdocs\php_mvc_rappel\`
3. Vérifiez la présence d'`index.php`

---

## Configuration avancée

### Activer HTTPS (SSL)

Pour les tests locaux en HTTPS :

1. Ouvrez `httpd-ssl.conf` (dans Apache conf)
2. Configurez les certificats SSL
3. Accédez à `https://localhost/php_mvc_rappel/`

### Ajouter un utilisateur MySQL

```bash
# Terminal MySQL
CREATE USER 'web_user'@'localhost' IDENTIFIED BY 'password123';
GRANT ALL PRIVILEGES ON gestionscolarite.* TO 'web_user'@'localhost';
FLUSH PRIVILEGES;
```

Puis modifiez `config/db.php` :

```php
$db = new PDO("mysql:host=localhost;dbname=gestionscolarite", "web_user", "password123");
```

### Optimisations pour production

1. **Désactiver l'affichage d'erreurs :**

```php
ini_set('display_errors', 0);
error_reporting(0);
```

2. **Ajouter la journalisation :**

```php
ini_set('log_errors', 1);
ini_set('error_log', '/var/log/php_mvc.log');
```

3. **Ajouter un cache :**

```php
header('Cache-Control: public, max-age=3600');
```

4. **Compresser les réponses :**

```php
ob_start('ob_gzhandler');
```

---

## Prochaines étapes

Une fois le projet configuré et fonctionnel :

1. ✅ Explorez les fichiers du projet
2. ✅ Essayez d'ajouter/modifier/supprimer des données
3. ✅ Consultez le fichier `CALCULS.md` pour comprendre les formules
4. ✅ Lisez le code source pour apprendre le pattern MVC
5. ✅ Améliorez l'interface ou ajoutez des fonctionnalités

---

## Support

Pour toute question ou problème :

1. Consultez le [README.md](README.md) principal
2. Consultez le fichier [CALCULS.md](CALCULS.md) pour les formules
3. Consultez les commentaires dans le code source
4. Ouvrez une issue sur [GitHub](https://github.com/Bendada-Mohamed/php_mvc_rappel/issues)

---

**Dernière mise à jour :** 16 novembre 2025
