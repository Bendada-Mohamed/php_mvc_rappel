<?php
require_once "./config/db.php";

class EvaluationModel{
  public static function lister(){
    $conn = Gestionscolarite::connect();
    $requete ="SELECT e.NEtudiant, m.CodeMat, ev.Date, CONCAT(e.NOM, ' ', e.Prenom) as NomComplet, m.LibelleMat, m.CoeffMat, ev.Note FROM etudiant e JOIN evaluer ev ON e.NEtudiant = ev.NEtudiant JOIN matiere m ON m.CodeMat = ev.CodeMat";

    try {
      $stmt = $conn->query($requete);
      $stmt1 = $conn->query("SELECT * FROM etudiant");
      $stmt2 = $conn->query("SELECT * FROM matiere");
      return [$stmt->fetchAll(), $stmt1->fetchAll(), $stmt2->fetchAll()];
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
      ]);

    }catch(PDOException $e){
      echo "SQL ERROR : " . $e->getMessage();
      return false;
    }
  }
  public static function supprimer($NEtudiant, $CodeMat, $date){
    $conn = Gestionscolarite::connect();
    $requete = "DELETE FROM evaluer WHERE NEtudiant=:NEtudiant AND CodeMat=:CodeMat AND Date=:date";
    try {
      $stmt = $conn->prepare($requete);
      return $stmt->execute([
        ":NEtudiant" => $NEtudiant,
        ":CodeMat" => $CodeMat,
        ":date" => $date
      ]);
    } catch (PDOException $e) {
      echo "SQL ERROR : " . $e->getMessage();
      return false;
    }
  }
  public static function ajouter($NEtudiant, $CodeMat, $Date, $Note){
    $conn = Gestionscolarite::connect();
    $requete = "INSERT INTO evaluer VALUES (:NEtudiant , :CodeMat, :Date, :Note)";
    try{
      $stmt = $conn->prepare($requete);
      return $stmt->execute([
        ":NEtudiant" => $NEtudiant,
        ":CodeMat" => $CodeMat,
        ":Date" => $Date,
        ":Note" => $Note
      ]);
    }catch(PDOException $e){
      echo "SQL ERROR : " . $e->getMessage();
      return false;
    }
  }
  public static function rechercher($NEtudiant, $CodeMat, $datedebut, $datefin){
    $conn = Gestionscolarite::connect();
    $requete = 
    "SELECT e.NEtudiant, m.CodeMat, ev.Date, CONCAT(e.NOM, ' ', e.Prenom) as NomComplet, 
      m.LibelleMat, 
      m.CoeffMat, 
      ev.Note 
    FROM etudiant e 
    JOIN evaluer ev 
    ON e.NEtudiant = ev.NEtudiant 
    JOIN matiere m 
    ON m.CodeMat = ev.CodeMat
    WHERE 1=1";

    $params = [];

    if (!empty($NEtudiant)) {
      $requete .= " AND e.NEtudiant = :NEtudiant";
      $params[':NEtudiant'] = $NEtudiant;
    }
    if(!empty($CodeMat)){
      $requete .= " AND m.CodeMat = :CodeMat";
      $params[':CodeMat'] = $CodeMat;
    }
    if(!empty($datedebut) && !empty($datefin)){
      $requete .= " AND ev.Date BETWEEN :datedebut AND :datefin";
      $params[':datedebut'] = $datedebut;
      $params[':datefin'] = $datefin;
    }elseif(!empty($datedebut)){
      $requete .= " AND ev.Date >= :datedebut";
      $params[':datedebut'] = $datedebut;
    }elseif(!empty($datefin)){
      $requete .= " AND ev.Date <= :datefin";
      $params[':datefin'] = $datefin;
    }
    try{
      $stmt = $conn->prepare($requete);
      $stmt->execute($params);
      return [$stmt->fetchAll(), $conn->query("SELECT * FROM etudiant")->fetchAll(), $conn->query("SELECT * FROM matiere")->fetchAll()];
    }catch(PDOException $e){
      echo "SQL ERROR : " . $e->getMessage();
      return false;
    }
  }
}