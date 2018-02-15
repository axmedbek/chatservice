<?php

require('../db/connect.php');

$data = json_decode(file_get_contents('php://input'),true);

$id = $data['id'];
$friend_id = $data['friend_id'];



$check = $user->checkRequest($id,$friend_id);

$error = array();

    if ($check) {
           $error["msg"] = "You have already invited";
        }
        else
        {
            $user->addFriend($id,$friend_id);
        }
    

  
$errors = array($error);

$result = json_encode($errors);

echo $result;
?>