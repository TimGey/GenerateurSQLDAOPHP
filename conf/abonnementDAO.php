// import dto à ajouté 
<?php 
 
class abonnementDAO {
 
   private $cnx;
public function __construct(PDO $pcnx) {
$this->cnx = $pcnx;
}
 
 public function selectALL () {
 try {
$querySQL ="SELECT * FROM  abonnement";
$lrs = $this->cnx->query($querySQL);
$lrs->setFetchMode(PDO::FETCH_ASSOC);
$List = $lrs->fetchAll();
$tdto = array();foreach ($List as $ligne) {
$dto = newabonnement($ligne ["idAbonnement"] ,$ligne ["dateAbonnement"] ,$ligne ["duree"] ,$ligne ["idLecteur"]) ;
$tdto[] = $dto; 
 }} catch (PDOException $exc) {
$tdto[] = null;
}
return $tdto;
}

public function selectOne($pPK) {
 try {
$querySQL = "SELECT * FROM abonnement WHERE idAbonnement=? ";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pPK));
 $lrs->setFetchMode(PDO::FETCH_ASSOC);
 $result = $lrs->fetch();
 } catch (PDOException $exc) {
 $result = null;
} 
 
return $result;
 } 

 public function insert(abonnement$pabonnement) {
try {
$iAffect = 0;
$querySQL="INSERT INTO abonnement (dateAbonnement, duree, idLecteur) VALUES(?, ?, ?)";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pabonnement->getdateAbonnement(), $pabonnement->getduree(), $pabonnement->getidLecteur()));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}

 public function update(abonnement $pabonnement) {try {
$iAffect = 0;
$querySQL="UPDATE abonnement SET dateAbonnement=?, duree=?, idLecteur=? WHERE idAbonnement =? ";
$lrs = $this->cnx->prepare($querySQL); 
$lrs->execute(array($pabonnement->getdateAbonnement(), $pabonnement->getduree(), $pabonnement->getidLecteur(), $pidAbonnement ));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
public function delete($pidAbonnement) {
 try {
$iAffect = 0;
$querySQL = "DELETE FROM abonnement WHERE idAbonnement = ?";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pidAbonnement));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
}