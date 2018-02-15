<?php 

require_once("../db/connect.php");


$data = json_decode(file_get_contents('php://input'),true);


$id = $data['id'];

$score = $data['score'];


$user->addPoint(16,2,50);





?>