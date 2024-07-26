<?php
session_start();

require 'db.php';
//this redirects to login page
if(empty($_SESSION['user'])) {
    header("Location: login.php");
} 
//this redirects non_admin user to index
elseif($_SESSION['user']['type'] != 'admin') {
    header("Location: index.php");
}
//retrieve admin data 
$myname = $_POST['name'];
$myemail = $_POST['email'];
$mypassword = sha1($_POST['password']);

//insert the admin data in db
$mysql = "INSERT INTO user SET name = '$myname', email = '$myemail', password = '$mypassword', type = 'admin'";
//prepare and execute
$mystatement = $db->prepare($mysql);
$mystatement->execute();
//redirect to manageAdmins.php with success msg
header("Location: manageAdmins.php?success=Admin added");