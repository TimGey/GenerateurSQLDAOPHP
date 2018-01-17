<?php 
 
class articleDAO {
 
   private $cnx;
public function __construct(PDO $pcnx) {
$this->cnx = $pcnx;
}
 
 public function selectALLarticle() {
 try {
$querySQL ="SELECT * FROM  article";
$lrs = $this->cnx->query($querySQL);
$lrs->setFetchMode(PDO::FETCH_ASSOC);
$List = $lrs->fetchAll();
} catch (PDOException $exc) {
$List = null;
}
return $List;
}

public function selectOnearticle($pPK) {
 try {
$querySQL = "SELECT * FROM article WHERE ID_article=? ";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pPK));
 $lrs->setFetchMode(PDO::FETCH_ASSOC);
 $result = $lrs->fetch();
 } catch (PDOException $exc) {
 $result = null;
} 
 
return $result;
 } 

 public function insertarticle($pID_journaliste, $pID_film=null , $pTITRE_article, $pTEXTE_article, $pPHOTO_article=null ){
try {
$iAffect = 0;
$querySQL="INSERT INTO article (ID_journaliste, ID_film, TITRE_article, TEXTE_article, PHOTO_article) VALUES(?, ?, ?, ?, ?)";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pID_journaliste, $pID_film, $pTITRE_article, $pTEXTE_article, $pPHOTO_article));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}

 public function updatearticle($pID_article, $pID_journaliste, $pID_film=null , $pTITRE_article, $pTEXTE_article, $pPHOTO_article=null ){
try {
$iAffect = 0;
$querySQL="UPDATE article SET ID_journaliste=?, ID_film=?, TITRE_article=?, TEXTE_article=?, PHOTO_article=? WHERE ID_article =? ";
$lrs = $this->cnx->prepare($querySQL); 
$lrs->execute(array($pID_journaliste, $pID_film, $pTITRE_article, $pTEXTE_article, $pPHOTO_article, $pID_article ));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
public function deletearticle($pID_article) {
 try {
$iAffect = 0;
$querySQL = "DELETE FROM article WHERE ID_article = ?";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pID_article));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
}