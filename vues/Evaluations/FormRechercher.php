<!-- Formulaire de recherche des evaluation -->
    <form method="get" action="index.php">

      <!-- Ajout du input hidden !!! -->
      <input type="hidden" name="action" value="RechercherEtudiant">


      <input class="form-control" type="text" placeholder="Rechercher (Nom, Prenom)..." name="Valeur" required>

      <div class="mb-3 form-check">
        <input type="radio" name="filtre" value="Nom" id="Nom" class="form-check-input" required>
        <label for="Nom" class="form-check-label">Nom</label>
      </div>

      <div class="mb-3 form-check">
        <input type="radio" name="filtre" value="Prenom" id="Prenom" class="form-check-input" required>
        <label for="Prenom" class="form-check-label">Prenom</label>
      </div>

      <div class="mb-3">
        <button type="submit" class="btn btn-primary">Rechercher</button>
      </div>
    </form>
