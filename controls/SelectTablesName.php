<?php
require_once 'lib/Metabase.php';
require_once 'lib/Connexion.php';
//session_start();

//$variable = $_SESSION["variable"];
$Serveur = $_SESSION["serveur"];
$Port = $_SESSION["port"];
$Ut = $_SESSION["ut"];
$MDP = $_SESSION["mdp"];
$dbNAme = filter_input(INPUT_GET, "dbName");

$cnx = seConnecter($Serveur, $Port, $Ut, $MDP, $dbNAme);



function tableau2Select($pTableau , $pdbName) {
    $lsContenu = "<select name='select'>\n";
    foreach ($pTableau as $value) {
        
        $lsContenu.="<option value=$value>$value</option>\n";
    }
    $lsContenu.="</select>\n";
    $lsContenu.="<input type='hidden' name='dbName' value='$pdbName'></input>\n";
    

    return $lsContenu;
}
