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
          <form method="post" action="index.php?action=SupprimerEtudiant" style="display:inline;">
            <input type="hidden" name="NEtudiant" value="<?= $value['NEtudiant'] ?>">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cet étudiant ?')">
              Supprimer
            </button>
          </form>
        </td>
      </tr>
    <?php endforeach;?>
  </tbody>
</table>