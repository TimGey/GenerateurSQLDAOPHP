<?php
/**
 * Connexion.php : une bibliotheque
 *
 * seConnecter() (a partir d'un fichier ini)
 * seDeconnecter()
 */

/**
 *
 * @param type $psCheminParametresConnexion
 * @return null
 */
function seConnecter($pServeur, $pPort, $pUt, $pMDP, $pDB) {

    /*
     * Connexion
     */
    $lcnx = null;
    try {
        $lcnx = new PDO("mysql:host=$pServeur;port=$pPort;dbname=$pDB;", $pUt, $pMDP);
        $lcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $lcnx->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
        $lcnx->exec("SET NAMES 'UTF8'");
    } catch (Exception $ex) {
        $lcnx = null;
        echo "<br>" . $ex->getMessage();
    }
    return $lcnx;
}

/**
 *
 * @param PDO $pcnx
 */
function seDeconnecter(PDO &$pcnx) {
    $pcnx = null;
}
?>