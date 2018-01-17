<?php
/**
 * 
 * @param type $ptSQLTable
 * @param type $ptableName
 * @return string
 */
function tBD2Str($ptSQLTable, $ptableName) {




    $contenuDAO = "<?php \n";
    $contenuDAO.= " \nclass " . $ptableName . "DAO {\n \n " . '  private $cnx' . ";\n";
    $contenuDAO.='public function __construct(PDO $pcnx) {' . "\n";
    $contenuDAO.= '$this->cnx = $pcnx;' . "\n";
    $contenuDAO.="}\n \n ";

    /**
     * select all
     */
    $contenuDAO.= "public function selectALL" . $ptableName . "() {\n ";
    $contenuDAO.="try {\n";
    $contenuDAO.='$querySQL =' . "\"" . 'SELECT * FROM  ' . $ptableName . "\";\n";
    $contenuDAO.='$lrs = $this->cnx->query($querySQL)' . ";\n";
    $contenuDAO.='$lrs->setFetchMode(PDO::FETCH_ASSOC)' . ";\n";
    $contenuDAO.='$List = $lrs->fetchAll()' . ";\n";
    $contenuDAO.='} catch (PDOException $exc) {' . "\n";
    $contenuDAO.='$List = null;' . "\n";
    $contenuDAO.='}' . "\n";

    $contenuDAO.='return $List;' . "\n";
    $contenuDAO.='}' . "\n";

    
    /**
     * select One
     */
    $contenuDAO.="public function selectOne$ptableName(".'$pPK'.") {\n ";
    $contenuDAO.="try {\n";
    $contenuDAO.='$querySQL' . " = \"SELECT * FROM " . $ptableName . " WHERE ";

    foreach ($ptSQLTable as $colonne) {
        if (array_key_exists("PK", $colonne)) {
            $contenuDAO.= $colonne["nomTable"] . "=? \";\n";
        }
    }
    $contenuDAO.='$lrs = $this->cnx->prepare($querySQL);' . "\n";
    $contenuDAO.='$lrs->execute(array($pPK));' . "\n";
    $contenuDAO.=' $lrs->setFetchMode(PDO::FETCH_ASSOC);' . "\n";
    $contenuDAO.=' $result = $lrs->fetch();' . "\n";
    $contenuDAO.=' } catch (PDOException $exc) {'."\n";
    $contenuDAO.=' $result = null;'."\n";
    $contenuDAO.="} \n \n";
    $contenuDAO.='return $result;'."\n } \n";
    
    
    
    return $contenuDAO;
}
