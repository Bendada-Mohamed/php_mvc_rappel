<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title><?= $title ?? "Mon APPlication"?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body class="container">
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
          <a class="navbar-brand" href="index.php?action=tableauDeBord">Gestion Scolarite</a>
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=tableauDeBord">Tableau de bord</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=Etudiant">Etudiants</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=Matieres">Matieres</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=Evaluation">Evaluations</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    
    <div>

