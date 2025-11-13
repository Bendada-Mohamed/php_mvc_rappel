<?php 
require_once "./config/db.php";
class TableauDeBordModel{
  public static function index(){
    $conn = Gestionscolarite::connect();
      $requete1 = "SELECT COUNT(*) as nbr FROM etudiant";
      $requete2 = "SELECT COUNT(*) as nbr FROM matiere";
      $requete3 = "SELECT COUNT(*) as nbr FROM evaluer";

      $requete4 = 
      "SELECT et.NEtudiant,
        CONCAT(et.Nom, ' ', et.Prenom) as Etudiant, 
        COUNT(m.CodeMat) AS 'Nb. matiere', 
        SUM(ev.Note * m.CoeffMat) / SUM(m.CoeffMat) AS Moyenne 
      FROM etudiant et 
      JOIN evaluer ev 
      ON et.NEtudiant = ev.NEtudiant 
      JOIN matiere m 
      ON m.CodeMat = ev.CodeMat 
      GROUP BY et.NEtudiant
      ORDER BY Moyenne DESC
      LIMIT 5";

      $requete5 = 
      "SELECT m.CodeMat, 
        m.LibelleMat, 
        m.CoeffMat, 
        SUM(ev.Note) / COUNT(ev.CodeMat) AS Moyenne 
      FROM matiere m 
      JOIN evaluer ev 
      ON ev.CodeMat = m.CodeMat 
      GROUP BY ev.CodeMat 
      ORDER BY Moyenne DESC 
      LIMIT 5";
      
    try {
      $stmt1 = $conn->query($requete1);
      $nbrEtu = $stmt1->fetchAll();

      $stmt2 = $conn->query($requete2);
      $nbrMat = $stmt2->fetchAll();

      $stmt3 = $conn->query($requete3);
      $nbrEva = $stmt3->fetchAll();
      
      $stmt4 = $conn->query($requete4);
      $topEtu = $stmt4->fetchAll();

      $stmt5 = $conn->query($requete5);
      $topMat = $stmt5->fetchAll();

      return [$nbrEtu, $nbrMat, $nbrEva, $topEtu, $topMat];
    } catch (PDOException $e) {
      echo "Erreur SQL : " . $e->getMessage();
    }
  }
}