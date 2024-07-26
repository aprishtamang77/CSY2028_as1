<?php
session_start();

require 'db.php';
//this redirects to login if user is not logged in
if(empty($_SESSION['user'])) {
    header("Location: login.php");
} 
//this redirect non_user type to indeex
elseif($_SESSION['user']['type'] != 'user') {
    header("Location: index.php");
}
//retrieve auction data
$mytitle = $_POST['title'];
$mydescription = $_POST['description'];
$mycategoryId = $_POST['categoryId'];
$myuserId = $_SESSION['user']['id'];
$myendDate = date('Y-m-d H:i:s', strtotime($_POST['endDate']));

//check if image is uploaded and processed
if(!empty($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $myimageName = time().'.'.$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], 'public/images/auctions/'.$myimageName);
} else {
    $myimageName = null;//set it to null in img is not uploaded
}
//insert auction data
$mysql = "INSERT INTO auction SET title = '$mytitle', description = '$mydescription', categoryId = '$mycategoryId', image = '$myimageName', userId = '$myuserId', endDate = '$myendDate'";
//prepare and execute
$mystatement = $db->prepare($mysql);
$mystatement->execute();
//redirect to the userAuctions.php
header("Location: userAuctions.php?success=Auction added");