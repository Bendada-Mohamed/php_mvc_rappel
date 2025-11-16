<?php
require_once "./config/db.php";
class MatiereModel{
  public static function lister($offset=0, $limit = 10){
    $conn = Gestionscolarite::connect();
    try{
      $stmt = $conn->prepare(
        "SELECT m.CodeMat, 
          m.LibelleMat, 
          m.CoeffMat,
          SUM(ev.Note) / COUNT(ev.Note) AS 'Moyenne'
        FROM evaluer ev
        JOIN matiere m 
        ON ev.CodeMat = m.CodeMat 
        GROUP BY ev.CodeMat
        LIMIT :offset, :limit");
      $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
      $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetchAll();
    }catch(PDOException $e){
      echo "Erreur SQL : " . $e->getMessage();
      return [];
    }
  }
  public static function rechercher($libelle){
    $conn = Gestionscolarite::connect();
    try{
      $stmt = $conn->prepare(
        "SELECT m.CodeMat, 
          m.LibelleMat, 
          m.CoeffMat, 
          SUM(ev.Note) / COUNT(ev.CodeMat) AS 'Moyenne'
        FROM matiere m
        JOIN evaluer ev 
        ON ev.CodeMat = m.CodeMat 
        WHERE m.LibelleMat like :LibelleMat
        GROUP BY ev.CodeMat");
      $stmt->execute([":LibelleMat" => "%$libelle%"]);
      return $stmt->fetchAll();
    }catch(PDOException $e){
      echo "Erreur SQL : " . $e->getMessage();
    }
  }
  public static function calculertout($param=""){
    $conn = Gestionscolarite::connect();
    $requete = "SELECT count(DISTINCT ev.CodeMat) FROM evaluer ev";
    if($param !== ""){
      $requete .= " JOIN matiere m ON m.CodeMat = ev.CodeMat WHERE LibelleMat = :r";
      try {
        $stmt = $conn->prepare($requete);
        $stmt->execute([':r' => $param]);
        return $stmt->fetchColumn();
      } catch (PDOException $e) {
          echo "Erreur SQL : " . $e->getMessage();
          return 0;
      }
    }
    return $conn->query($requete)->fetchColumn();
  } 

  public static function modifier($codeMat, $libelle, $coeff){
    $conn = Gestionscolarite::connect();
    try {
      $stmt = $conn->prepare("UPDATE matiere SET LibelleMat=:LibelleMat, CoeffMat=:CoeffMat WHERE CodeMat=:CodeMat");
      $stmt->execute([
        ":LibelleMat" => $libelle, 
        ":CoeffMat" => $coeff, 
        ":CodeMat" => $codeMat]);
      return $stmt->fetchAll();
    } catch (PDOException $e) {
      echo "ERREUR SQL : " . $e->getMessage();
    }
  }

  public static function Supprimer($codeMat){
    $conn = Gestionscolarite::connect();
    try{
      $conn->beginTransaction();

      $stmt1 = $conn->prepare("DELETE FROM evaluer WHERE CodeMat = :codeMat");
      $stmt1->execute([':codeMat' => $codeMat]);

      $stmt2 = $conn->prepare("DELETE FROM matiere WHERE CodeMat = :codeMat");
      $result = $stmt2->execute([':codeMat' => $codeMat]);
      
      $conn->commit();
      return true;
    }catch(PDOException $e){
      echo "Erreur lors de la suppression : " . $e->getMessage();
      return false;
    }
  }

  public static function Ajouter($libelle, $coeff){
    $conn = Gestionscolarite::connect();
    try{
      $requete = "INSERT INTO matiere (LibelleMat, CoeffMat) VALUES (:libelle, :coeff)";
      $stmt = $conn->prepare($requete);
      $stmt->bindParam(':libelle', $libelle);
      $stmt->bindParam(':coeff', $coeff);
      return $stmt->execute();
    }catch(PDOException $e){
      echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
      return false;
    }
  }

}