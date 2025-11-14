<!-- Ajouter Modal -->
<div class="modal" tabindex="-1" id="ajouter-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajouter un nouvel étudiant</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="index.php?action=AjouterEtudiant" class="d-flex">

          <div class="mb-3">
            <label for="Nom" class="form-label">
              Nom : 
            </label>
            <input class="form-control" type="text" name="Nom" placeholder="Ex. Alaoui" >
          </div>

          <div class="mb-3">
            <label for="Prenom" class="form-label">
              Prenom :
            </label>
            <input class="form-control" type="text" name="Prenom" placeholder="Ex. Sara" >
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