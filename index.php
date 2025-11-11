<?php
require_once "controlleurs/etudiantControlleur.php";
require_once "controlleurs/evaluationControlleur.php";

$action = $_GET['action'] ?? "Etudiant";
switch($action){
  case 'Etudiant':
    EtudiantControlleur::lister();
    break;

  case 'AjouterEtudiant':
    EtudiantControlleur::Ajouter();
    break;

  case 'SupprimerEtudiant':
    EtudiantControlleur::Supprimer();
    break;

  case 'RechercherEtudiant':
    EtudiantControlleur::Rechercher();
    break;

  case 'ModifierEtudiant':
    EtudiantControlleur::Modifier();
    break;
  case 'Evaluation';
    EvaluationControlleur::lister();
    break;
  case 'ModifierEvaluation':
    EvaluationControlleur::modifier();
    break;
  default:
    echo "Action non trouvée.";
}
