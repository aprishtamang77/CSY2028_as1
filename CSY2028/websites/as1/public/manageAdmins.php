<?php
    require "header.php";
    require "db.php";
//this redirects to login page if the user is not logged  in
    if(empty($_SESSION['user'])) {
        header("Location: login.php");
    } elseif($_SESSION['user']['type'] == 'user') {
        //redirect user to index
        header("Location: index.php");
    }
//fetch all admin data to the current user
    $mysql = "SELECT * FROM user WHERE type = 'admin' AND id != '{$_SESSION['user']['id']}'";
    $mystatement = $db->prepare($mysql);
    $mystatement->execute();
    $myadmins = $mystatement->fetchAll(PDO::FETCH_ASSOC);

?>

<main>
    <h1>Admin List</h1>
    <!-- display success message -->
    <?php if(!empty($_GET['success'])): ?>
        <h3 class="success-text"><?php echo $_GET['success'] ?></h3>
    <?php endif; ?>
  <!-- this links to add admin -->
    <a href="addAdmin.php">Add Admin</a>
    <br>
    <br>
    <br>
       <!--table to display the all admins  -->
    <table>
        <thead>
            <tr>
                <th> Admin </th>
                <th> Email </th>
                <th> Edit/Delete </th>
            </tr>
        </thead>
        <tbody>
             <!--looping of admin and display their info-->
            <?php foreach($myadmins as $myadmin): ?>
            <tr>
                <td><?php echo $myadmin['name'] ?></td>
                <td><?php echo $myadmin['email'] ?></td>
                <td>
                      <!-- link to edit and delete admin  -->
                    <a href="editAdmin.php?id=<?php echo $myadmin['id'] ?>">Edit</a>
                    <a href="deleteAdmin.php?id=<?php echo $myadmin['id'] ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
 <!--incluide footer-->
    <?php require "footer.php" ?>

</main>