<?php
    require "header.php";
    require "db.php";
//redirect to the login page if the user is not logged
    if(empty($_SESSION['user'])) {
        header("Location: login.php");

    } 
    //redirect to index  if the user is not admin
    elseif($_SESSION['user']['type'] != 'admin') {
        header("Location: index.php");
    }
?>

<main>
    <h1>Add Category</h1>
        <!--this form is to add category by admin -->
    <form action="storeCategory.php" method="post">
        <label>Category</label>
             <!--input for category--> 
        <input type="text" name="name" required />
        <input type="submit" value="Submit" />

    </form>
     <!--includes footer--> 
    <?php require "footer.php" ?>

</main>