<!-- Ajouter Modal -->
<div class="modal" tabindex="-1" id="ajouter-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajouter une Nouvelle Evaluation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="index.php?action=AjouterEvaluation">

          <div class="mb-3">
            <label for="NEtudiant" class="form-label">
              Etudiant : 
            </label>
            <select class="form-select" name="NEtudiant" id="NEtudiant">
              <option value="" selected>
                Choisir...
              </option>
              <?php foreach($etudiants as $value): ?>
              <option value="<?=$value['NEtudiant']?>">
                <?=$value['Nom'] . " " . $value['Prenom']?>
              </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="CodeMat" class="form-label">
              Matiere :
            </label>
            <select class="form-select" name="CodeMat" id="CodeMat">
              <option value="" selected>
                Choisir...
              </option>
              <?php foreach($matieres as $value): ?>
              <option value="<?=$value['CodeMat']?>">
                <?=$value['LibelleMat']?>
              </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="Date" class="form-label">
              Date :
            </label>
            <input class="form-control" type="date" name="Date" value=<?php echo date('Y-m-d') ?>>
          </div>
          <div class="mb-3">
            <label for="Note" class="form-label">
              Note :
            </label>
            <input class="form-control" type="text" name="Note" placeholder="Ex. 14.50" >
            <small id="noteAide" class="form-text text-muted">Valeur entre 0 et 20</small>
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