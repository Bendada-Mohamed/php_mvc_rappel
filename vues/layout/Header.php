<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title><?= $title ?? "Mon Application"?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="././assets/CSS/styles.css">
  </head>
  <body>
    <header class="topbar">
      <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid px-4">
          <a class="navbar-brand " href="index.php?action=tableauDeBord" data-section="dashboard">
            <span class="topbar-icon">
              <i class="bi bi-mortarboard-fill"></i>
            </span>
            Gestion Scolarité
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-3">
              <li class="nav-item">
                <a class="nav-link <?= ($action == 'tableauDeBord') ? 'active' : '' ?>" href="index.php?action=tableauDeBord" data-section="dashboard">
                  <i class="bi bi-grid-1x2-fill me-1"></i> Tableau de bord
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= ($action == 'Etudiant' || $action == 'AjouterEtudiant' || $action == 'SupprimerEtudiant' || $action == 'RechercherEtudiant' || $action == 'ModifierEtudiant') ? 'active' : '' ?>" href="index.php?action=Etudiant" data-section="students">
                  <i class="bi bi-people-fill me-1"></i> Étudiants
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= ($action == 'Matieres' || $action == 'RechercherMatiere' || $action == 'ModifierMatiere' || $action == 'SupprimerMatiere' || $action == 'AjouterMatiere') ? 'active' : '' ?>" href="index.php?action=Matieres" data-section="subjects">
                  <i class="bi bi-journal-bookmark-fill me-1"></i> Matières
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= ($action == 'Evaluation' || $action == 'ModifierEvaluation' || $action == 'SupprimerEvaluation' || $action == 'AjouterEvaluation' || $action == 'RechercherEvaluation' ) ? 'active' : '' ?>" href="index.php?action=Evaluation" data-section="evaluations">
                  <i class="bi bi-clipboard2-check-fill me-1"></i> Évaluations
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
  </body>
