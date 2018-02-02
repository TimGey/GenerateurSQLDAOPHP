<?php 
// import dto à ajouté 
 
class VendeursDAO {
 
   private $cnx;
public function __construct(PDO $pcnx) {
$this->cnx = $pcnx;
}
 
 public function selectALL () {
 try {
$querySQL ="SELECT * FROM  vendeurs";
$lrs = $this->cnx->query($querySQL);
$lrs->setFetchMode(PDO::FETCH_ASSOC);
$List = $lrs->fetchAll();
$tdto = array();foreach ($List as $ligne) {
$dto = new Vendeurs($ligne ["id_vendeur"] ,$ligne ["nom"] ,$ligne ["chef"] ,$ligne ["cp"]) ;
$tdto[] = $dto; 
 }} catch (PDOException $exc) {
$tdto[] = null;
}
return $tdto;
}

public function selectOne($pPK) {
 try {
$querySQL = "SELECT * FROM vendeurs WHERE id_vendeur=? ";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pPK));
 $lrs->setFetchMode(PDO::FETCH_ASSOC);
 $result = $lrs->fetch();
 } catch (PDOException $exc) {
 $result = null;
} 
 
return $result;
 } 

 public function insert(Vendeurs $pvendeurs) {
try {
$iAffect = 0;
$querySQL="INSERT INTO vendeurs (nom, chef, cp) VALUES(?, ?, ?)";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pvendeurs->getnom(), $pvendeurs->getchef(), $pvendeurs->getcp()));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}

 public function update(vendeurs $pvendeurs) {try {
$iAffect = 0;
$querySQL="UPDATE vendeurs SET nom=?, chef=?, cp=? WHERE id_vendeur =? ";
$lrs = $this->cnx->prepare($querySQL); 
$lrs->execute(array($pvendeurs->getnom(), $pvendeurs->getchef(), $pvendeurs->getcp(), $pid_vendeur ));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
public function delete($pid_vendeur) {
 try {
$iAffect = 0;
$querySQL = "DELETE FROM vendeurs WHERE id_vendeur = ?";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pid_vendeur));
$iAffect = $lrs->rowcount();
} catch (Exception $ex) {
 $iAffect = -1;
}
 return $iAffect;
}
 
}