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

  // Utiliser WHERE pour les filtres simples
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

  public static function Supprimer($id){
  $conn = Gestionscolarite::connect();
  try {
    $conn->beginTransaction();

    $stmt1 = $conn->prepare("DELETE FROM evaluer WHERE NEtudiant = :id");
    $stmt1->execute([':id' => $id]);

    $stmt2 = $conn->prepare("DELETE FROM etudiant WHERE NEtudiant = :id");
    $result = $stmt2->execute([':id' => $id]);
    
    $conn->commit();
    return true;
  } catch(PDOException $e) {
    echo "Erreur lors de la suppression : " . $e->getMessage();
    return false;
  }
}

public static function Modifier($id, $nom, $prenom){
  $conn = Gestionscolarite::connect();
  try{
    $request = "UPDATE etudiant SET Nom=:nom, Prenom=:prenom WHERE NEtudiant= :id";
    $stmt = $conn->prepare($request);
    return $stmt->execute([':id' => $id, ':nom' => $nom, ':prenom' => $prenom]);
  }catch(PDOException $e){
    echo "Erreur lors de la suppression : " . $e->getMessage();
    return false;
  }
}
}