<?php

require_once './controls/StringConversion.php';

/**
 * 
 * @param type $ptSQLTable
 * @param type $ptableName
 * @return string
 */
function tBD2Str($ptSQLTable, $ptableName) {



    $colonnePKName = "";

    $contenuDAO = "// import dto à ajouté \n";
    $contenuDAO .= "<?php \n";
    $contenuDAO.= " \nclass " . StringConversion::camelConversion($ptableName) . "DAO {\n \n " . '  private $cnx' . ";\n";
    $contenuDAO.='public function __construct(PDO $pcnx) {' . "\n";
    $contenuDAO.= '$this->cnx = $pcnx;' . "\n";
    $contenuDAO.="}\n \n ";

    /**
     * select all
     */
    $contenuDAO.= "public function selectALL () {\n ";
    $contenuDAO.="try {\n";
    $contenuDAO.='$querySQL =' . "\"" . 'SELECT * FROM  ' . $ptableName . "\";\n";
    $contenuDAO.='$lrs = $this->cnx->query($querySQL)' . ";\n";
    $contenuDAO.='$lrs->setFetchMode(PDO::FETCH_ASSOC)' . ";\n";
    $contenuDAO.='$List = $lrs->fetchAll()' . ";\n";
    $contenuDAO.='$tdto = array();';
    $contenuDAO.='foreach ($List as $ligne) {' . "\n";
    $contenuDAO.='$dto = new' . $ptableName . '('; //$ligne["idAbonnement"], $ligne["dateAbonnement"], $ligne["duree"], $ligne["idLecteur"]);' . "\n";
    foreach ($ptSQLTable as $colonne) {
        $contenuDAO.='$ligne [' . "\"" . $colonne["nomTable"] . "\"] ,";
    }
    $contenuDAO = substr($contenuDAO, 0, -2) . ") ;\n";
    $contenuDAO.='$tdto[] = $dto; ' . "\n }";
    $contenuDAO.='} catch (PDOException $exc) {' . "\n";
    $contenuDAO.='$tdto[] = null;' . "\n";
    $contenuDAO.='}' . "\n";

    $contenuDAO.='return $tdto;' . "\n";
    $contenuDAO.='}' . "\n\n";


    /**
     * select One
     */
    $contenuDAO.="public function selectOne(" . '$pPK' . ") {\n ";
    $contenuDAO.="try {\n";
    $contenuDAO.='$querySQL' . " = \"SELECT * FROM " . $ptableName . " WHERE ";

    foreach ($ptSQLTable as $colonne) {
        if (array_key_exists("PK", $colonne)) {
            $contenuDAO.= $colonne["nomTable"] . "=? \";\n";
            $colonnePKName = $colonne["nomTable"];
        }
    }
    $contenuDAO.='$lrs = $this->cnx->prepare($querySQL);' . "\n";
    $contenuDAO.='$lrs->execute(array($pPK));' . "\n";
    $contenuDAO.=' $lrs->setFetchMode(PDO::FETCH_ASSOC);' . "\n";
    $contenuDAO.=' $result = $lrs->fetch();' . "\n";
    $contenuDAO.=' } catch (PDOException $exc) {' . "\n";
    $contenuDAO.=' $result = null;' . "\n";
    $contenuDAO.="} \n \n";
    $contenuDAO.='return $result;' . "\n } \n\n";

    /**
     * insert
     */
    $contenuDAO.=" public function insert(" . StringConversion::camelConversion($ptableName) . '$p' . StringConversion::camelConversion($ptableName) . ") {\n";

    $contenuDAO.="try {\n";
    $contenuDAO.='$iAffect = 0;' . "\n";
    $contenuDAO.='$querySQL' . "=\"INSERT INTO $ptableName (";
    foreach ($ptSQLTable as $colonne) {
        if (!array_key_exists("PK", $colonne)) {
            $contenuDAO.=$colonne["nomTable"] . ", ";
        }
    }
    $contenuDAO = substr($contenuDAO, 0, strlen($contenuDAO) - 2) . ") VALUES(";
    foreach ($ptSQLTable as $colonne) {
        if (!array_key_exists("PK", $colonne)) {
            $contenuDAO.="?, ";
        }
    }


    $contenuDAO = substr($contenuDAO, 0, strlen($contenuDAO) - 2) . ")\";\n";
    $contenuDAO.='$lrs = $this->cnx->prepare($querySQL);' . "\n";
    $contenuDAO.='$lrs->execute(array(';
    foreach ($ptSQLTable as $colonne) {
        if (!array_key_exists("PK", $colonne)) {
            $contenuDAO.= '$p' . StringConversion::camelConversion($ptableName) . "->get" . StringConversion::camelConversion($colonne["nomTable"]) . "(), "; //'$p' . $colonne["nomTable"] . ", ";
        }
    }
    $contenuDAO = substr($contenuDAO, 0, strlen($contenuDAO) - 2) . "));\n";
    $contenuDAO.='$iAffect = $lrs->rowcount();' . "\n";
    $contenuDAO.='} catch (Exception $ex) {' . "\n";
    $contenuDAO.=' $iAffect = -1;' . "\n";
    $contenuDAO.="}\n return " . '$iAffect' . ";\n}\n\n";

    /**
     * update
     */
    $contenuDAO.=" public function update(" . StringConversion::camelConversion($ptableName) . ' $p' . StringConversion::camelConversion($ptableName) . ") {";
    $contenuDAO.="try {\n";
    $contenuDAO.='$iAffect = 0;' . "\n";
    $contenuDAO.='$querySQL' . "=\"UPDATE $ptableName SET ";
    foreach ($ptSQLTable as $colonne) {
        if (!array_key_exists("PK", $colonne)) {
            $contenuDAO.=$colonne["nomTable"] . "=?, ";
        }
    }
    $contenuDAO = substr($contenuDAO, 0, strlen($contenuDAO) - 2) . " WHERE $colonnePKName =? \";\n";
    $contenuDAO.='$lrs = $this->cnx->prepare($querySQL);' . " \n";
    $contenuDAO.='$lrs->execute(array(';
    foreach ($ptSQLTable as $colonne) {
        if (!array_key_exists("PK", $colonne)) {
            $contenuDAO.= '$p' . StringConversion::camelConversion($ptableName) . "->" . StringConversion::camelConversion("get" . $colonne["nomTable"]) . "(), "; // $contenuDAO.='$p' . $colonne["nomTable"] . ", ";
        }
    }
    $contenuDAO = substr($contenuDAO, 0, strlen($contenuDAO) - 2) . ', $p' . StringConversion::camelConversion($colonnePKName) . " ));\n";
    $contenuDAO.='$iAffect = $lrs->rowcount();' . "\n";
    $contenuDAO.='} catch (Exception $ex) {' . "\n";
    $contenuDAO.=' $iAffect = -1;' . "\n";
    $contenuDAO.="}\n return " . '$iAffect' . ";\n}\n \n";

    /**
     * delete
     */
    $contenuDAO.="public function delete(" . '$p' . $colonnePKName . ") {\n ";
    $contenuDAO.="try {\n";
    $contenuDAO.='$iAffect = 0;' . "\n";
    $contenuDAO.='$querySQL' . " = \"DELETE FROM " . $ptableName . " WHERE $colonnePKName = ?\";\n";
    $contenuDAO.='$lrs = $this->cnx->prepare($querySQL);' . "\n";
    $contenuDAO.='$lrs->execute(array($p' . $colonnePKName . "));\n";
    $contenuDAO.='$iAffect = $lrs->rowcount();' . "\n";
    $contenuDAO.='} catch (Exception $ex) {' . "\n";
    $contenuDAO.=' $iAffect = -1;' . "\n";
    $contenuDAO.="}\n return " . '$iAffect' . ";\n}\n \n";
    $contenuDAO.="}";


    return $contenuDAO;
}
