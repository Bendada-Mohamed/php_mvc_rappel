<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  </head>
  <body class="container">
    <?php if(isset($_GET['success'])): ?>
      <div class="alert alert-success">
          Étudiant ajouté avec succès !
      </div>
    <?php endif; ?>

    <?php if(isset($error)): ?>
      <div class="alert alert-danger">
          <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>
    
    <!-- Formulaire de recherche des etudiants -->
    <form method="GET" action="index.php?action=RechercherEtudiant">

      <div class="mb-3">
        <button type="submit" class="btn btn-primary">
          Rechercher
        </button>
        <input class="form-control" type="text" placeholder="Rechercher (Nom, Prenom)..." name="Valeur" required>
      </div>

      <div class="mb-3 form-check">
        <label for="nom" class="form-check-label">
          Nom 
        </label>
        <input type="radio" name="filtre" value="Nom" id="Nom" class="form-check-input">
      </div>

      <div class="mb-3 form-check">
        <label for="prenom" class="form-check-label">
          Prenom 
        </label>
        <input type="radio" name="filtre" value="Prenom" id="Prenom" class="form-check-input">
      </div>

    </form>

    <!-- Formulaire d'ajout d'etudiants -->
    <form method="post" action="index.php?action=AjouterEtudiant">

      <div class="mb-3">
        <label for="Nom" class="form-label">
          Nom : 
        </label>
        <input class="form-control" type="text" name="Nom" placeholder="Ex. Alaoui" required>
      </div>

      <div class="mb-3">
        <label for="Prenom" class="form-label">
          Prenom :
        </label>
        <input class="form-control" type="text" name="Prenom" placeholder="Ex. Sara" required>
      </div>

      <button class="mb-3 btn btn-primary" type="submit">Enregistrer</button>

    </form>

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
              <button class="btn btn-primary" type="button">
                Modifier Étudiant
              </button>
              <button class="btn btn-danger" type="button">
                  Supprimer
              </button>
            </td>
          </tr>
        <?php endforeach;?>
      </tbody>
    </table>

  </body>
</html>