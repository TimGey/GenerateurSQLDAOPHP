<?php 
 
class arrondissementDAO {
 
   private $cnx;
public function __construct(PDO $pcnx) {
$this->cnx = $pcnx;
}
 
 public function selectALLarrondissement() {
 try {
$querySQL ="SELECT * FROM  arrondissement";
$lrs = $this->cnx->query($querySQL);
$lrs->setFetchMode(PDO::FETCH_ASSOC);
$List = $lrs->fetchAll();
} catch (PDOException $exc) {
$List = null;
}
return $List;
}

public function selectOnearrondissement($pPK) {
 try {
$querySQL = "SELECT * FROM arrondissement WHERE ID_arrondissement=? ";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pPK));
 $lrs->setFetchMode(PDO::FETCH_ASSOC);
 $result = $lrs->fetch();
 } catch (PDOException $exc) {
 $result = null;
} 
 
return $result;
 } 

 public function insertarrondissement($pCODE_arrondissement, $pNOM_arrondissement){
try {
$iAffect = 0;
$querySQL="INSERT INTO arrondissement (CODE_arrondissement, NOM_arrondissement) VALUES(?, ?)";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pCODE_arrondissement, $pNOM_arrondissement));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}

 public function updatearrondissement($pID_arrondissement, $pCODE_arrondissement, $pNOM_arrondissement){
try {
$iAffect = 0;
$querySQL="UPDATE arrondissement SET CODE_arrondissement=?, NOM_arrondissement=? WHERE ID_arrondissement =? ";
$lrs = $this->cnx->prepare($querySQL); 
$lrs->execute(array($pCODE_arrondissement, $pNOM_arrondissement, $pID_arrondissement ));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
public function deletearrondissement($pID_arrondissement) {
 try {
$iAffect = 0;
$querySQL = "DELETE FROM arrondissement WHERE ID_arrondissement = ?";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pID_arrondissement));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
}