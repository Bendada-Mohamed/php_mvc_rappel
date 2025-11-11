<?php include __DIR__  . "/../layout/Header.php" ?>

<!-- Message si succes est pleine -->
<?php if(isset($_GET['success'])): ?>
  <div class="alert alert-success">
    Étudiant ajouté avec succès !
  </div>
<?php endif; ?>

<!-- Message si error est pleine  -->
<?php if(isset($error)): ?>
  <div class="alert alert-danger">
    <?= htmlspecialchars($error) ?>
  </div>
<?php endif; ?>

<?php include __DIR__  . "/FormAjouter.php" ?>

<?php include __DIR__  . "/FormRechercher.php" ?>

<!-- button Nouvel Etudiant -->
<button data-bs-toggle="modal" data-bs-target="#ajouter-modal" type="button" class="btn btn-secondary mb-3">Nouvel Etudiant</button>

<?php include __DIR__  . "/Liste.php" ?>

<?php include __DIR__  . "/FormModifier.php" ?>

<?php include __DIR__  . "/../layout/Footer.php" ?>