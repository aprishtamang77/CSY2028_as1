<?php
    require "header.php";
    require "db.php";
//check if the user is not logged in
    if(empty($_SESSION['user'])) {
        header("Location: login.php");
    } 
    //this is to check logged in but not of type admin
    elseif($_SESSION['user']['type'] != 'admin') {
        header("Location: index.php");
    }
    //this is to select form db based on the id 
    $mysql = "SELECT * FROM user WHERE id = '{$_GET['id']}' AND type = 'admin'";
    $mystatement = $db->prepare($mysql);
    $mystatement->execute();
    $myadmin = $mystatement->fetch(PDO::FETCH_ASSOC);
    //this for fetching the admin data and info
?>

<main>
    <h1>Edit Category</h1>
<!--form for editing admin info-->
    <form action="updateAdmin.php" method="post">
        <!--dynamic call for the values -->
        <input type="hidden" name="id" value="<?php echo $myadmin['id'] ?>">
        <label>Name</label> <input type="text" name="name" value="<?php echo $myadmin['name'] ?>" required />
        <label>Email</label> <input type="email" name="email" value="<?php echo $myadmin['email'] ?>" required />
        <!-- submit inputfield for button -->
        <input type="submit" value="Submit" />

    </form>

    <?php require "footer.php" ?>

</main>