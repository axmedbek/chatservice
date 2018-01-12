<?php  
require('db/connect.php');

$user->logout();
header('Location:login.php?msg=logout');
exit;


?>