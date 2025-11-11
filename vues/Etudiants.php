<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  </head>
  <header>
    <?= include "Header.html"?>
  </header>
  <body class="container">
    <!-- Message si succes est pleine -->
    <?php if(isset($_GET['success'])): ?>
      <div class="alert alert-success">
        Étudiant ajouté avec succès !
      </div>
    <?php endif; ?>

    <!-- Message si error est pleine  -->
    <?php if(isset($error)): ?>
      <div class="alert alert-danger">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>
    
    <!-- Formulaire de recherche des etudiants -->
    <form method="get" action="index.php">

      <!-- Ajout du input hidden pour corriger le bug -->
      <input type="hidden" name="action" value="RechercherEtudiant">


      <input class="form-control" type="text" placeholder="Rechercher (Nom, Prenom)..." name="Valeur" required>

      <div class="mb-3 form-check">
        <input type="radio" name="filtre" value="Nom" id="Nom" class="form-check-input" required>
        <label for="Nom" class="form-check-label">Nom</label>
      </div>

      <div class="mb-3 form-check">
        <input type="radio" name="filtre" value="Prenom" id="Prenom" class="form-check-input" required>
        <label for="Prenom" class="form-check-label">Prenom</label>
      </div>

      <div class="mb-3">
        <button type="submit" class="btn btn-primary">Rechercher</button>
      </div>
    </form>
    <button data-bs-toggle="modal" data-bs-target="#ajouter-modal" type="button" class="btn btn-secondary mb-3">Nouvel Etudiant</button>

    <!-- Formulaire inside modal d'ajout d'etudiants -->
    <div class="modal" tabindex="-1" id="ajouter-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post" action="index.php?action=AjouterEtudiant">

              <div class="mb-3">
                <label for="Nom" class="form-label">
                  Nom : 
                </label>
                <input class="form-control" type="text" name="Nom" placeholder="Ex. Alaoui" >
              </div>

              <div class="mb-3">
                <label for="Prenom" class="form-label">
                  Prenom :
                </label>
                <input class="form-control" type="text" name="Prenom" placeholder="Ex. Sara" >
              </div>

              <button class="mb-3 btn btn-primary" type="submit">Enregistrer</button>

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          </div>
        </div>
      </div>
    </div>
    

    <!-- Tableau d'affichage dynamique des etudiants  -->
    <table class="table table-primary table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nom</th>
          <th scope="col">Prenom</th>
          <th scope="col">Evaluations</th>
          <th scope="col">Moyenne</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach($data as $value): ?>
        <!-- Modification Modal -->
          <div class="modal fade" tabindex="-1" id="modifier-modal-<?= $value['NEtudiant'] ?>">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Modifier Etudiant #<?= htmlspecialchars($value['NEtudiant'])?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
              <form action="index.php?action=ModifierEtudiant&NEtudiant=<?= htmlspecialchars($value['NEtudiant'])?>" method="post">

                <div class="modal-body">
                 
                    <div class="mb-3">
                      <label for="Nom" class="form-label">Nom :</label>
                      <input type="text" name="Nom" class="form-control" value="<?= htmlspecialchars($value['Nom'])?>" required>
                    </div>
                    <div class="mb-3">
                      <label for="Prenom" class="form-label">Prenom :</label>
                      <input type="text" name="Prenom" class="form-control" value="<?= htmlspecialchars($value['Prenom'])?>" required>
                    </div>
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                  <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>

              </form>
              </div>
            </div>
          </div>
          <tr>
            <td><?= htmlspecialchars($value['NEtudiant']) ?></td>
            <td><?= htmlspecialchars($value['Nom']) ?></td>
            <td><?= htmlspecialchars($value['Prenom']) ?></td>
            <td><?= htmlspecialchars($value['NombreEvaluation']) ?></td>
            <td><?= number_format(($value['AditionProduit'] / $value['AditionCoef']), 2) ?></td>
            <td>
              <button class="btn btn-primary" type="button">
                Voir
              </button>
              <button data-bs-toggle="modal" data-bs-target="#modifier-modal-<?= $value['NEtudiant'] ?>"
 class="btn btn-primary" type="button">
              modifier
              </button>
              <button class="btn btn-danger" type="button">
                <a class="btn" href="index.php?action=SupprimerEtudiant&NEtudiant=<?=htmlspecialchars($value['NEtudiant'])?>">
                  Supprimer
                </a>
              </button>
            </td>
          </tr>
        <?php endforeach;?>
      </tbody>
    </table>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>