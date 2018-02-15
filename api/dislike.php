<?php


require('../db/connect.php');

$data = json_decode(file_get_contents('php://input'),true);


$id  = $data['id'];
$message_id = $data['message_id'];


$mess->dislike($id,$message_id);








?>