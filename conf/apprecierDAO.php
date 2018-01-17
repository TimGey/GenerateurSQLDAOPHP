<?php 
 
class apprecierDAO {
 
   private $cnx;
public function __construct(PDO $pcnx) {
$this->cnx = $pcnx;
}
 
 public function selectALLapprecier() {
 try {
$querySQL ="SELECT * FROM  apprecier";
$lrs = $this->cnx->query($querySQL);
$lrs->setFetchMode(PDO::FETCH_ASSOC);
$List = $lrs->fetchAll();
} catch (PDOException $exc) {
$List = null;
}
return $List;
}

public function selectOneapprecier($pPK) {
 try {
$querySQL = "SELECT * FROM apprecier WHERE ID_media=? ";
ID_film=? ";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pPK));
 $lrs->setFetchMode(PDO::FETCH_ASSOC);
 $result = $lrs->fetch();
 } catch (PDOException $exc) {
 $result = null;
} 
 
return $result;
 } 

 public function insertapprecier($pID_appreciation){
try {
$iAffect = 0;
$querySQL="INSERT INTO apprecier (ID_appreciation) VALUES(?)";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pID_appreciation));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}

 public function updateapprecier($pID_media, $pID_film, $pID_appreciation){
try {
$iAffect = 0;
$querySQL="UPDATE apprecier SET ID_appreciation=? WHERE ID_film =? ";
$lrs = $this->cnx->prepare($querySQL); 
$lrs->execute(array($pID_appreciation, $pID_film ));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
public function deleteapprecier($pID_film) {
 try {
$iAffect = 0;
$querySQL = "DELETE FROM apprecier WHERE ID_film = ?";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pID_film));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
}