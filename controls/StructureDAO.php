<?php

/**
 * Description of StructureDAO
 *
 * @author Administrateur
 */
class StructureDAO {

    private $_cnx;

//put your code here
// --- Le constructeur
    public function _construc(PDO $pcnx) {
        $this->cnx = $pcnx;
    }

    public function selectALLNomDeTable() {
        try {
            $querySQL = "SELECT * FROM table ";
            $lrs = $this->_cnx->query($querySQL);
            $lrs->setFetchMode(PDO::FETCH_ASSOC);
            $List = $lrs->fetchAll();
        } catch (PDOException $exc) {
            $List = null; //ecrire la condition
        }

        return $List;
    }

    public function selectOneNomDeTable($pPK) {
        try {
            $querySQL = "SELECT * FROM table WHERE nomDePK =?";
            $lrs = $lcnx->prepare($querySQL);
            $lrs->execute(array($pPK));
            $lrs->setFetchMode(PDO::FETCH_ASSOC);
            $tObjet = $lrs->fetch();
        } catch (PDOException $exc) {
            $tObjet = null; //ecrire la condition
        }

        return $tObjet;
    }

    public function insertNomDeTable() {
        
    }

    public function updateNomDeTable() {
        
    }

    public function deleteNomDeTable($pPK) {
        try {
            $iAffect = 0;
            $strdelete = "DELETE FROM NomDeTable WHERE PK= ?";
            $lrs = $lcnx->prepare($strdelete);
            $lrs->execute(array($pFK));
            $iAffect = $lrs->rowcount();
        } catch (Exception $ex) {
            $iAffect = -1;
        }

        return $iAffect;
    }

}
