<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>liste des nom de colonnes</title>
    </head>
    <body>

        <form method="POST">
            <?php
            require_once './controls/SelectTablesName.php';
            ?>
            <?php
            $tNameTables = getTablesFromBD($cnx, $dbNAme);
            $lscontenu = tableau2Select($tNameTables);

            print $lscontenu;
            ?>
            <button type="submit" value="1" name="btValider">Valider</button>
        </form>
    </body>
</html>
