<?php
session_start();

require 'db.php';
//this checks the user is logged in
if(empty($_SESSION['user'])) {
    //it checks if not then goto login page
    header("Location: login.php");
} 
//it checks if the logged in user is not admin then redirect to the index page
elseif($_SESSION['user']['type'] != 'admin') {
    header("Location: index.php");
}
//this is to get the values from the form
$myid = $_POST['id'];
$myname = $_POST['name'];

$mysql = "UPDATE category SET name = '$myname' WHERE id = '$myid'";
//this is for updating category by admin
$mystatement = $db->prepare($mysql);
$mystatement->execute();

header("Location: adminCategories.php?success=Category updated");