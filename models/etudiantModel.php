<?php
require "./config/db.php";
class EtudiantModel{
  public static function lister($param="", $valeur=""){
    $conn = Gestionscolarite::connect();
    
     $requete =
      "SELECT et.NEtudiant, et.Nom, et.Prenom, 
      count(m.CodeMat) as NombreEvaluation,  
      sum(ev.Note * m.CoeffMat ) as AditionProduit, 
      sum(m.CoeffMat) as AditionCoef
      FROM etudiant et 
      JOIN evaluer ev 
      ON et.NEtudiant = ev.NEtudiant 
      JOIN matiere m 
      ON m.CodeMat = ev.CodeMat
      group by et.NEtudiant";

      if($param === "Nom"){
        $requete .= " HAVING et.Nom LIKE :valeur";
      }elseif($param === "Prenom"){
        $requete .= " HAVING et.Prenom = :valeur";
      }
    try{
      $stmt = $conn->prepare($requete);
      if($param === "Nom" || $param === "Prenom"){
        $stmt->bindValue(':valeur', "%$valeur%", PDO::PARAM_STR);
      }
      $stmt->execute();
      return $stmt->fetchAll();
    }catch(PDOException $e){
      echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
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