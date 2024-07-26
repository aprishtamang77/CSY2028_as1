<?php
    require "header.php";
    require "db.php";
//this checks the suer is not logged in 
    if(empty($_SESSION['user'])) {
        header("Location: login.php");
    } 
    //this checks if the logged in is not type of user then redirect to the index page  
    elseif($_SESSION['user']['type'] != 'user') {
        header("Location: index.php");
    }
//this is to select the data from db based on the id
    $mysql = "SELECT * FROM auction WHERE id = '{$_GET['id']}'";
    $mystatement = $db->prepare($mysql);
    $mystatement->execute();
    $myauction = $mystatement->fetch(PDO::FETCH_ASSOC);

    //this is to select all categories added by the admin from the db
    $mysql = "SELECT * FROM category";
    $mystatement = $db->prepare($mysql);
    $mystatement->execute();
    $mycategories = $mystatement->fetchAll(PDO::FETCH_ASSOC);
    //fetch all category which has been added by admin
?>

<main>
    <h1>Edit Auction</h1>
   <!--form for editing auction info-->
    <form action="updateAuction.php" method="post" enctype="multipart/form-data">
          <!-- to pass the auctionid-->
        <input type="hidden" name="id" value="<?php echo $myauction['id']; ?>">
         <!-- to pass the image-->
        <input type="hidden" name="imageName" value="<?php echo $myauction['image']; ?>">
        <!--the auction title -->
        <label>Title</label> <input type="text" name="title" value="<?php echo $myauction['title']; ?>" required />
        <!--the auction desc -->
        <label>Description</label> <textarea name="description" required><?php echo $myauction['description']; ?></textarea>
         <!-- dropdow for the auction category -->
        <label>Category</label> <select name="categoryId" required>
            <?php foreach($mycategories as $mycategory): ?>
                 <!-- Option with the category name and id -->
            <option value="<?php echo $mycategory['id'] ?>" <?php echo $mycategory['id'] == $myauction['categoryId'] ? 'selected' : '' ?>><?php echo $mycategory['name']; ?></option>
            <?php endforeach; ?>
        </select>
          <!--field for  end date-->
        <label>End Date</label> <input type="datetime-local" name="endDate" value="<?php echo date('Y-m-d\TH:i', strtotime($myauction['endDate'])); ?>" required />
        <label>Image</label> <input type="file" name="image" accept="image/*" />
        <input type="submit" value="Submit" />

    </form>

    <?php require "footer.php" ?>

</main>