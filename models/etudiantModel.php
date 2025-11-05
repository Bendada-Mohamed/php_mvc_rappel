<?php
require "./config/db.php";
class EtudiantModel{
  public static function lister($filtre, $valeur){
    $conn = Gestionscolarite::connect();
    $stmt = $conn->prepare("SELECT * FROM etudiant WHERE $filtre=:valeur");
    $stmt->execute(["valeur" => $valeur]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }
  
}