<section id="subjects" class="">
      <div class="page-card mb-3">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mb-3">
          <div class="d-flex flex-column flex-md-row align-items-md-center gap-2 w-100">
              <div class="input-group search-input">
                <span class="input-group-text bg-white border-end-0">
                  <i class="bi bi-search"></i>
                </span>
                <form method="get" action="index.php">
                <input type="hidden" name="action" value="RechercherMatiere">
                <input type="text" class="form-control border-start-0" placeholder="Rechercher une matière..." name="libelle">
              </div>
              <button type="submit" class="btn btn-outline-secondary d-flex align-items-center gap-1">
                <i class="bi bi-funnel"></i>
                Filtres
              </button>
              </form>
          </div>
          <button class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>
            Nouvelle matière
          </button>
        </div>