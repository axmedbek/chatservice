<?php 
require('../db/connect.php');

$data = json_decode(file_get_contents('php://input'),true);

$id = $data['id'];


$mess->deleteMessage($id);





?>