<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>

  <header>
    <?= include "Header.php"?>
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

      <!-- Ajout du input hidden !!! -->
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
            <h5 class="modal-title">Ajouter un nouvel étudiant</h5>
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
              <button class="btn btn-primary btn-modifier" data-bs-toggle="modal" data-bs-target="#modifier-modal" data-id="<?= htmlspecialchars($value['NEtudiant']) ?>"data-nom="<?= htmlspecialchars($value['Nom']) ?>"data-prenom="<?= htmlspecialchars($value['Prenom']) ?>">
               Modifier
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
    <!-- Modal Modifier Étudiant -->
    <div class="modal fade" id="modifier-modal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modifier Étudiant</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <form id="modifier-form" method="post" action="">
              <input type="hidden" name="NEtudiant" id="modal-NEtudiant">
              <div class="mb-3">
                <label for="modal-Nom" class="form-label">Nom :</label>
                <input type="text" class="form-control" id="modal-Nom" name="Nom" required>
              </div>
              <div class="mb-3">
                <label for="modal-Prenom" class="form-label">Prenom :</label>
                <input type="text" class="form-control" id="modal-Prenom" name="Prenom" required>
              </div>
              <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document.querySelectorAll('.btn-modifier').forEach(button => {
        button.addEventListener('click', () => {
          const id = button.dataset.id;
          const nom = button.dataset.nom;
          const prenom = button.dataset.prenom;

          document.getElementById('modal-NEtudiant').value = id;
          document.getElementById('modal-Nom').value = nom;
          document.getElementById('modal-Prenom').value = prenom;

          // Modifier l'action du formulaire dynamiquement
          document.getElementById('modifier-form').action = `index.php?action=ModifierEtudiant&NEtudiant=${id}`;
        });
      });
    </script>

  </body>
</html>