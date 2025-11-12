<!-- Tableau d'affichage dynamique des evaluations  -->
<table class="table table-primary table-striped">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Etudiant</th>
      <th scope="col">Matiere</th>
      <th scope="col">Coeff</th>
      <th scope="col">Note/20</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($data as $value): ?>
      <tr>
        <td><?= htmlspecialchars($value['Date']) ?></td>
        <td><?= htmlspecialchars($value['NomComplet']) ?></td>
        <td><?= htmlspecialchars($value['LibelleMat']) ?></td>
        <td><?= htmlspecialchars($value['CoeffMat']) ?></td>
        <td><?= htmlspecialchars($value['Note']) ?></td>
        <td>
          <button 
          class="btn btn-primary btn-modifier" 
          data-bs-toggle="modal" 
          data-bs-target="#modifier-modal" 
          data-netudiant="<?=htmlspecialchars($value['NEtudiant'])?>"
          data-codemat="<?=htmlspecialchars($value['CodeMat'])?>"
          data-date="<?= htmlspecialchars($value['Date']) ?>"
          data-nomcomplet="<?= htmlspecialchars($value['NomComplet']) ?>"
          data-matiere="<?= htmlspecialchars($value['LibelleMat']) ?>" 
          data-coeff="<?= htmlspecialchars($value['CoeffMat']) ?>" 
          data-note="<?= htmlspecialchars($value['Note']) ?>">
            Modifier
          </button>
          <form 
            method="post" 
            action="index.php?action=SupprimerEvaluation" 
            style="display:inline;">
            <input type="hidden" name="NEtudiant" value="<?= $value['NEtudiant'] ?>">
            <input type="hidden" name="CodeMat" value="<?= $value['CodeMat'] ?>">
            <input type="hidden" name="Date" value="<?= $value['Date'] ?>">
            <button 
              type="submit" 
              class="btn btn-danger" 
              onclick="return confirm('Voulez-vous vraiment supprimer cet étudiant ?')">
              Supprimer
            </button>
          </form>
        </td>
      </tr>
    <?php endforeach;?>
  </tbody>
</table>
<?php 
echo "<pre>";
print_r($data);
echo "</pre>";
?>