<?php
require_once "./models/matiereModel.php";
class MatiereControlleur{
  public static function lister(){
    $action = $_GET['action'] ?? '';
    $pageCourante = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $recherche = trim($_GET['libelle'] ?? '');

    $parPage = 2;

    if($recherche !== ""){
      $totalElements = MatiereModel::calculertout($recherche);
      $totalPages = ceil($totalElements / $parPage);
      $pageCourante = max(1, min($totalPages, $pageCourante));
      $offset = ($pageCourante - 1) * $parPage;
      $data = MatiereModel::rechercher($recherche);
    }else{
      $totalElements = MatiereModel::calculertout();
      $totalPages = ceil($totalElements / $parPage);
      $pageCourante = max(1, min($totalPages, $pageCourante));
      $offset = ($pageCourante - 1) * $parPage;
      $data = MatiereModel::lister($offset, $parPage);
    }
    include "./vues/Matieres/index.php";
  }
  public static function modifier(){
    if($_SERVER["REQUEST_METHOD"] === "POST"){
      $codeMat = $_POST['codeMat'];
      $libelle = $_POST['libelle'];
      $coeff = $_POST['coeff'];

      $message = '';
      if($libelle == "" || $coeff == ""){
        $message = "les champs est vide !";
      }
      $data = MatiereModel::modifier($codeMat, $libelle, $coeff);
      self::lister();
    }
  }
  public static function Supprimer(){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $CodeMat = $_POST['CodeMat'];
      MatiereModel::Supprimer($CodeMat);
    }
    self::lister();
  }
  public static function Ajouter(){
    if($_SERVER['REQUEST_METHOD'] === "POST"){
      $libelle = trim($_POST['libelle']);
      $coeff = trim($_POST['coeff']);
      if($libelle === '' || $coeff === ''){
        $error = "libelle et coeff obligatoires.";
        $data = MatiereModel::Lister();
        include "./vues/Matieres/index.php";
        return;
      }
      MatiereModel::Ajouter($libelle, $coeff);
      header("Location: index.php?action=Matieres&success=1");
      exit;
    }
    self::Lister();
  }
}