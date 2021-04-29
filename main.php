<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function counter($dir)

{ 

   $handle = opendir($dir); 

   $nbLines = 0; 

   while( ($file = readdir($handle)) != false ) 

   { 

      if( $file != "." && $file != "..") 

      { 

         if( !is_dir($dir."/".$file) ) 

         { 

            if( preg_match("#\.(php|html|txt)$#", $file) ) 

            { 

                $nb = count(file($dir."/".$file)); 

    print($dir."/".$file." => <strong>".$nb."</strong><br />\n"); 

                $nbLines += $nb; 

            } 

         } 

         else 

         { 

            $nbLines += counter($dir."/".$file); 

         } 

      } 

    } 

   closedir($handle); 

   return $nbLines; 

} 

// dossier à parcourir 

// '.' signifie que je parcours le dossier où se trouve mon script 

$dir = "."; 

$nb = counter($dir);

print("<br />Le projet comporte un total de <strong>".$nb."</strong> lignes<br />\n");


?>
