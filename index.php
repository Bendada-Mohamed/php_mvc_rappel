<?php
require "controlleurs/etudiantControlleur.php";

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

  default:
    echo "Action non trouvée.";
}
