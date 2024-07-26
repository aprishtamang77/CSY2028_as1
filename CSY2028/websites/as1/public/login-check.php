<?php
session_start();

require 'db.php';

$myemail = $_POST['email'];
$mypassword = sha1($_POST['password']);
//using sha1 function password hashing is done here

$mysql = "SELECT * FROM user WHERE email='$myemail' AND password='$mypassword'";

$mystatement = $db->prepare($mysql); // prepare query
$mystatement->execute();//the prepared query to be executed
$myuser = $mystatement->fetch(PDO::FETCH_ASSOC);//fetch data as associative array

if($myuser) {
    $_SESSION['user'] = $myuser; // store data in session only of user

    if($myuser['type'] == 'admin') {// detect user or admin
        header("Location: adminCategories.php");//goto admin cat pages
    } else {
        header("Location: userAuctions.php");//goto user auc pg
    }
} else {
    header("Location: login.php?error=Incorrect email or password");//goto login with error
}