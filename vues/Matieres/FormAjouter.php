<!-- Ajouter Modal -->

<div class="modal" tabindex="-1" id="ajouter-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajouter une nouvelle matiere</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="index.php?action=AjouterMatiere">

          <div class="mb-3">
            <label for="libelle" class="form-label">
              Libelle : 
            </label>
            <input class="form-control" type="text" name="libelle" placeholder="Ex. PHP" >
          </div>

          <div class="mb-3">
            <label for="coeff" class="form-label">
              Coeff :
            </label>
            <input class="form-control" type="text" name="coeff" placeholder="Ex. 5" >
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