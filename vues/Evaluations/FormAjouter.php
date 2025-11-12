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
              Numero Etudiant : 
            </label>
            <input class="form-control" type="text" name="NEtudiant" placeholder="Ex. 1" >
          </div>
          <div class="mb-3">
            <label for="CodeMat" class="form-label">
              Code Matiere :
            </label>
            <input class="form-control" type="text" name="CodeMat" placeholder="Ex. 2" >
          </div>
          <div class="mb-3">
            <label for="Date" class="form-label">
              Date :
            </label>
            <input class="form-control" type="text" name="Date" placeholder="Ex. 2025-11-12" >
          </div>
          <div class="mb-3">
            <label for="Note" class="form-label">
              Note :
            </label>
            <input class="form-control" type="text" name="Note" placeholder="Ex. 14.50" >
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