<?php
    require "header.php";
    require "db.php";
?>

<main>

    <h1>Latest Listings</h1>
    <!--these are the list of my  products -->
    <ul class="productList">
        <?php

            //fetch  latest 10 auction products form db added by user, limit is kept 10 to fetch 10 products as per the requirement
            $mysql = "SELECT * FROM auction ORDER BY endDate ASC LIMIT 0, 10";
            $mystatement = $db->prepare($mysql);
            $mystatement->execute();
            $mydata = $mystatement->fetchAll(PDO::FETCH_ASSOC);
            

            foreach ($mydata as $myauction):
        ?>
        <li>
        <img src="car.png" alt="cars">
            <article>
              <!-- auction pro_details-->
                <h2><?php echo $myauction['title']; ?></h2>
                <?php
                     //this fetches category name for the current auction product list
                    $mysql = "SELECT * FROM category WHERE id = '{$myauction['categoryId']}'";
                    $mystatement = $db->prepare($mysql);
                    $mystatement->execute();
                    $mycategory = $mystatement->fetch(PDO::FETCH_ASSOC);
                ?>
                <h3><?php echo $mycategory['name']; ?></h3>
                <p><?php echo $myauction['description']; ?></p>

                <?php
                //fetch the largest bid
                    $mysql = "SELECT * FROM bid WHERE auctionId = '{$myauction['id']}' ORDER BY bid DESC LIMIT 1";
                    $mystatement = $db->prepare($mysql);
                    $mystatement->execute();
                    $mybid = $mystatement->fetch(PDO::FETCH_ASSOC);
                ?>
                <!-- for displaying current bid or no bid  -->
                <p class="price">Current bid: <?php echo $mybid ? '£'.$mybid['bid'] : 'No bid'; ?></p>
                <a href="auction.php?id=<?php echo $myauction['id']; ?>" class="more auctionLink">More &gt;&gt;</a>
            </article>
        </li>
        <?php endforeach; ?>
    </ul>

  <!--include footer-->
<?php require "footer.php" ?>
</main>
