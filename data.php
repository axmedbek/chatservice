<?php 

// $user = array("name"=>"Ahmad","surname"=>"Mammadli","age"=>20);

// $users = array($user,$user,$user);

require('db/connect.php');

$result=$user->getAllUsers();

$datalar = json_encode($result);

echo $datalar;

?>