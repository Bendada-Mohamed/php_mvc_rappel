<?php
require_once "controlleurs/etudiantControlleur.php";
require_once "controlleurs/evaluationControlleur.php";
require_once "controlleurs/MatiereControlleur.php";
require_once "controlleurs/TableauDeBordControlleur.php";

$action = $_GET['action'] ?? "";
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
  case 'SupprimerEvaluation':
    EvaluationControlleur::supprimer();
    break;
  case 'AjouterEvaluation':
    EvaluationControlleur::ajouter();
    break;
  case 'RechercherEvaluation':
    EvaluationControlleur::rechercher();
    break;
  case 'Matieres':
    MatiereControlleur::lister();
    break;
  case 'RechercherMatiere':
    MatiereControlleur::rechercher();
    break;
  case 'ModifierMatiere':
    MatiereControlleur::modifier();
    break;
  case 'SupprimerMatiere':
    MatiereControlleur::supprimer();
    break;
  case 'AjouterMatiere':
    MatiereControlleur::ajouter();
    break;
  default:
    TableauDeBordControlleur::index();
    break;
}
