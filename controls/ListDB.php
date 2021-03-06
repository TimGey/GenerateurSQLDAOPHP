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
    $lsDBName = "<div class=\"list-group\">\n";
    foreach ($tDBName as $value) {
        if ($value != "information_schema" && $value != "mysql" && $value != "performance_schema" && $value != "sys" && $value != "cdcol" && $value != "phpmyadmin" && $value != "test")
            $lsDBName .= "<a href='index.php?dbName=$value' class=\"list-group-item list-group-item-action\">$value</a>\n";
    }
    $lsDBName .= "</div>";

    return $lsDBName;
}

?>
