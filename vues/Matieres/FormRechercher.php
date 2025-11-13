<!-- Formulaire de recherche des matiere -->
    <form method="get" action="index.php">

      <!-- Ajout du input hidden !!! -->
      <input type="hidden" name="action" value="RechercherMatiere">

      <input class="form-control mb-3" type="text" placeholder="Rechercher une Matiere..." name="libelle" required>

      <div class="mb-3">
        <button type="submit" class="btn btn-primary">Rechercher</button>
      </div>
    </form>
