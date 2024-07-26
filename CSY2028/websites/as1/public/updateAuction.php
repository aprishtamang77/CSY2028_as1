<?php
session_start();

require 'db.php';
//this checks either user is logged in 
if(empty($_SESSION['user'])) {
    //this is for if not then goto login
    header("Location: login.php");
} 
//this is for if not a user then goto index
elseif($_SESSION['user']['type'] != 'user') {
    header("Location: index.php");
}
//this is to get values from the form
$myid = $_POST['id'];
$mytitle = $_POST['title'];
$mydescription = $_POST['description'];
$mycategoryId = $_POST['categoryId'];
$myuserId = $_SESSION['user']['id'];
$myendDate = date('Y-m-d H:i:s', strtotime($_POST['endDate']));

//this checks the image upload and handle them
if(!empty($_FILES['image']) && $_FILES['image']['error'] == 0) {
    //this generates unique name for the img
    $myimageName = time().'.'.$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], 'public/images/auctions/'.$myimageName);
    //this condition checks the previous image and delete them
    if(!empty($_POST['imageName'])) {
        @unlink('public/images/auctions/'.$_POST['imageName']);
    }
} else {
    //this holds the existing img name
    $myimageName = $_POST['imageName'];
}

$mysql = "UPDATE auction SET title = '$mytitle', description = '$mydescription', categoryId = '$mycategoryId', image = '$myimageName', userId = '$myuserId', endDate = '$myendDate' WHERE id = '$myid'";
//this is for fetching updated auction data
$mystatement = $db->prepare($mysql);
$mystatement->execute();

header("Location: userAuctions.php?success=Auction updated");