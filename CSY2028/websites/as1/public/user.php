<?php
    require "header.php";
    require "db.php";

//this retrives the user detail based on the id
    $mysql = "SELECT * FROM user WHERE id = '{$_GET['id']}'";
    $mystatement = $db->prepare($mysql);
    $mystatement->execute();
    $myuser = $mystatement->fetch(PDO::FETCH_ASSOC);

?>

<main>
 <!-- list of the users-->
    <h1>User listing</h1>
 <!-- list of auction products/items-->
    <ul class="productList">
        <?php
        //this is used to retrive auction which is associated with user id
            $mysql = "SELECT * FROM auction WHERE userId = '{$_GET['id']}' ORDER BY endDate ASC LIMIT 0, 10";
            $mystatement = $db->prepare($mysql);
            $mystatement->execute();
            $mydata = $mystatement->fetchAll(PDO::FETCH_ASSOC);
//looping by using foreach
            foreach ($mydata as $myauction):
        ?>
        <li>
            <!--auction img-->
            <img src="car.png" alt="cars">
            <article>
                <!--auction title-->
                <h2><?php echo $myauction['title']; ?></h2>
                <?php
                // fetch categories
                    $mysql = "SELECT * FROM category WHERE id = '{$myauction['categoryId']}'";
                    $mystatement = $db->prepare($mysql);
                    $mystatement->execute();
                    $mycategory = $mystatement->fetch(PDO::FETCH_ASSOC);
                ?>
                <!--auction category-->
                <h3><?php echo $mycategory['name']; ?></h3>
                <p><?php echo $myauction['description']; ?></p>

                <?php
   //fetching last bid
                    $mysql = "SELECT * FROM bid WHERE auctionId = '{$myauction['id']}' ORDER BY bid DESC LIMIT 1";
                    $mystatement = $db->prepare($mysql);
                    $mystatement->execute();
                    $mybid = $mystatement->fetch(PDO::FETCH_ASSOC);
                 
                ?>
                <!--bid  display-->
                <p class="price">Current bid: <?php echo $mybid ? '£'.$bid['bid'] : 'No bid'; ?></p>
                <a href="auction.php?id=<?php echo $myauction['id']; ?>" class="more auctionLink">More &gt;&gt;</a>
            </article>
        </li>
        <?php endforeach; ?>
    </ul>

<!--includes footer-->
<?php require "footer.php" ?>