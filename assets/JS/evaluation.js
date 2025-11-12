  document.querySelectorAll('.btn-modifier').forEach(button => {
    button.addEventListener('click', () => {

      
      const date = button.dataset.date;
      const note =  button.dataset.note;

      
      const nomComplet = button.dataset.nomcomplet;
      const matiere = button.dataset.matiere;
      const coeff = button.dataset.coeff;


      const NEtudiant = button.dataset.netudiant;
      const CodeMat = button.dataset.codemat;
      

      // user can modify
      document.getElementById('modal-Date').value = date;
      document.getElementById('modal-Note').value = note;

      // user can not modify
      document.getElementById('modal-Etudiant').value = nomComplet;
      document.getElementById('modal-Matiere').value = matiere;
      document.getElementById('modal-Coeff').value = coeff;
      

      // Modifier l'action du formulaire dynamiquement
      document.getElementById('modifier-form').action = `index.php?action=ModifierEvaluation&NEtudiant=${NEtudiant}&CodeMat=${CodeMat}&date=${date}`;
    });
  });