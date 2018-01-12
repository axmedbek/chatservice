<?php 

require('../db/connect.php');


$result = $user->getAllUsers();

$data = json_encode($result);

echo $data;




?>