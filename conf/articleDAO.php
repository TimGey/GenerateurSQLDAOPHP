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
$querySQL = "SELECT * FROM article WHERE idArticle=? ";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pPK));
 $lrs->setFetchMode(PDO::FETCH_ASSOC);
 $result = $lrs->fetch();
 } catch (PDOException $exc) {
 $result = null;
} 
 
return $result;
 } 

 public function insertarticle($ptitre, $psousTitre, $ptexte, $pidEtatArticle){
try {
$iAffect = 0;
$querySQL="INSERT INTO article (titre, sousTitre, texte, idEtatArticle) VALUES(?, ?, ?, ?)";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($ptitre, $psousTitre, $ptexte, $pidEtatArticle));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}

 public function updatearticle($pidArticle, $ptitre, $psousTitre, $ptexte, $pidEtatArticle){
try {
$iAffect = 0;
$querySQL="UPDATE article SET titre=?, sousTitre=?, texte=?, idEtatArticle=? WHERE idArticle =? ";
$lrs = $this->cnx->prepare($querySQL); 
$lrs->execute(array($ptitre, $psousTitre, $ptexte, $pidEtatArticle, $pidArticle ));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
public function deletearticle($pidArticle) {
 try {
$iAffect = 0;
$querySQL = "DELETE FROM article WHERE idArticle = ?";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pidArticle));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
}