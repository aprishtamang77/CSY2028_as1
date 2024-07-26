<?php
    require "header.php";
    require "db.php";

//this is to fetch category detail based on th category id
    $mysql = "SELECT * FROM category WHERE id = '{$_GET['id']}'";
    $mystatement = $db->prepare($mysql);
    $mystatement->execute();
    $mycategory = $mystatement->fetch(PDO::FETCH_ASSOC);
    //this is for fetching all the categories which is set by an admin

?>

<main>

    <h1>Category listing</h1>

    <ul class="productList">
        <?php
        //this is to fetch pro_list on the provided cat_id
            $mysql = "SELECT * FROM auction WHERE categoryId = '{$_GET['id']}' ORDER BY endDate ASC LIMIT 0, 10";
            $mystatement = $db->prepare($mysql);
            $mystatement->execute();
            $mydata = $mystatement->fetchAll(PDO::FETCH_ASSOC);
            //this is for fetching all the product list set by users
            foreach ($mydata as $myauction):
        ?>
        <li>
            <img src="car.png" alt="cars">
            <article>
                <h2><?php echo $myauction['title']; ?></h2>
                <h3><?php echo $mycategory['name']; ?></h3>
                <p><?php echo $myauction['description']; ?></p>

                <?php
                  //fetch and display bid amount
                    $mysql = "SELECT * FROM bid WHERE auctionId = '{$myauction['id']}' ORDER BY bid DESC LIMIT 1";
                    $mystatement = $db->prepare($mysql);
                    $mystatement->execute();
                    $mybid = $mystatement->fetch(PDO::FETCH_ASSOC);
                ?>
                <!-- show current bid if available, then show no bid -->
                <p class="price">Current bid: <?php echo $mybid ? '£'.$mybid['bid'] : 'No bid'; ?></p>
                <a href="auction.php?id=<?php echo $myauction['id']; ?>" class="more auctionLink">More &gt;&gt;</a>
            </article>
        </li>
        <?php endforeach; ?>
    </ul>

<!-- include footer-->
<?php require "footer.php" ?>