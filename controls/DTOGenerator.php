<?php

/**
 * 
 * @param type $cnx
 * @param type $db
 * @param type $table
 */
function generateDTO($cnx, $db, $table) {

    $getter = "";
    $setter = "";
    $attributes = "";
    $content1 = "";
    $content2 = "";
    $content3 = "";

    require_once 'Metabase.php';
    require_once 'StringConversion.php';
    $filename = ucfirst($table) . "DTO.php";

    try {
        

        $column = Metabase::getColumnsNamesFromTable($cnx, $db, $table);

        $content1 .= "<?php\n\nclass " . ucfirst($table) . " {\n\n";
        $content2 .= "public function __construct(";
        $content3 .= "{\n";

        for ($i = 0; $i < count($column); $i++) {
            $attributes .= "private $" . StringConversion::camelConversion($column[$i]) . ";\n";
            //echo "<br>$attributes<br>";
            $content2 .= "$" . StringConversion::camelConversion($column[$i]) . " = '',";
            $content3 .= "$" . "this->" . StringConversion::camelConversion($column[$i]) . " = $" . StringConversion::camelConversion($column[$i]) . ";\n";

            $getter .= "public function get" . ucfirst(StringConversion::camelConversion($column[$i])) . "() {\n return $" . "this->" . StringConversion::camelConversion($column[$i]) . ";\n}\n";
            $setter .= "public function set" . ucfirst(StringConversion::camelConversion($column[$i])) . "($" . StringConversion::camelConversion($column[$i]) . ") {\n $" . "this->" . StringConversion::camelConversion($column[$i]) . ";\n}\n";
        }

        //Pour enlever la virgule lors du dernier passage
        $content2 = substr($content2, 0, -1);
        $content2 .= ")";
        $content3 .= "}\n";

        //concatenation pour avoir le DTO en entier
        $content = $content1 . $attributes . $content2 . $content3 . $getter . $setter . "}";
        //echo "<br>$content<br>";
    } catch (Exception $ex) {
        $content = $ex->getMessage();
    }
	$file = fopen($filename, 'w');
    fwrite($file, $content);
    fclose($file);

    //return $content;
}

$cnx = new PDO("mysql:host=localhost;port:8889;dbname=5Minutes", "root", "root");
$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$cnx->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
$cnx->exec("SET NAMES 'UTF8'");
$db = "5Minutes";
$table = "Article";


generateDTO($cnx, $db, $table);
?>