<?php


require('../db/connect.php');

$data = json_decode(file_get_contents('php://input'),true);


$message_id = $data['message_id'];

$likes = $mess->getLikes($message_id);
$dislikes = $mess->getDislikes($message_id);

$result = array("likes"=>$likes,"dislikes"=>$dislikes);


echo json_encode($result);








?>