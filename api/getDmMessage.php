<?php

require('../db/connect.php');

$data = json_decode(file_get_contents('php://input'),true);

$id = $data['id'];
$fid = $data['fid'];

$result = $mess->getDmMessage($id,$fid);

echo json_encode($result);




?>