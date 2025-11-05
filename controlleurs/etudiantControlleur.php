<?php
require "./models/etudiantModel.php";

class EtudiantControlleur{
  public static function lister($filtre, $valeur){
    $data = EtudiantModel::lister($filtre, $valeur);
    include "./vues/lister.php";
  }
}