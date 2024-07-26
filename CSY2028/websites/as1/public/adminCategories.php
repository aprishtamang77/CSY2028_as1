<?php
    require "header.php";
    require "db.php";
    
    //checks users login or not  then redirect to login page
    if(empty($_SESSION['user'])) {
        header("Location: login.php");
    } 
    //check the user is regular user or not, then redirect to the index page
    elseif($_SESSION['user']['type'] == 'user') {
        header("Location: index.php");
    }
//select categories from db
    $mysql = "SELECT * FROM category";
    $mystatement = $db->prepare($mysql);
    $mystatement->execute();
    $mycategories = $mystatement->fetchAll(PDO::FETCH_ASSOC);
    // this is to retrive all the categories which is added  by admin
?>

<main>
    <h1>Category List</h1>

    <?php if(!empty($_GET['success'])): ?>
        <h3 class="success-text"><?php echo $_GET['success'] ?></h3>
    <?php endif; ?>
     <!--links addcategory.php--> 
    <a href="addCategory.php">Add Category</a>
    <br>
    <br>
    <br>
    <table>
        <thead>
                 <!--row items of table--> 
            <tr>

                <th> Category</th>
                <th> Edit/ Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($mycategories as $mycategory): ?>
            <tr>
                <td><?php echo $mycategory['name'] ?></td>
                <td>
                         <!--to edit the category--> 
                    <a href="editCategory.php?id=<?php echo $mycategory['id'] ?>">Edit</a>
                         <!--to delete the category--> 
                    <a href="deleteCategory.php?id=<?php echo $mycategory['id'] ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
     <!--includes the footer--> 
    <?php require "footer.php" ?>

</main>