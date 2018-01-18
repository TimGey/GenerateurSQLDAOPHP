<?php
require_once 'lib/Metabase.php';
require_once 'lib/Connexion.php';


$Serveur = $_SESSION["serveur"];
$Port = $_SESSION["port"];
$Ut = $_SESSION["ut"];
$MDP = $_SESSION["mdp"];

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
