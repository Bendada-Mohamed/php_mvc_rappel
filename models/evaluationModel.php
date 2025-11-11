<?php
require_once "./config/db.php";

class EvaluationModel{
  public static function lister(){
    $conn = Gestionscolarite::connect();
    $requete ="SELECT e.NEtudiant, m.CodeMat, ev.Date, CONCAT(e.NOM, ' ', e.Prenom) as NomComplet, m.LibelleMat, m.CoeffMat, ev.Note FROM etudiant e JOIN evaluer ev ON e.NEtudiant = ev.NEtudiant JOIN matiere m ON m.CodeMat = ev.CodeMat";
    try {
      $stmt = $conn->query($requete);
      return $stmt->fetchAll();
    } catch (PDOException $e) {
      echo "Erreur SQL : " . $e->getMessage();
      return;
    }
  }
  public static function modifier(){
    // code
  }
}