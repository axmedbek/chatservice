<?php 

require('../db/connect.php');

$data = json_decode(file_get_contents('php://input'),true);

$id = $data['id'];

$message = array();
$lastp = md5($data['lastp']);

$newp = md5($data['newp']);
if(empty($lastp)){
   
}
if(empty($newp)){
    
}
else{
    $result = $user->passChange($id,$lastp,$newp);
    
    if ($result) {
        $message['message'] = "Password is changed successfullyy";
        $message['info'] = true;
        $message['icon'] = "success";
    }
    else{
        $message['message'] = "Ooops.Password couldn't change";
        $message['info'] = false;
        $message['icon']="error";
    }

    

}


$messages = array($message);


echo json_encode($messages);





?>