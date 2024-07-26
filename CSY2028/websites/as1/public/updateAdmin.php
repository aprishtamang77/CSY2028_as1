<?php
session_start();

require 'db.php';
//this checks if the user is logged in 
if(empty($_SESSION['user'])) {
    //this is for if not logged in then redirect to the login
    header("Location: login.php");
}
//this is for if not logged in then redirect to the index
elseif($_SESSION['user']['type'] != 'admin') {
    header("Location: index.php");
}

//this is to get values from the form
$myid = $_POST['id'];
$myname = $_POST['name'];
$myemail = $_POST['email'];

//this query to update the info
$mysql = "UPDATE user SET name = '$myname', email = '$myemail' WHERE id = '$myid'";
//prepare and execute
$mystatement = $db->prepare($mysql);
$mystatement->execute();
// this redirects to the manageAdmins page
header("Location: manageAdmins.php?success=Admin updated");