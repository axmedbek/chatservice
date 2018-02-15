<?php 
require('connect.php');

if(isset($_GET['email']) && isset($_GET['activation'])){

    $email = $_GET['email'];
    $activation = $_GET['activation'];

    $result = $user->accountActivation($email,$activation);

    if($result){
        header("Location:../login.php?msg=completeReg");
        exit;
    }
    else{
        header("Location:../login.php?msg=errorReg");
        exit;
    }
}
else{
    header("Location:../login.php");
    exit;
}



?>