<?php
require_once "./config/db.php";
class EtudiantModel{
  public static function lister($recherche = '', $offset = 0, $limit = 10) {
    $conn = Gestionscolarite::connect();
    $requete =
    "SELECT et.NEtudiant, et.Nom, et.Prenom, 
      COUNT(m.CodeMat) AS NombreEvaluation,
      SUM(ev.Note * m.CoeffMat) AS AditionProduit,
      SUM(m.CoeffMat) AS AditionCoef
    FROM etudiant et
    JOIN evaluer ev 
      ON et.NEtudiant = ev.NEtudiant
    JOIN matiere m 
      ON m.CodeMat = ev.CodeMat";

    if ($recherche !== '') {
      $requete .= " 
        WHERE (et.Nom LIKE :r) 
        OR (et.Prenom LIKE :r) 
        OR (CONCAT(et.Nom, ' ', et.Prenom) LIKE :r) 
        OR (CONCAT(et.Prenom, ' ', et.Nom) LIKE :r)
      ";}

    $requete .= " GROUP BY et.NEtudiant LIMIT :offset, :limit";

    try {
      $stmt = $conn->prepare($requete);

      if ($recherche !== '') {
        $stmt->bindValue(':r', "%$recherche%", PDO::PARAM_STR);
      }

      $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
      $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);

      $stmt->execute();
      return $stmt->fetchAll();

    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
        return [];
    }
  }

  public static function Ajouter($nom, $prenom){
    $conn = Gestionscolarite::connect();
    try{
      $requete = "INSERT INTO etudiant (Nom, Prenom) VALUES (:Nom, :Prenom)";
      $stmt = $conn->prepare($requete);
      $stmt->bindParam(':Nom', $nom);
      $stmt->bindParam(':Prenom', $prenom);
      return $stmt->execute();
    }catch(PDOException $e){
      echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
      return false;
    }
  }

  public static function Supprimer($NEtudiant){
    $conn = Gestionscolarite::connect();
    try{
      $conn->beginTransaction();

      $stmt1 = $conn->prepare("DELETE FROM evaluer WHERE NEtudiant = :NEtudiant");
      $stmt1->execute([':NEtudiant' => $NEtudiant]);

      $stmt2 = $conn->prepare("DELETE FROM etudiant WHERE NEtudiant = :NEtudiant");
      $result = $stmt2->execute([':NEtudiant' => $NEtudiant]);
      
      $conn->commit();
      return true;
    }catch(PDOException $e){
      echo "Erreur lors de la suppression : " . $e->getMessage();
      return false;
    }
  }

  public static function Modifier($NEtudiant, $nom, $prenom){
    $conn = Gestionscolarite::connect();
    try{
      $request = "UPDATE etudiant SET Nom=:nom, Prenom=:prenom WHERE NEtudiant= :NEtudiant";
      $stmt = $conn->prepare($request);
      return $stmt->execute([':NEtudiant' => $NEtudiant, ':nom' => $nom, ':prenom' => $prenom]);
    }catch(PDOException $e){
      echo "Erreur lors de la suppression : " . $e->getMessage();
      return false;
    }
  }
  public static function countAll($param="") {
    $conn = Gestionscolarite::connect();
    $requete = "SELECT COUNT(DISTINCT ev.NEtudiant) FROM evaluer ev";
    if($param !== ""){
      $requete .= " JOIN etudiant e ON ev.NEtudiant = e.NEtudiant WHERE (e.Nom LIKE :r)  OR (e.Prenom LIKE :r) OR (CONCAT(e.Nom, ' ', e.Prenom) LIKE :r) OR (CONCAT(e.Prenom, ' ', e.Nom) LIKE :r)";
      try {
        $stmt = $conn->prepare($requete);
        $like = "%$param%";
        if($stmt->execute([":r" => $like])){
          return (int)$stmt->fetchColumn();
        }
      } catch (PDOException $e) {
         echo "Error sql : " . $e->getMessage();
         return 0;
      }
    }
    return (int)$conn->query($requete)->fetchColumn();
  }  
}