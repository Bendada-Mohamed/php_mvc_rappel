<?php 
class Gestionscolarite{
  public static function connect(){
    try{
      $db = new PDO("mysql:host=localhost;dbname=gestionscolarite", "root", "");
      return $db;
    }catch(PDOException $e){
      die("Erreur de Connexion :" . $e->getMessage());
    }
  }
}