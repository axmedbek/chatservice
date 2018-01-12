<?php

require('db/connect.php');

$data = json_decode(file_get_contents('php://input'),true);

$username = $data['username'];
$email = $data['email'];
$password =md5($data['password']);

$user->register($username,$email,$password);

?>