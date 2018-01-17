<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Générateur de DAO</title>
    </head>
    <body>
        <form method="post">
            <label for="nomConnexion">Nom de la connexion :</label>
            <input type="text" name="nomConnexion" value="nomConnexion" />
            <br />
            <label for="serveur">Serveur :</label>
            <input type="text" name="serveur" value="localhost" />
            <br />
            <label for="port">Port :</label>
            <input type="text" name="port" value="3306" />
            <br />
            <label for="username">Username :</label>
            <input type="text" name="username" value="root" />
            <br />
            <label for="mdp">Mot de passe :</label>
            <input type="text" name="mdp" value="" />
            <br />
            <button type="submit" value="1" name="btConnexion">Valider</button>
        </form>
        <div>
            <ul>
                <?php
                $cnx;
                require_once 'controls/listDB.php';
                $NAme = filter_input(INPUT_GET, "dbName");

                if ($NAme != null) {

                    $pServeur = $_SESSION["serveur"];
                    $pPort = $_SESSION["port"];
                    $pUt = $_SESSION["ut"];
                    $pMDP = $_SESSION["mdp"];
                } else {


                    $pServeur = filter_input(INPUT_POST, "serveur");
                    $pPort = filter_input(INPUT_POST, "port");
                    $pUt = filter_input(INPUT_POST, "username");
                    $pMDP = filter_input(INPUT_POST, "mdp");
                }

                $btConnexion = filter_input(INPUT_POST, "btConnexion");



                if ($btConnexion != null || $NAme != null) {

                    $cnx = formToSession($pServeur, $pPort, $pUt, $pMDP, "");

                    if ($cnx != null) {
                        $lsContenu = generateList($cnx);
                    } else {
                        echo "KO";
                    }
                    print $lsContenu;
                }
                ?>
            </ul>
        </div>
        <div>
            <form method="get">
                <?php
                require_once './controls/SelectTablesName.php';
                ?>
                <?php
                if ($dbNAme != null) {
                    $tNameTables = getTablesFromBD($cnx, $dbNAme);
                    $lscontenu = tableau2Select($tNameTables, $dbNAme);

                    print $lscontenu;
                }
                ?>
                <button type="submit" value="1" name="btGenerate">Générer DAO</button>

                <?php
                /**
                 * ici on fera l'incrémentation dans un .php
                 */
                require_once 'controls/ControleurRecupColonnes.php';
                require_once 'controls/Table2Str.php';

                $btGenerate = filter_input(INPUT_GET, "btGenerate");

                if ($btGenerate != null) {
                    $bd = filter_input(INPUT_GET, "dbName");
                    $table = filter_input(INPUT_GET, "select");
                    $test = tableauStructureTable($cnx, $bd, $table);

                    $testDAO = tBD2Str($test, $table);
                    
                    print nl2br($testDAO) ;
                }
                ?>

            </form>
        </div>
    </body>
</html>
