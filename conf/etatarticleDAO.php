<?php

class etatarticleDAO {

    private $cnx;

    public function __construct(PDO $pcnx) {
        $this->cnx = $pcnx;
    }

    public function selectALLetatarticle() {
        try {
            $querySQL = "SELECT * FROM  etatarticle";
            $lrs = $this->cnx->query($querySQL);
            $lrs->setFetchMode(PDO::FETCH_ASSOC);
            $List = $lrs->fetchAll();
        } catch (PDOException $exc) {
            $List = null;
        }
        return $List;
    }

    public function selectOneetatarticle($pPK) {
        try {
            $querySQL = "SELECT * FROM etatarticle WHERE idEtatArticle=? ";
            $lrs = $this->cnx->prepare($querySQL);
            $lrs->execute(array($pPK));
            $lrs->setFetchMode(PDO::FETCH_ASSOC);
            $result = $lrs->fetch();
        } catch (PDOException $exc) {
            $result = null;
        }

        return $result;
    }

    public function insertetatarticle($petatArticle) {
        try {
            $iAffect = 0;
            $querySQL = "INSERT INTO etatarticle (etatArticle) VALUES(?)";
            $lrs = $this->cnx->prepare($querySQL);
            $lrs->execute(array($petatArticle));
            $iAffect = $lrs->rowcount();
        } catch (Exception $ex) {
            $iAffect = -1;
        }
        return $iAffect;
    }

    public function updateetatarticle($pidEtatArticle, $petatArticle) {
        try {
            $iAffect = 0;
            $querySQL = "UPDATE etatarticle SET etatArticle=? WHERE idEtatArticle =? ";
            $lrs = $this->cnx->prepare($querySQL);
            $lrs->execute(array($petatArticle, $pidEtatArticle));
            $iAffect = $lrs->rowcount();
        } catch (Exception $ex) {
            $iAffect = -1;
        }
        return $iAffect;
    }

    public function deleteetatarticle($pidEtatArticle) {
        try {
            $iAffect = 0;
            $querySQL = "DELETE FROM etatarticle WHERE idEtatArticle = ?";
            $lrs = $this->cnx->prepare($querySQL);
            $lrs->execute(array($pidEtatArticle));
            $iAffect = $lrs->rowcount();
        } catch (Exception $ex) {
            $iAffect = -1;
        }
        return $iAffect;
    }

}
