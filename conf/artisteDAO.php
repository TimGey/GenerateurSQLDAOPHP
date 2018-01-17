<?php 
 
class artisteDAO {
 
   private $cnx;
public function __construct(PDO $pcnx) {
$this->cnx = $pcnx;
}
 
 public function selectALLartiste() {
 try {
$querySQL ="SELECT * FROM  artiste";
$lrs = $this->cnx->query($querySQL);
$lrs->setFetchMode(PDO::FETCH_ASSOC);
$List = $lrs->fetchAll();
} catch (PDOException $exc) {
$List = null;
}
return $List;
}

public function selectOneartiste($pPK) {
 try {
$querySQL = "SELECT * FROM artiste WHERE ID_artiste=? ";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pPK));
 $lrs->setFetchMode(PDO::FETCH_ASSOC);
 $result = $lrs->fetch();
 } catch (PDOException $exc) {
 $result = null;
} 
 
return $result;
 } 

 public function insertartiste($pNOM_artiste){
try {
$iAffect = 0;
$querySQL="INSERT INTO artiste (NOM_artiste) VALUES(?)";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pNOM_artiste));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}

 public function updateartiste($pID_artiste, $pNOM_artiste){
try {
$iAffect = 0;
$querySQL="UPDATE artiste SET NOM_artiste=? WHERE ID_artiste =? ";
$lrs = $this->cnx->prepare($querySQL); 
$lrs->execute(array($pNOM_artiste, $pID_artiste ));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
public function deleteartiste($pID_artiste) {
 try {
$iAffect = 0;
$querySQL = "DELETE FROM artiste WHERE ID_artiste = ?";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pID_artiste));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
}