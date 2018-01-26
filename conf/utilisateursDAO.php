<?php

// import dto à ajouté 

class utilisateursDAO {

    private $cnx;

    public function __construct(PDO $pcnx) {
        $this->cnx = $pcnx;
    }

    public function selectALL() {
        try {
            $querySQL = "SELECT * FROM  utilisateurs";
            $lrs = $this->cnx->query($querySQL);
            $lrs->setFetchMode(PDO::FETCH_ASSOC);
            $List = $lrs->fetchAll();
            $tdto = array();
            foreach ($List as $ligne) {
                $dto = newutilisateurs($ligne ["idUtilisateur"], $ligne ["prenom"], $ligne ["nom"], $ligne ["age"], $ligne ["email"], $ligne ["adresse"], $ligne ["telephone"], $ligne ["site"], $ligne ["famille"], $ligne ["nationalite"], $ligne ["idVille"], $ligne ["mdp"]);
                $tdto[] = $dto;
            }
        } catch (PDOException $exc) {
            $tdto[] = null;
        }
        return $tdto;
    }

    public function selectOne($pPK) {
        try {
            $querySQL = "SELECT * FROM utilisateurs WHERE idUtilisateur=? ";
            $lrs = $this->cnx->prepare($querySQL);
            $lrs->execute(array($pPK));
            $lrs->setFetchMode(PDO::FETCH_ASSOC);
            $result = $lrs->fetch();
        } catch (PDOException $exc) {
            $result = null;
        }

        return $result;
    }

    public function insert(utilisateurs$putilisateurs) {
        try {
            $iAffect = 0;
            $querySQL = "INSERT INTO utilisateurs (prenom, nom, age, email, adresse, telephone, site, famille, nationalite, idVille, mdp) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $lrs = $this->cnx->prepare($querySQL);
            $lrs->execute(array($putilisateurs->getprenom(), $putilisateurs->getnom(), $putilisateurs->getage(), $putilisateurs->getemail(), $putilisateurs->getadresse(), $putilisateurs->gettelephone(), $putilisateurs->getsite(), $putilisateurs->getfamille(), $putilisateurs->getnationalite(), $putilisateurs->getidVille(), $putilisateurs->getmdp()));
            $iAffect = $lrs->rowcount();
        } catch (Exception $ex) {
            $iAffect = -1;
        }
        return $iAffect;
    }

    public function update(utilisateurs $putilisateurs) {
        try {
            $iAffect = 0;
            $querySQL = "UPDATE utilisateurs SET prenom=?, nom=?, age=?, email=?, adresse=?, telephone=?, site=?, famille=?, nationalite=?, idVille=?, mdp=? WHERE idUtilisateur =? ";
            $lrs = $this->cnx->prepare($querySQL);
            $lrs->execute(array($putilisateurs->getprenom(), $putilisateurs->getnom(), $putilisateurs->getage(), $putilisateurs->getemail(), $putilisateurs->getadresse(), $putilisateurs->gettelephone(), $putilisateurs->getsite(), $putilisateurs->getfamille(), $putilisateurs->getnationalite(), $putilisateurs->getidVille(), $putilisateurs->getmdp(), $pidUtilisateur));
            $iAffect = $lrs->rowcount();
        } catch (Exception $ex) {
            $iAffect = -1;
        }
        return $iAffect;
    }

    public function delete($pidUtilisateur) {
        try {
            $iAffect = 0;
            $querySQL = "DELETE FROM utilisateurs WHERE idUtilisateur = ?";
            $lrs = $this->cnx->prepare($querySQL);
            $lrs->execute(array($pidUtilisateur));
            $iAffect = $lrs->rowcount();
        } catch (Exception $ex) {
            $iAffect = -1;
        }
        return $iAffect;
    }

}
