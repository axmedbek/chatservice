<?php 
require('db/connect.php');
require('message.php');


 if(!$user->checkLogin())
 {
 	header("Location:login.php");
 	exit;
 }


 $id = $user->getIDwithSession();
 $users = $user->getAllUsers($id);
 ?>
<!DOCTYPE html>
<html ng-app="chatApp">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chat Service</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body ng-controller="ChatController" >
<div class="container">
 	<div class="row">

	