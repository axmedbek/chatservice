<?php 


require('../db/connect.php');

$data = json_decode(file_get_contents('php://input'),true);


$text = $data['text'];
$tarix = $data['tarix'];
$user_id = $data['user_id'];

$mess->addMess($text,$tarix,$user_id);





?>