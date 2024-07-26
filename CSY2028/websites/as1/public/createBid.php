<?php
session_start();

require 'db.php';
//code for checking where user has logged in or not, then redirect them to the login page
if(empty($_SESSION['user'])) {
    header("Location: login.php");
} 
//this is to check the logged_in user is regular or not, then redirect to the index page
elseif($_SESSION['user']['type'] != 'user') {
    header("Location: index.php");
}
//this is to get auction id from the form bid amount and user id for the session
$myid = $_POST['id'];
$mybid = $_POST['bid'];
$myuserId = $_SESSION['user']['id'];

$mysql = "INSERT INTO bid SET auctionId = '$myid', userId = '$myuserId', bid = '$mybid'";
//this includes auction ID, user ID, and  bid amount as values whoich is to be inserted.
$mystatement = $db->prepare($mysql); //this prepare the sql statement
$mystatement->execute();// here executes the statement to insert bid info into db

header("Location: auction.php?id=$myid&success=Bid added");//this is for the success msg sfter bid has been placed