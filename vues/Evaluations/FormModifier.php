<!-- Modal Modifier Evaluation -->
    <div class="modal fade" id="modifier-modal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modifier Evaluation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <form id="modifier-form" method="post" action="">
              <input type="hidden" name="NEtudiant" id="modal-NEtudiant">

              <div class="mb-3">
                <label for="modal-Date" class="form-label">Date :</label>
                <input type="text" class="form-control" id="modal-Date" name="Date" required>
              </div>

              <div class="mb-3">
                <label for="modal-Etudiant" class="form-label">Etudiant :</label>
                <input type="text" class="form-control" id="modal-Etudiant" name="Etudiant" required>
              </div>

              <div class="mb-3">
                <label for="modal-Matiere" class="form-label">Matiere :</label>
                <input type="text" class="form-control" id="modal-Matiere" name="Matiere" required>
              </div>
              
              <div class="mb-3">
                <label for="modal-Coeff" class="form-label">Coeff :</label>
                <input type="text" class="form-control" id="modal-Coeff" name="Coeff" required>
              </div>

              <div class="mb-3">
                <label for="modal-Note" class="form-label">Note/20 :</label>
                <input type="text" class="form-control" id="modal-Note" name="Note" required>
              </div>
              <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
          </div>
        </div>
      </div>
    </div>