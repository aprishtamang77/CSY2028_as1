<?php
session_start();

require 'db.php';
//this redirects to login if user is not logged
if(empty($_SESSION['user'])) {
    header("Location: login.php");
} 
//this redirects non admin user to index
elseif($_SESSION['user']['type'] != 'admin') {
    header("Location: index.php");
}
//this retrives category name form the form
$myname = $_POST['name'];

//insert category as per the question by admin
$mysql = "INSERT INTO category SET name = '$myname'";

//prepare and execute
$mystatement = $db->prepare($mysql);
$mystatement->execute();

//redirect with a success msg
header("Location: adminCategories.php?success=Category added");