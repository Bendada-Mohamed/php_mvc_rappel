  document.querySelectorAll('.btn-modifier').forEach(button => {
    button.addEventListener('click', () => {
      const NEtudiant = button.dataset.netudiant;
      const CodeMat = button.dataset.codemat;
      const date = button.dataset.date;
      const nomComplet = button.dataset.nomcomplet;
      const matiere = button.dataset.matiere;
      const coeff = button.dataset.coeff;
      const note =  button.dataset.note;

      document.getElementById('modal-Date').value = date;
      document.getElementById('modal-Etudiant').value = nomComplet;
      document.getElementById('modal-Matiere').value = matiere;
      document.getElementById('modal-Coeff').value = coeff;
      document.getElementById('modal-Note').value = note;

      // Modifier l'action du formulaire dynamiquement
      document.getElementById('modifier-form').action = `index.php?action=ModifierEvaluation&NEtudiant=${NEtudiant}&CodeMat=${CodeMat}&date=${date}`;
    });
  });