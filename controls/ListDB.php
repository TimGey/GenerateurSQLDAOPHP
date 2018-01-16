<?php

require_once 'lib/Connexion.php';
require_once 'lib/Metabase.php';

session_start();

function formToSession($pServeur, $pPort, $pUt, $pMDP) {
    $_SESSION["serveur"] = $pServeur;
    $_SESSION["port"] = $pPort;
    $_SESSION["ut"] = $pUt;
    $_SESSION["mdp"] = $pMDP;
    
    $pdo = seConnecter($pServeur, $pPort, $pUt, $pMDP, "");
    return $pdo;
}

function generateList($pPdo) {
    $tDBName = getBDsFromServeur($pPdo);
    $lsDBName = "";
    foreach ($tDBName as $value){
        $lsDBName .= "<li><a href=''>$value</a></li>\n";
    }
    return $lsDBName;
}

?>
