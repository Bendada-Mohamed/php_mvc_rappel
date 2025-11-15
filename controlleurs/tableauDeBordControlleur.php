<?php
require_once "./models/TableauDeBordModel.php";

class TableauDeBordControlleur{
  public static function index(){
    $action = $_GET['action'] ?? '';
    [$nbrEtu, $nbrMat, $nbrEva, $topEtu, $topMat] = TableauDeBordModel::index();
    include "./vues/TableauDeBord/index.php";
  } 
}