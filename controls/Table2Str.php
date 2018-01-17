<?php

function tBD2Str($ptSQLTable, $ptableName) {


    $contenuDAO = "\nclass " . $ptableName . "DAO {\n \n " . '  private $cnx'.";\n";
    $contenuDAO.='public function __construct(PDO $pcnx) {'."\n";
    $contenuDAO.= '$this->cnx = $pcnx;'."\n";
    $contenuDAO.="}\n \n ";

    $contenuDAO.= "public function selectALL" . $ptableName . "() {\n ";
    $contenuDAO.="try {\n";
    $contenuDAO.='$querySQL ='."\"".'SELECT * FROM  ' . $ptableName . "\";\n";
    $contenuDAO.='$lrs = $this->cnx->query($querySQL)'.";\n";
    $contenuDAO.='$lrs->setFetchMode(PDO::FETCH_ASSOC)'.";\n";
    $contenuDAO.='$List = $lrs->fetchAll()'.";\n";
    $contenuDAO.='} catch (PDOException $exc) {'."\n";
    $contenuDAO.='$List = null;'."\n";
    $contenuDAO.='}'."\n";

    $contenuDAO.='return $List;'."\n";
    $contenuDAO.='}'."\n";


    return $contenuDAO;
}
