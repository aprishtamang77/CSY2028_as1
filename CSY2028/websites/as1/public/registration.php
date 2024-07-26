<?php
session_start();

require 'db.php';
//this retrives data from registration form
$myname = $_POST['name'];
$myemail = $_POST['email'];
$mypassword = sha1($_POST['password']);//using sha1

$mysql = "INSERT INTO user SET name = '$myname', email = '$myemail', password = '$mypassword', type = 'user'";
//for insert registered data to db

//prepare andf execute
$mystatement = $db->prepare($mysql);
$mystatement->execute();

//this is for redirect to reg page with a success msg 
header("Location: register.php?success=Registration successful");