<?php

require_once 'lib/Metabase.php';
require_once 'lib/Connexion.php';


$Serveur = $_SESSION["serveur"];
$Port = $_SESSION["port"];
$Ut = $_SESSION["ut"];
$MDP = $_SESSION["mdp"];

$cnx = seConnecter($Serveur, $Port, $Ut, $MDP, $dbNAme);

function tableau2Select($pTableau, $pdbName) {
    $lsContenu = "<div class=\"input-group mb-3\">\n";
    $lsContenu.="<div class=\"input-group-prepend\">\n";
    $lsContenu.="<label class=\"input-group-text\" for=\"select\">Tables</label>\n";
    $lsContenu.="</div>";
    $lsContenu.= "<select class=\"custom-select\" name='select'>\n";
    foreach ($pTableau as $value) {

        $lsContenu.="<option value=$value>$value</option>\n";
    }
    $lsContenu.="</select>\n";
    $lsContenu.="<input type='hidden' name='dbName' value='$pdbName'></input>\n";


    return $lsContenu;
}
