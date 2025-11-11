  document.querySelectorAll('.btn-modifier').forEach(button => {
    button.addEventListener('click', () => {
      const id = button.dataset.id;
      const nom = button.dataset.nom;
      const prenom = button.dataset.prenom;

      document.getElementById('modal-NEtudiant').value = id;
      document.getElementById('modal-Nom').value = nom;
      document.getElementById('modal-Prenom').value = prenom;

      // Modifier l'action du formulaire dynamiquement
      document.getElementById('modifier-form').action = `index.php?action=ModifierEtudiant&NEtudiant=${id}`;
    });
  });