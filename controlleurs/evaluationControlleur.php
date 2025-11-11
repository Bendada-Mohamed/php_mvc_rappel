<?php
require_once "./models/evaluationModel.php";

class EvaluationControlleur{
  public static function lister(){
    $data = EvaluationModel::lister();
    include "./vues/Evaluations/index.php";
  }
}