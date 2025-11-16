<?php
require_once "./models/etudiantModel.php";

class EtudiantControlleur{
  public static function lister(){
    $action = $_GET['action'] ?? '';
    $recherche = trim($_GET['recherche'] ?? "");
    $pageCourante = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    $parPage = 2;
   
    if($recherche !== ''){
      $totalElements = EtudiantModel::countAll($recherche);
      $totalPages = ceil($totalElements / $parPage);
      $pageCourante = max(1, min($totalPages, $pageCourante));
      $offset = ($pageCourante - 1) * $parPage;
      $data = EtudiantModel::lister($recherche, $offset, $parPage);
    }else{
      $totalElements = EtudiantModel::countAll();
      $totalPages = ceil($totalElements / $parPage);
      $pageCourante = max(1, min($totalPages, $pageCourante));
      $offset = ($pageCourante - 1) * $parPage;
      $data = EtudiantModel::lister($recherche = '', $offset, $parPage);
    }
    include "./vues/Etudiants/index.php";
  }
  public static function Ajouter(){
    if($_SERVER['REQUEST_METHOD'] === "POST"){
      $nom = trim($_POST['Nom']);
      $prenom = trim($_POST['Prenom']);
      if($nom === '' || $prenom === ''){
        $error = "Nom et prenom obligatoires.";
        $data = EtudiantModel::Lister();
        include "./vues/Etudiants/index.php";
        return;
      }
      EtudiantModel::Ajouter($nom, $prenom);
      header("Location: index.php?action=Etudiant&success=1");
      exit;
    }
    self::Lister();
  }

  public static function Supprimer(){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $NEtudiant = $_POST['NEtudiant'];
      EtudiantModel::Supprimer($NEtudiant);
    }
    self::lister();
  }

  public static function Modifier(){
    if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_GET['NEtudiant'])){
      $nom = trim($_POST['Nom']);
      $prenom = trim($_POST['Prenom']);
      $NEtudiant = $_GET['NEtudiant'];
      if($nom === '' || $prenom === ''){
        $error = "Nom et prenom obligatoires.";
        include "./vues/Etudiants/index.php";
        return;
      }
      EtudiantModel::Modifier($NEtudiant,$nom, $prenom);
      header("Location: index.php?action=Etudiant&success=1");
      exit;
    }
    self::lister();
  }


}