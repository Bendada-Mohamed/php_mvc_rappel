<?php
require "./config/db.php";
class EtudiantModel{
public static function lister($param="", $valeur=""){
  $conn = Gestionscolarite::connect();

  $requete =
  "SELECT et.NEtudiant, et.Nom, et.Prenom, 
      COUNT(m.CodeMat) AS NombreEvaluation,
      SUM(ev.Note * m.CoeffMat) AS AditionProduit,
      SUM(m.CoeffMat) AS AditionCoef
  FROM etudiant et
  JOIN evaluer ev ON et.NEtudiant = ev.NEtudiant
  JOIN matiere m ON m.CodeMat = ev.CodeMat";

  if($param === "Nom"){
      $requete .= " WHERE et.Nom LIKE :valeur";
  } elseif($param === "Prenom"){
      $requete .= " WHERE et.Prenom LIKE :valeur";
  }

  // GROUP BY après le WHERE
  $requete .= " GROUP BY et.NEtudiant";
  try {
      $stmt = $conn->prepare($requete);

      if($param === "Nom" || $param === "Prenom"){
          $stmt->bindValue(':valeur', "%$valeur%", PDO::PARAM_STR);
      }

      $stmt->execute();
      return $stmt->fetchAll();
  }
  catch(PDOException $e){
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
  try {
    $conn->beginTransaction();

    $stmt1 = $conn->prepare("DELETE FROM evaluer WHERE NEtudiant = :NEtudiant");
    $stmt1->execute([':NEtudiant' => $NEtudiant]);

    $stmt2 = $conn->prepare("DELETE FROM etudiant WHERE NEtudiant = :NEtudiant");
    $result = $stmt2->execute([':NEtudiant' => $NEtudiant]);
    
    $conn->commit();
    return true;
  } catch(PDOException $e) {
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
}