  document.querySelectorAll('.btn-modifier').forEach(button => {
    button.addEventListener('click', () => {
      const codemat = button.dataset.codemat;
      const libelle = button.dataset.libelle;
      const coeff = button.dataset.coeff;
      const moyenne = button.dataset.moyenne;

      document.getElementById('modal-codeMat').value = codemat;
      document.getElementById('modal-libelle').value = libelle;
      document.getElementById('modal-coeff').value = coeff;
      document.getElementById('modal-moyenne').value = moyenne;

      // Modifier l'action du formulaire dynamiquement
      document.getElementById('modifier-form').action = `index.php?action=ModifierMatiere`;
    });
  });