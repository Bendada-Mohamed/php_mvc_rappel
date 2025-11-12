<?php
require_once "./models/evaluationModel.php";

class EvaluationControlleur{
  public static function lister(){
    $data = EvaluationModel::lister();
    include "./vues/Evaluations/index.php";
  }
  public static function modifier(){
    if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_GET['NEtudiant']) && isset($_GET['CodeMat']) && isset($_GET['date'])){
      $NEtudiant = $_GET['NEtudiant'];
      $CodeMat = $_GET['CodeMat'];
      $oldDate = $_GET['date'];
      $newDate = $_POST['Date'];
      $note = $_POST['Note'];
      EvaluationModel::modifier($oldDate, $newDate, $note, $NEtudiant, $CodeMat);
      self::lister();
    }
  }
}