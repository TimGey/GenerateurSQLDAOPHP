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

    public function selectALL() {
        $querySQL = "SELECT * FROM table ";
        $lrs = $this->_cnx->query($querySQL);
    }

    public function selectOne() {
        
    }

    public function insert() {
        
    }

    public function update() {
        
    }

    public function delete() {
        
    }

}
