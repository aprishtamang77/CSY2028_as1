<?php
    require "header.php";
    require "db.php";
         //checks whethere the user is logged in or not, if not admin then the code is acceseed to index pa
    if(empty($_SESSION['user'])) {
        header("Location: login.php");
    } elseif($_SESSION['user']['type'] != 'user') {
        header("Location: index.php");
    }

    $mysql = "SELECT * FROM category";
    $mystatement = $db->prepare($mysql);
    $mystatement->execute();
    $mycategories = $mystatement->fetchAll(PDO::FETCH_ASSOC);
    //it fetches categories 
?>

<main>

    <h1>Add Auction</h1>
<!--this is form to add auctions  -->
    <form action="storeAuction.php" method="post" enctype="multipart/form-data">
        <label>Title</label>
             <!--input filed for title--> 
         <input type="text" name="title" required />
        <label>Description</label>
             <!--here is the desc area--> 
         <textarea name="description" required></textarea>
        <label>Category</label>
             <!--here is a dropdown--> 
         <select name="categoryId" required>
            <?php foreach($mycategories as $mycategory): ?>
            <option value="<?php echo $mycategory['id'] ?>"><?php echo $mycategory['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <label>End Date</label> 
             <!--dateandtime--> 
        <input type="datetime-local" name="endDate" required />
        <label>Image</label> <input type="file" name="image" accept="image/*" />

         <!--button--> 
        <input type="submit" value="Submit" />

    </form>
     <!--includes footer.php--> 
    <?php require "footer.php" ?>

</main>