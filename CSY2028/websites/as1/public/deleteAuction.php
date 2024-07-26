<?php
session_start();

require 'db.php';
//this checks the user is not logged in 
if(empty($_SESSION['user'])) {
    header("Location: login.php");
}
//this checks the logged in is not of type user, then redirect to the index page
elseif($_SESSION['user']['type'] != 'user') {
    header("Location: index.php");
}
//this is to get id form the auction to be deleted, select the img associated with auction from db 
$myid = $_GET['id'];
$mysql = "SELECT image FROM auction WHERE id = '$myid'";
$mystatement = $db->prepare($mysql);
$mystatement->execute();
$myauction = $mystatement->fetch(PDO::FETCH_ASSOC);
//variable $auction may contain the image data associated with the provided ID from the auction table


//this the images if there is then delete for the server
if(!empty($myauction['image'])) {
    @unlink('public/images/auctions/' . $myauction['image']);
}
//this is to delete the auction record
$mysql = "DELETE FROM auction WHERE id = '$myid'";

$mystatement = $db->prepare($mysql);
$mystatement->execute();
//redirect to userAuctions.php with a success msg
header("Location: userAuctions.php?success=Auction deleted");