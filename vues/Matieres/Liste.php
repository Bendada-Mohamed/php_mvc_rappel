<!-- Tableau d'affichage dynamique des matieres  -->
<table class="table table-primary table-striped">
  <thead>
    <tr>
      <th scope="col">Code</th>
      <th scope="col">Libelle</th>
      <th scope="col">Coeff</th>
      <th scope="col">Moyenne</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach($data as $value): ?>
      <tr>
        <td><?= htmlspecialchars($value['CodeMat']) ?></td>
        <td><?= htmlspecialchars($value['LibelleMat']) ?></td>
        <td><?= htmlspecialchars($value['CoeffMat']) ?></td>
        <td><?= number_format(htmlspecialchars($value['Moyenne']), 2) ?></td>
        <td>
          <button class="btn btn-primary" type="button">
            Voir
          </button>

          <button 
          class="btn btn-primary btn-modifier" 
          data-bs-toggle="modal" 
          data-bs-target="#modifier-modal" 
          data-codemat="<?= htmlspecialchars($value['CodeMat']) ?>"
          data-libelle="<?= htmlspecialchars($value['LibelleMat']) ?>"
          data-coeff="<?= htmlspecialchars($value['CoeffMat']) ?>"
          data-moyenne="<?= number_format(htmlspecialchars($value['Moyenne']), 2) ?>">
            Modifier
          </button>

          <form method="post" 
          action="index.php?action=SupprimerMatiere" style="display:inline;">
            <input 
            type="hidden" 
            name="CodeMat" 
            value="<?= $value['CodeMat'] ?>">
            <button 
            type="submit" 
            class="btn btn-danger" 
            onclick="return confirm('Toute les enregistrement d\'evaluer qui contient <?php echo htmlspecialchars($value['LibelleMat']) ?> vont etre supprimer aussi !! Voulez-vous vraiment supprimer cette Matiere ?')">
              Supprimer
            </button>
          </form>

        </td>
      </tr>
    <?php endforeach;?>
  </tbody>
</table>