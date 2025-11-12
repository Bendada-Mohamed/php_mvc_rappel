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
  public static function modifier($oldDate, $newDate, $note, $NEtudiant, $CodeMat){
    $conn = Gestionscolarite::connect();
    $requete = "UPDATE evaluer SET Date=:newDate, Note=:note WHERE NEtudiant=:NEtudiant AND CodeMat=:CodeMat AND Date=:oldDate";

    try{
      $stmt = $conn->prepare($requete);

      return $stmt->execute([
        ":newDate" => $newDate, 
        ":note" => $note, 
        ":NEtudiant" => $NEtudiant,
        ":CodeMat" => $CodeMat,
        ":oldDate" => $oldDate
    ] );

    }catch(PDOException $e){
      echo "SQL ERROR : " . $e->getMessage();
      return false;
    }
  }
}