<?php
session_start();

require 'db.php';
//session check
if(empty($_SESSION['user'])) {
    header("Location: login.php");
}
//check the logged_in is user not an admin
elseif($_SESSION['user']['type'] != 'admin') {
    header("Location: index.php");
}

$myid = $_GET['id']; //get the user id which is to be deleted for the URL

$mysql = "DELETE FROM user WHERE id = '$myid'"; //THIS IS A QUERY TO DELETE ADMIN USER 

$mystatement = $db->prepare($mysql);//prepare statement
$mystatement->execute();//this is to execute statement to delete the admin user

//this is for success msg and redirect
header("Location: manageAdmins.php?success=Admin deleted");