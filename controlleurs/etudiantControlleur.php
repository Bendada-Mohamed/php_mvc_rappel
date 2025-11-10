<?php
require "./models/etudiantModel.php";

class EtudiantControlleur{
  public static function lister(){
    $data = EtudiantModel::lister();
    include "./vues/Etudiants.php";
  }

  public static function Ajouter(){
    if($_SERVER['REQUEST_METHOD'] === "POST"){
      $nom = trim($_POST['Nom']);
      $prenom = trim($_POST['Prenom']);
      if($nom === '' || $prenom === ''){
        $error = "Nom et prenom obligatoires.";
        $data = EtudiantModel::Lister();
        include "./vues/Etudiants.php";
        return;
      }
      EtudiantModel::Ajouter($nom, $prenom);
      header("Location: index.php?action=Etudiant&success=1");
      exit;
    }
    self::Lister();
  }

  public static function Supprimer(){
    if(isset($_GET['id'])){
      $id = $_GET['id'];
      EtudiantModel::Supprimer($id);
    }
    self::lister();
  }

  public static function Modifier(){
    if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_GET['id'])){
      $nom = trim($_POST['Nom']);
      $prenom = trim($_POST['Prenom']);
      $id = $_GET['id'];
      if($nom === '' || $prenom === ''){
        $error = "Nom et prenom obligatoires.";
      }else{
        EtudiantModel::Modifier($id,$nom, $prenom);
      }
    }
    self::lister();
  }

  public static function Rechercher(){
    $param = $_GET['filtre'] ?? '';
    $valeur = $_GET['Valeur'] ?? '';
    if($param !== '' && $valeur !== ''){
      $data = EtudiantModel::lister($param, $valeur);

    }else{
      $data = EtudiantModel::lister();
    }
    include "./vues/Etudiants.php";
  }
}