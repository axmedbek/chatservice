<?php

require('../db/connect.php');

$data = json_decode(file_get_contents('php://input'),true);

$id = $data['id'];
$fid = $data['fid'];
$message = $data['message'];
$date = $data['date'];

if($id && $date && $fid && $message){
    $mess->dmMessageAdd($id,$fid,$message,$date);
}






?>