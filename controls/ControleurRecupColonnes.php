<?php

require_once '../lib/Metabase.php';

function test(PDO $pdo, $psBD, $psTable) {
    $tNameColumns = getColumnsNamesFromTable($pdo, $psBD, $psTable);
    $tNameColumnsNN = getColumnsNamesNullableFromTable($pdo, $psBD, $psTable);
    $tNameColumnsPK = getColumnsNamesPKFromTable($pdo, $psBD, $psTable);


    $tColonnesTable = array();
    foreach ($tNameColumns as $value) {
        $tligne = array();
        foreach ($tNameColumnsNN as $nonNull) {
            if ($value == $nonNull) {
                $tligne["nomTable"] = $value;
                $tligne["nonNull"]= true;
            } else {
                $tligne["nomTable"] = $value;
            }
        }
        foreach ($tNameColumnsPK as $pk) {
            if ($value == $pk) {
              $tligne["PK"]= true;
            }
        }
        array_push($tColonnesTable, $tligne);
    }
    return $tColonnesTable;
}

/**
 * test
 */
//$lcnx = new PDO("mysql:host=localhost;port=3306", "root", "");
//$lcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$lcnx->exec("SET NAMES 'UTF8'");
//
//print_r(test($lcnx, "cours", "clients"));