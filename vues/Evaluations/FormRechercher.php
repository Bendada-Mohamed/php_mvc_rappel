<section id="evaluations" class="">
      <form id="rechercher-form" method="get" action="index.php" class="row gx-3 gy-2 align-items-center">
        <div class="page-card mb-3">
          <!-- Filters row -->
          <div class="row g-3 mb-3 align-items-end">
            <div class="col-md-3">
              <label class="form-label small">Étudiant</label>
              <select class="form-select" name="Etudiant" id="Etudiant">
                <option value="" <?=empty($NEtudiant) ? "selected" : "" ?>>Tous...</option>
                <?php foreach($etudiants as $value): ?>
                <option value="<?=$value['NEtudiant']?>" <?=(isset($NEtudiant) && $NEtudiant == $value['NEtudiant']) ? "selected" : "" ?>>
                  <?=$value['Nom'] . " " . $value['Prenom']?>
                </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label small">Matière</label>
              <select class="form-select" name="Matiere" id="Matiere">
                    <option value="" <?=empty($CodeMat) ? "selected" : "" ?>>Toutes...</option>
                    <?php foreach($matieres as $value): ?>
                    <option value="<?=$value['CodeMat']?>" <?=(isset($CodeMat) && $CodeMat == $value['CodeMat']) ? "selected" : "" ?>>
                      <?=$value['LibelleMat']?>
                    </option>
                    <?php endforeach; ?>
                  </select>
            </div>
            <div class="col-md-2">
              <label class="form-label small">Du</label>
              <input class="form-control" type="date" name="datedebut" id="datedebut" value="<?= $datedebut ?? '' ?>">
            </div>
            <div class="col-md-2">
              <label class="form-label small">Au</label>
              <input class="form-control" name="datefin" type="date" id="datefin" value="<?= $datefin ?? '' ?>">
            </div>
      </form>
            <div class="col-md-2 d-grid">
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajouter-modal" type="button">
                <i class="bi bi-plus-circle me-1"></i> Nouvelle évaluation
              </button>
            </div>
          </div>
<script>
const rechercherForm = document.getElementById('rechercher-form');

if (rechercherForm) {
  // On sélectionne seulement les select et input[type=date] à l'intérieur du formulaire rechercherForm
  rechercherForm.querySelectorAll('.form-select, input[type="date"]').forEach(el => {
    el.addEventListener('change', () => {
      let inputAction = rechercherForm.querySelector('input[name="action"]');
      if (!inputAction) {
        inputAction = document.createElement('input');
        inputAction.type = 'hidden';
        inputAction.name = 'action';
        rechercherForm.appendChild(inputAction);
      }
      inputAction.value = 'RechercherEvaluation';
      rechercherForm.submit();
    });
  });
}
</script>