<?php

require('../db/connect.php');


$data = json_decode(file_get_contents('php://input'),true);

$id = $data['id'];

$result = $user->blockList($id);

echo json_encode($result);



?>