<?php 

require('../db/connect.php');


$result = $mess->getAllMessage();

$data = json_encode($result);

echo $data;



?>