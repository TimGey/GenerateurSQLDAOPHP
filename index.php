<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Générateur de DAO</title>
        <link rel="stylesheet" type="text/css" href="./css/bootstrapCss/bootstrap.css">
        <link rel='stylesheet' type="text/css" href="lib/ui/jquery-ui.min.css">
    </head>
    <body>
        <div class="row">
            <form method="post" class="col-md-4">
                <div class="form-group">

                    <div class="form-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Nom de la connexion :</span>
                        </div>
                        <input class="form-control" aria-label="Small"  type="text" name="nomConnexion" value="nomConnexion" />
                    </div>

                    <div class="form-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Serveur :</span>
                        </div>
                        <input class="form-control" type="text" name="serveur" value="localhost" />
                    </div>

                    <div class="form-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Port :</span>
                        </div>
                        <input class="form-control" type="text" name="port" value="3306" />
                    </div>

                    <div class="form-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Username :</span>
                        </div>
                        <input class="form-control" type="text" name="username" value="root" />
                    </div>

                    <div class="form-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Mot de passe :</span>
                        </div>
                        <input class="form-control" type="text" name="mdp" value="" />
                    </div>

                    <button class="btn btn-primary btn-sm" type="submit" value="1" name="btConnexion">Valider</button>
                </div>
            </form>

            <div class="col-4">
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
            </div>
        </div>

        <div>
            <form method="get">

                <?php
                $dbNAme = filter_input(INPUT_GET, "dbName");
                if ($dbNAme != null) {
                    require_once 'controls/SelectTablesName.php';
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
                require_once 'controls/Str2FilePhp.php';

                $btGenerate = filter_input(INPUT_GET, "btGenerate");

                if ($btGenerate != null) {
                    $bd = filter_input(INPUT_GET, "dbName");
                    $table = filter_input(INPUT_GET, "select");
                    $tColonnes = tableauStructureTable($cnx, $bd, $table);

                    $strDAO = tBD2Str($tColonnes, $table);

                    $int = str2FilePhp($strDAO, $table);

                    if ($int) {
                        echo "<br/>Création d'un fichier $table" . "DAO.php dans le dossier \"conf\" ";
                    } else {
                        echo "<br/>Création échouée";
                    }
                }
                ?>

            </form>
        </div>
        <script src="lib/ui/external/jquery/jquery.js"></script>
        <script src="lib/ui/jquery-ui.min.js"></script>
    </body>
</html>
