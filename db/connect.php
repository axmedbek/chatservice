<?php
ob_start();
session_start();
// XAMPP - username: root
// XAMPP - pass:

$db = new PDO("mysql:host=localhost:3306;dbname=messaging", "root", "");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

include('user.php');
include('mess.php');


$mess = new Mess($db);
$user = new User($db);