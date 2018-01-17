<?php
/**
 * Str2FilePhp.php
 */

/**
 * 
 * @param type $pstr
 * @param type $ptableName
 * @return type
 */
function str2FilePhp($pstr, $ptableName){
    
   $int= file_put_contents("./conf/".$ptableName."DAO.php", $pstr);
   
   return $int;
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

