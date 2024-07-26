<?php
session_start();

require 'db.php';
//this checks the user is not logged in 
if(empty($_SESSION['user'])) {
    header("Location: login.php");
}
//this is to check if the user logged in is not type of admin then goto index page
elseif($_SESSION['user']['type'] != 'admin') {
    header("Location: index.php");
}
//get  category id to be deleted
$myid = $_GET['id'];
// this is to delete the category rec from db based on the id
$mysql = "DELETE FROM category WHERE id = '$myid'";

$mystatement = $db->prepare($mysql);
$mystatement->execute();
//redirect to adminCategories.php with success msg
header("Location: adminCategories.php?success=Category deleted");