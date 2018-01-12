<?php

require('../db/connect.php');

$data = json_decode(file_get_contents('php://input'),true);

$id = $data['id'];
$friend_id = $data['friend_id'];

$user->addFriend($id,$friend_id);



?>