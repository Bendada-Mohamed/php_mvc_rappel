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
    if(isset($_GET['NEtudiant'])){
      $NEtudiant = $_GET['NEtudiant'];
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
        include "./vues/Etudiants.php";
        return;
      }
      EtudiantModel::Modifier($NEtudiant,$nom, $prenom);
      header("Location: index.php?action=Etudiant&success=1");
      exit;
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