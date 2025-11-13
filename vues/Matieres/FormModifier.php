<!-- Modal Modifier Matiere -->
    <div class="modal fade" id="modifier-modal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modifier Matiere</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <form id="modifier-form" method="post" action="">

              <div class="mb-3">
                <label for="modal-codeMat" class="form-label">Code :</label>
                <input type="text" class="form-control text-muted" id="modal-codeMat" name="codeMat" readOnly>
              </div>

              <div class="mb-3">
                <label for="modal-libelle" class="form-label">Libelle :</label>
                <input type="text" class="form-control" id="modal-libelle" name="libelle" required>
              </div>

              <div class="mb-3">
                <label for="modal-coeff" class="form-label">Coeff :</label>
                <input type="text" class="form-control" id="modal-coeff" name="coeff" required>
                <small id="coeffAide" class="form-text text-muted">CoeffMat > 0</small>
              </div>

              <div class="mb-3">
                <label for="modal-moyenne" class="form-label">Moyenne :</label>
                <input type="text" class="form-control text-muted" id="modal-moyenne" name="moyenne" readOnly>
              </div>




              <button type="submit" class="btn btn-primary">Enregistrer</button>

            </form>

          </div>
        </div>
      </div>
    </div>