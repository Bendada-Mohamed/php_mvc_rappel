<form id="rechercher-form" method="get" action="index.php" class="row gx-3 gy-2 align-items-center">

  <div class="col-sm-3">
    <label for="Etudiant">Etudiant</label>
    <select class="form-select" name="Etudiant" id="Etudiant">
      <option value="" <?=empty($NEtudiant) ? "selected" : "" ?>>Tous...</option>
      <?php foreach($etudiants as $value): ?>
      <option value="<?=$value['NEtudiant']?>" <?=(isset($NEtudiant) && $NEtudiant == $value['NEtudiant']) ? "selected" : "" ?>>
        <?=$value['Nom'] . " " . $value['Prenom']?>
      </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="col-sm-3">
    <label for="Matiere">Matiere</label>
    <select class="form-select" name="Matiere" id="Matiere">
      <option value="" <?=empty($CodeMat) ? "selected" : "" ?>>Toutes...</option>
      <?php foreach($matieres as $value): ?>
      <option value="<?=$value['CodeMat']?>" <?=(isset($CodeMat) && $CodeMat == $value['CodeMat']) ? "selected" : "" ?>>
        <?=$value['LibelleMat']?>
      </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="col-sm-3">
    <label for="datedebut">Du</label>
    <input class="form-control" type="date" name="datedebut" id="datedebut" value="<?= $datedebut ?? '' ?>">
  </div>

  <div class="col-sm-3">
    <label for="datefin">Au</label>
    <input class="form-control" name="datefin" type="date" id="datefin" value="<?= $datefin ?? '' ?>">
  </div>

</form>
<script>
document.querySelectorAll('.form-select, input[type="date"]').forEach(el => {
  el.addEventListener('change', () => {
    const rechercherForm = document.getElementById('rechercher-form');

    // Ajout du champ "action"
    let inputAction = rechercherForm.querySelector('input[name="action"]');
    if (!inputAction) {
      inputAction = document.createElement('input');
      inputAction.type = 'hidden';
      inputAction.name = 'action';
      rechercherForm.appendChild(inputAction);
    }
    inputAction.value = 'RechercherEvaluation';

    // Soumission du formulaire
    rechercherForm.submit();
  });
});

</script>