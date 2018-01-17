<?php

class villeDAO {

private $cnx;
public function __construct(PDO $pcnx) {
$this->cnx = $pcnx;
}

public function selectALLville() {
try {
$querySQL ="SELECT * FROM ville";
$lrs = $this->cnx->query($querySQL);
$lrs->setFetchMode(PDO::FETCH_ASSOC);
$List = $lrs->fetchAll();
} catch (PDOException $exc) {
$List = null;
}
return $List;
}
public function selectOneville($pPK) {
try {
$querySQL = "SELECT * FROM ville WHERE ID_ville=? ";
$lrs = $this->cnx->prepare($querySQL);
$lrs->execute(array($pPK));
$lrs->setFetchMode(PDO::FETCH_ASSOC);
$result = $lrs->fetch();
} catch (PDOException $exc) {
$result = null;
} 

return $result;
}

}

/**
 * test
 */
$lcnx = new PDO("mysql:host=localhost;dbname=cinescope2014", "root", "");
$lcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$lcnx->exec("SET NAMES 'UTF8'");

echo "<br><pre>";
var_dump($lcnx);
echo "</pre><br>";

$daotest = new villeDAO($lcnx);

$selectAll = $daotest->selectOneville(1);

//print_r($selectAll);
echo "<br><pre>";
var_dump($selectAll);
echo "</pre><br>";


