<?php 
 
class jeux_videoDAO {
 
   private $cnx;
public function __construct(PDO $pcnx) {
$this->cnx = $pcnx;
}
 
 public function selectALLjeux_video() {
 try {
$querySQL ="SELECT * FROM  jeux_video";
$lrs = $this->cnx->query($querySQL);
$lrs->setFetchMode(PDO::FETCH_ASSOC);
$List = $lrs->fetchAll();
} catch (PDOException $exc) {
$List = null;
}
return $List;
}

public function selectOnejeux_video($pPK) {
 try {
$querySQL = "SELECT * FROM jeux_video WHERE $lrs =";
$this->cnx->prepare($querySQL);
$lrs->execute(array($pPK));
 $lrs->setFetchMode(PDO::FETCH_ASSOC);
 $result = $lrs->fetch();
 } catch (PDOException $exc) {
 $result = null;
} 
 
return $result;
 } 

 public function insertjeux_video($pID, $pnom, $pconsole, $pprix, $pnbre_joueurs_max, $pcommentaires){
try {
$iAffect = 0;
$querySQL="INSERT INTO jeux_video (ID, nom, console, prix, nbre_joueurs_max, commentaires) VALUES(?, ?, ?, ?, ?, ?)";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pID, $pnom, $pconsole, $pprix, $pnbre_joueurs_max, $pcommentaires));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}

 public function updatejeux_video($pID, $pnom, $pconsole, $pprix, $pnbre_joueurs_max, $pcommentaires){
try {
$iAffect = 0;
$querySQL="UPDATE jeux_video SET ID=?, nom=?, console=?, prix=?, nbre_joueurs_max=?, commentaires=? WHERE  =? ";
$lrs = $this->cnx->prepare($querySQL); 
$lrs->execute(array($pID, $pnom, $pconsole, $pprix, $pnbre_joueurs_max, $pcommentaires, $p ));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
public function deletejeux_video($p) {
 try {
$iAffect = 0;
$querySQL = "DELETE FROM jeux_video WHERE  = ?";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($p));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
}