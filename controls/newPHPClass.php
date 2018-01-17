<?php

class villesDAO {

    private $cnx;

    public function __construct(PDO $pcnx) {
        $this->cnx = $pcnx;
    }

    public function selectALLvilles() {
        try {
            $querySQL = "SELECT * FROM villes";
            $lrs = $this->cnx->query($querySQL);
            $lrs->setFetchMode(PDO::FETCH_ASSOC);
            $List = $lrs->fetchAll();
        } catch (PDOException $exc) {
            $List = null;
        }
        return $List;
    }

}

/**
 * test
 */
$lcnx = new PDO("mysql:host=localhost;port=3306;dbname=cours", "root", "");
$lcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$lcnx->exec("SET NAMES 'UTF8'");

echo "<br><pre>";
var_dump($lcnx);
echo "</pre><br>";

$daotest = new villesDAO($lcnx);

$selectAll = $daotest->selectALLvilles();

//print_r($selectAll);
echo "<br><pre>";
var_dump($selectAll);
echo "</pre><br>";


