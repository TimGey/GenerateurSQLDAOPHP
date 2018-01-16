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
                
                $btConnexion = filter_input(INPUT_POST, "btConnexion");
                $pServeur = filter_input(INPUT_POST, "serveur");
                $pPort = filter_input(INPUT_POST, "port");
                $pUt = filter_input(INPUT_POST, "username");
                $pMDP = filter_input(INPUT_POST, "mdp");

                if ($btConnexion != null) {
                    $cnx = formToSession($pServeur, $pPort, $pUt, $pMDP , "");

                    if ($cnx != null){
                        $lsContenu = generateList($cnx);
                    } else {
                        echo "KO";
                    }
                    

                    print $lsContenu;
                }
                ?>
            </ul>
        </div>
    </body>
</html>
