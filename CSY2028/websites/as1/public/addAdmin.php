<?php
//this to include the header.php file 
    require "header.php";
    //this to include the db.php which is the database
    require "db.php";
    if(empty($_SESSION['user'])) {
        header("login.php");
    } 
    //look the user is not admin
    elseif($_SESSION['user']['type'] != 'admin') { 
       //goto index if not admin
        header("index.php");
    }
?>

<main>
    <h1>Add Admin</h1>

    <!-- new admin form-->
    <form action="storeAdmin.php" method="post">
      <!--this is a label for the name--> 
    <label>Name</label> 
    <!-- input field-->
    <input type="text" name="name" required />
        <label>Email</label> 
             <!--this is a label for the email--> 
        <input type="email" name="email" required />
        <label>Password</label>
             <!--this is a label for the password--> 
         <input type="password" name="password" required />
              <!--this is for button--> 
        <input type="submit" value="Submit" />

    </form>
     <!--it includes footer--> 
    <?php require "footer.php" ?>

</main>