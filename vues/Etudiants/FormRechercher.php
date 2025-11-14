<section id="students" class="">
  <div class="page-card mb-3">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mb-3">
      <div class="d-flex flex-column flex-md-row align-items-md-center gap-2 w-100">
        <form method="get" action="index.php">
          <!-- Ajout du input hidden !!! -->
          <input type="hidden" name="action" value="RechercherEtudiant">
          <div class="input-group search-input mb-2">
            <span class="input-group-text bg-white border-end-0">
              <i class="bi bi-search"></i>
            </span>
            <input name="recherche" type="text" class="form-control border-start-0" placeholder="Rechercher (Nom, Prénom)...">
            <button class="btn btn-outline-secondary d-flex align-items-center gap-1">
            <i class="bi bi-funnel"></i>
            Filtres
          </button>
          </div>
          </form>
      </div>
      <button data-bs-toggle="modal" data-bs-target="#ajouter-modal" class="btn btn-primary">
        <i class="bi bi-person-plus-fill me-1"></i>
        Nouvel étudiant
      </button>
    </div>
