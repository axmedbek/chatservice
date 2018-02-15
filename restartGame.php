<?php

require('db/connect.php');
ob_start();
session_start();

$id = $user->getIDwithSession();
$u = $user->getUserByID($id);

$mapUserFile = "db/".$u['username'].".txt";


unset($_SESSION['userScore'],$_SESSION['healthYours'],$_SESSION['healthEnemy']);


$map  = file('db/map.txt');

   $fOpen = fopen($mapUserFile,'w+');
    for ($i=0; $i < 11 ; $i++) { 
        for ($j=0; $j < 17; $j++) {  
           
            fwrite($fOpen,$map[$i][$j]);
            
        }
        fwrite($fOpen,"\n");
    }
    fclose($fOpen);

header("Location:combat.php");
exit;




?>