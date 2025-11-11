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