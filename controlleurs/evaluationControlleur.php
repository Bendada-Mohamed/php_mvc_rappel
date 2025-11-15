<?php
require_once "./models/evaluationModel.php";

class EvaluationControlleur{
  public static function lister(){
    $action = $_GET['action'] ?? '';
    $parPage = 2;
    $totalElements = EtudiantModel::countAll();
    $totalPages = ceil($totalElements / $parPage);
    $pageCourante = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $pageCourante = max(1, min($totalPages, $pageCourante));
    $offset = ($pageCourante - 1) * $parPage;
    [$data, $etudiants, $matieres] = EvaluationModel::lister($offset, $parPage);
    include "./vues/Evaluations/index.php";
  }
  public static function modifier(){
    if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_GET['NEtudiant']) && isset($_GET['CodeMat']) && isset($_GET['date'])){
      $NEtudiant = $_GET['NEtudiant'];
      $CodeMat = $_GET['CodeMat'];
      $oldDate = $_GET['date'];
      $newDate = $_POST['Date'];
      $note = $_POST['Note'];
      if(EvaluationModel::modifier($oldDate, $newDate, $note, $NEtudiant, $CodeMat)){
        $message = "Evaluation modifier avec succes!";
      }else{
        $message = "Probleme lors de la modification!";
      };
    }
  }
  public static function supprimer(){
    if($_SERVER['REQUEST_METHOD'] === "POST"){
      $NEtudiant = $_POST['NEtudiant'];
      $CodeMat = $_POST['CodeMat'];
      $date = $_POST['Date'];
      if(EvaluationModel::supprimer($NEtudiant, $CodeMat, $date)){
        $message = "Evaluation supprimer avec succes!";
      }else {
        $message = "Probleme lors de la suprission!";
      }
    }
    self::lister();
  }
  public static function ajouter(){
    if($_SERVER["REQUEST_METHOD"] === "POST"){
      $NEtudiant = $_POST['NEtudiant'];
      $CodeMat = $_POST['CodeMat'];
      $Date = $_POST['Date'];
      $Note = $_POST['Note'];
      if(EvaluationModel::ajouter($NEtudiant, $CodeMat, $Date, $Note)){
        $message = "Evaluation ajoute avec succes";
      }else{
        $message = "Probleme lors de  l'ajout!";
      };
      self::lister();
    }
  }
public static function rechercher() {
  $action = $_GET['action'] ?? '';
  $NEtudiant = $_GET['Etudiant'] ?? null;
  $CodeMat = $_GET['Matiere'] ?? null;
  $datedebut = $_GET['datedebut'] ?? null;
  $datefin = $_GET['datefin'] ?? null;

  [$data, $etudiants, $matieres] = EvaluationModel::rechercher($NEtudiant, $CodeMat, $datedebut, $datefin);
  
  include "./vues/Evaluations/index.php";
}
}