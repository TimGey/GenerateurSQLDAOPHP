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



function tableau2Select($pTableau) {
    $lsContenu = "<select name='select'>\n";
    foreach ($pTableau as $value) {
        
        $lsContenu.="<option value=$value>$value</option>\n";
    }
    $lsContenu.="</select>";

    return $lsContenu;
}
