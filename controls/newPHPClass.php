<?php

class paysDAO {

    private $cnx;

    public function __construct(PDO $pcnx) {
        $this->cnx = $pcnx;
    }

    public function selectALLpays() {
        try {
            $querySQL = "SELECT * FROM pays";
            $lrs = $this->cnx->query($querySQL);
            $lrs->setFetchMode(PDO::FETCH_ASSOC);
            $List = $lrs->fetchAll();
        } catch (PDOException $exc) {
            $List = null;
        }
        return $List;
    }

    public function selectOnepays($pPK) {
        try {
            $querySQL = "SELECT * FROM pays WHERE ID_pays=? ";
            $lrs = $this->cnx->prepare($querySQL);
            $lrs->execute(array($pPK));
            $lrs->setFetchMode(PDO::FETCH_ASSOC);
            $result = $lrs->fetch();
        } catch (PDOException $exc) {
            $result = null;
        }

        return $result;
    }

    public function insertpays($pNOM_pays, $pMASCULIN, $pFEMININ, $pNEUTRE) {
        try {
            $iAffect = 0;
            $querySQL = "INSERT INTO pays (NOM_pays, MASCULIN, FEMININ, NEUTRE) VALUES(?, ?, ?, ?)";
            $lrs = $this->cnx->prepare($querySQL);
            $lrs->execute(array($pNOM_pays, $pMASCULIN, $pFEMININ, $pNEUTRE));
            $iAffect = $lrs->rowcount();
        } catch (Exception $ex) {
            $iAffect = -1;
        }
        return $iAffect;
    }

    public function updatepays($pID_pays, $pNOM_pays, $pMASCULIN, $pFEMININ, $pNEUTRE) {
        try {
            $iAffect = 0;
            $querySQL = "UPDATE pays SET NOM_pays=?, MASCULIN=?, FEMININ=?, NEUTRE=? WHERE ID_pays =? ";
            $lrs = $this->cnx->prepare($querySQL);
            $lrs->execute(array($pNOM_pays, $pMASCULIN, $pFEMININ, $pNEUTRE, $pID_pays));
            $iAffect = $lrs->rowcount();
        } catch (Exception $ex) {
            $iAffect = -1;
        }
        return $iAffect;
    }

    public function deletepays($pID_pays) {
        try {
            $iAffect = 0;
            $querySQL = "DELETE FROM pays WHERE ID_pays = ?";
            $lrs = $this->cnx->prepare($querySQL);
            $lrs->execute(array($pID_pays));
            $iAffect = $lrs->rowcount();
        } catch (Exception $ex) {
            $iAffect = -1;
        }
        return $iAffect;
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

$daotest = new paysDAO($lcnx);

$selectAll = $daotest->deletepays(113);

print $selectAll;
//print_r($selectAll);
//echo "<br><pre>";
//var_dump($selectAll);
//echo "</pre><br>";


