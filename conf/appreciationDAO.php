<?php 
 
class appreciationDAO {
 
   private $cnx;
public function __construct(PDO $pcnx) {
$this->cnx = $pcnx;
}
 
 public function selectALLappreciation() {
 try {
$querySQL ="SELECT * FROM  appreciation";
$lrs = $this->cnx->query($querySQL);
$lrs->setFetchMode(PDO::FETCH_ASSOC);
$List = $lrs->fetchAll();
} catch (PDOException $exc) {
$List = null;
}
return $List;
}

public function selectOneappreciation($pPK) {
 try {
$querySQL = "SELECT * FROM appreciation WHERE ID_appreciation=? ";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pPK));
 $lrs->setFetchMode(PDO::FETCH_ASSOC);
 $result = $lrs->fetch();
 } catch (PDOException $exc) {
 $result = null;
} 
 
return $result;
 } 

 public function insertappreciation($pETOILE, $pLIBELLE_appreciation){
try {
$iAffect = 0;
$querySQL="INSERT INTO appreciation (ETOILE, LIBELLE_appreciation) VALUES(?, ?)";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pETOILE, $pLIBELLE_appreciation));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}

 public function updateappreciation($pID_appreciation, $pETOILE, $pLIBELLE_appreciation){
try {
$iAffect = 0;
$querySQL="UPDATE appreciation SET ETOILE=?, LIBELLE_appreciation=? WHERE ID_appreciation =? ";
$lrs = $this->cnx->prepare($querySQL); 
$lrs->execute(array($pETOILE, $pLIBELLE_appreciation, $pID_appreciation ));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
public function deleteappreciation($pID_appreciation) {
 try {
$iAffect = 0;
$querySQL = "DELETE FROM appreciation WHERE ID_appreciation = ?";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pID_appreciation));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
}