<?php


require_once("../db/connect.php");


$data = json_decode(file_get_contents('php://input'),true);

$id = $data['id'];
$game_id = $data['game_id'];


$result = $user->getUserPoint($id,$game_id);


echo json_encode($result);



?>