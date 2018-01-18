<?php 
 
class cinemas_parisDAO {
 
   private $cnx;
public function __construct(PDO $pcnx) {
$this->cnx = $pcnx;
}
 
 public function selectALLcinemas_paris() {
 try {
$querySQL ="SELECT * FROM  cinemas_paris";
$lrs = $this->cnx->query($querySQL);
$lrs->setFetchMode(PDO::FETCH_ASSOC);
$List = $lrs->fetchAll();
} catch (PDOException $exc) {
$List = null;
}
return $List;
}

public function selectOnecinemas_paris($pPK) {
 try {
$querySQL = "SELECT * FROM cinemas_paris WHERE $lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pPK));
 $lrs->setFetchMode(PDO::FETCH_ASSOC);
 $result = $lrs->fetch();
 } catch (PDOException $exc) {
 $result = null;
} 
 
return $result;
 } 

 public function insertcinemas_paris($pID_cinema, $pID_ville, $pID_arrondissement, $pCODE_cinema, $pNOM_cinema, $pADRESSE_cinema, $pTELEPHONE_cinema, $pTARIFS_cinema, $pDIVERS_cinema, $pRESEAU_cinema, $pACCES_HANDICAPES){
try {
$iAffect = 0;
$querySQL="INSERT INTO cinemas_paris (ID_cinema, ID_ville, ID_arrondissement, CODE_cinema, NOM_cinema, ADRESSE_cinema, TELEPHONE_cinema, TARIFS_cinema, DIVERS_cinema, RESEAU_cinema, ACCES_HANDICAPES) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pID_cinema, $pID_ville, $pID_arrondissement, $pCODE_cinema, $pNOM_cinema, $pADRESSE_cinema, $pTELEPHONE_cinema, $pTARIFS_cinema, $pDIVERS_cinema, $pRESEAU_cinema, $pACCES_HANDICAPES));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}

 public function updatecinemas_paris($pID_cinema, $pID_ville, $pID_arrondissement, $pCODE_cinema, $pNOM_cinema, $pADRESSE_cinema, $pTELEPHONE_cinema, $pTARIFS_cinema, $pDIVERS_cinema, $pRESEAU_cinema, $pACCES_HANDICAPES){
try {
$iAffect = 0;
$querySQL="UPDATE cinemas_paris SET ID_cinema=?, ID_ville=?, ID_arrondissement=?, CODE_cinema=?, NOM_cinema=?, ADRESSE_cinema=?, TELEPHONE_cinema=?, TARIFS_cinema=?, DIVERS_cinema=?, RESEAU_cinema=?, ACCES_HANDICAPES=? WHERE  =? ";
$lrs = $this->cnx->prepare($querySQL); 
$lrs->execute(array($pID_cinema, $pID_ville, $pID_arrondissement, $pCODE_cinema, $pNOM_cinema, $pADRESSE_cinema, $pTELEPHONE_cinema, $pTARIFS_cinema, $pDIVERS_cinema, $pRESEAU_cinema, $pACCES_HANDICAPES, $p ));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
public function deletecinemas_paris($p) {
 try {
$iAffect = 0;
$querySQL = "DELETE FROM cinemas_paris WHERE  = ?";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($p));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
}