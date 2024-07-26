<?php
    require "header.php";
    require "db.php";
//this checks the user is not logged in
    if(empty($_SESSION['user'])) {
        header("Location: login.php");
    }
    //checks if user in not type of admin , them redirect to index
    elseif($_SESSION['user']['type'] != 'admin') {
        header("Location: index.php");
    }
//this selects data form the db based on the id
    $mysql = "SELECT * FROM category WHERE id = '{$_GET['id']}'";
    $mystatement = $db->prepare($mysql);
    $mystatement->execute();
    $mycategory = $mystatement->fetch(PDO::FETCH_ASSOC);
    //fetch all the category which has been added by admin
?>

<main>
        <!--heading -->
    <h1>Edit Category</h1>
   <!--update category with detail form -->
    <form action="updateCategory.php" method="post">
           <!-- Hidden input field-->
        <input type="hidden" name="id" value="<?php echo $mycategory['id'] ?>">
        <label>Category</label> <input type="text" name="name" value="<?php echo $category['name'] ?>" required />
            <!-- submit button-->
        <input type="submit" value="Submit" />

    </form>

    <?php require "footer.php" ?>

</main>