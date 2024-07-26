<?php
session_start();

require 'db.php';
//this checks user is logged_in or not ,then redirect them to the login page
if(empty($_SESSION['user'])) {
    header("Location: login.php");
} 
//this checks the logged_in user , redirect to the index page
elseif($_SESSION['user']['type'] != 'user') {
    header("Location: index.php");
}
//this is to get auction id from form, get review text from form and get user id form the session
$myid = $_POST['id']; 
$myreviewText = $_POST['reviewText'];
$myuserId = $_SESSION['user']['id'];
//insert the reviews into the db
$mysql = "INSERT INTO review SET auctionId = '$myid', userId = '$myuserId', reviewText = '$myreviewText', reviewDate = NOW()";
// it includes  the auction ID, the user ID, the review text, and the current date and time as values which is to be inserted


$mystatement = $db->prepare($mysql);//prepare the statement
$mystatement->execute();// this executes statement to review info into db

header("Location: auction.php?id=$myid&success=Review added");// this redirects user with msg after review has been added successfully