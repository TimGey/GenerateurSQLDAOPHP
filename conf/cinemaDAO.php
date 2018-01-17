<?php 
 
class cinemaDAO {
 
   private $cnx;
public function __construct(PDO $pcnx) {
$this->cnx = $pcnx;
}
 
 public function selectALLcinema() {
 try {
$querySQL ="SELECT * FROM  cinema";
$lrs = $this->cnx->query($querySQL);
$lrs->setFetchMode(PDO::FETCH_ASSOC);
$List = $lrs->fetchAll();
} catch (PDOException $exc) {
$List = null;
}
return $List;
}

public function selectOnecinema($pPK) {
 try {
$querySQL = "SELECT * FROM cinema WHERE ID_cinema=? ";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pPK));
 $lrs->setFetchMode(PDO::FETCH_ASSOC);
 $result = $lrs->fetch();
 } catch (PDOException $exc) {
 $result = null;
} 
 
return $result;
 } 

 public function insertcinema($pID_ville=null , $pID_arrondissement=null , $pCODE_cinema, $pNOM_cinema, $pADRESSE_cinema=null , $pTELEPHONE_cinema=null , $pTARIFS_cinema=null , $pDIVERS_cinema=null , $pRESEAU_cinema=null , $pACCES_HANDICAPES=null ){
try {
$iAffect = 0;
$querySQL="INSERT INTO cinema (ID_ville, ID_arrondissement, CODE_cinema, NOM_cinema, ADRESSE_cinema, TELEPHONE_cinema, TARIFS_cinema, DIVERS_cinema, RESEAU_cinema, ACCES_HANDICAPES) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pID_ville, $pID_arrondissement, $pCODE_cinema, $pNOM_cinema, $pADRESSE_cinema, $pTELEPHONE_cinema, $pTARIFS_cinema, $pDIVERS_cinema, $pRESEAU_cinema, $pACCES_HANDICAPES));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}

 public function updatecinema($pID_cinema, $pID_ville=null , $pID_arrondissement=null , $pCODE_cinema, $pNOM_cinema, $pADRESSE_cinema=null , $pTELEPHONE_cinema=null , $pTARIFS_cinema=null , $pDIVERS_cinema=null , $pRESEAU_cinema=null , $pACCES_HANDICAPES=null ){
try {
$iAffect = 0;
$querySQL="UPDATE cinema SET ID_ville=?, ID_arrondissement=?, CODE_cinema=?, NOM_cinema=?, ADRESSE_cinema=?, TELEPHONE_cinema=?, TARIFS_cinema=?, DIVERS_cinema=?, RESEAU_cinema=?, ACCES_HANDICAPES=? WHERE ID_cinema =? ";
$lrs = $this->cnx->prepare($querySQL); 
$lrs->execute(array($pID_ville, $pID_arrondissement, $pCODE_cinema, $pNOM_cinema, $pADRESSE_cinema, $pTELEPHONE_cinema, $pTARIFS_cinema, $pDIVERS_cinema, $pRESEAU_cinema, $pACCES_HANDICAPES, $pID_cinema ));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
public function deletecinema($pID_cinema) {
 try {
$iAffect = 0;
$querySQL = "DELETE FROM cinema WHERE ID_cinema = ?";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pID_cinema));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
}