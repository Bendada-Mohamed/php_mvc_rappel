<?php 
class Gestionscolarite{
  public static function connect(){
    try{
      $db = new PDO("mysql:host=localhost;dbname=gestionscolarite", "root", "");
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      return $db;
    }catch(PDOException $e){
      die("Erreur de Connexion :" . $e->getMessage());
    }
  }
}