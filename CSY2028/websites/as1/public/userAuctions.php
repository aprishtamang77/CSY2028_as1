<?php
    require "header.php";
    require "db.php";
//thies checks the user is logged in 
    if(empty($_SESSION['user'])) {
        //this checks if not loggeg then goto login page
        header("Location: login.php");
    } 
    //this checks if the logged in user is not regular then rediret to the index
    elseif($_SESSION['user']['type'] != 'user') {
        header("Location: index.php");
    }
//this will retrieve auctions which has been added by the users
    $mysql = "SELECT * FROM auction WHERE userId = '{$_SESSION['user']['id']}'";
    $mystatement = $db->prepare($mysql);
    $mystatement->execute();
    $myautions = $mystatement->fetchAll(PDO::FETCH_ASSOC);
    //this is for fetching all the auction products which is added by user in a table
?>

<main>
    <h1>Auction List</h1>

    <?php if(!empty($_GET['success'])): ?>
        <!--this is to display success-->
        <h3 class="success-text"><?php echo $_GET['success'] ?></h3>
    <?php endif; ?>
<!--this is link to add new auction -->
    <a href="addAuction.php">Add Auction</a>
    <br>
    <br>
    <br>
    <table>
        <thead>
            <!--for the add auction headings-->
            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Description</th>
                <th>Category</th>
                <th>End Date</th>
                <th>Edit/Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($myautions as $myauction): ?>
            <tr>
                <!-- it shows auction details-->
                <td><?php echo $myauction['title'] ?></td>
                <td><img src="<?php echo $myauction['image'] ? "public/images/auctions{$myauction['image']}" : "car.png" ?>"></td>
                <td><?php echo $myauction['description'] ?></td>
                <?php
                //this is to retrieve cat_details for the auction-->
                    $mysql = "SELECT * FROM category WHERE id = '{$myauction['categoryId']}'";
                    $mystatement = $db->prepare($mysql);
                    $mystatement->execute();
                    $mycategory = $mystatement->fetch(PDO::FETCH_ASSOC);
                ?>
                <!--shows the auction cat-->
                <td><?php echo $mycategory['name'] ?></td>
                <td><?php echo $myauction['endDate'] ?></td>

                <td>
                    <!--edit and delete auction-->
                    <a href="editAuction.php?id=<?php echo $myauction['id'] ?>">Edit</a>
                    <a href="deleteAuction.php?id=<?php echo $myauction['id'] ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<!--lncludes footer-->
    <?php require "footer.php" ?>

</main>