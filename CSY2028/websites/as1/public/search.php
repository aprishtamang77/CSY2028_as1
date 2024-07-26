<?php
    require "header.php";
    require "db.php";
?>

<main>

    <h1>Search Results</h1>
    <!-- list of search items -->
    <ul class="productList">
        <?php
        //query to search for products based on the search  provided by the user
            $mysql = "SELECT * FROM auction WHERE title LIKE '%{$_GET['search']}%' ORDER BY endDate ASC LIMIT 0, 10";
            $mystatement = $db->prepare($mysql);
            $mystatement->execute();
            $mydata = $mystatement->fetchAll(PDO::FETCH_ASSOC);

//loop through each item
            foreach ($mydata as $myauction):
        ?>
        <li>
            <img src="car.png" alt="cars">
            <article>
                    <!--auction pro detail-->
                <h2><?php echo $myauction['title']; ?></h2>
                <?php
                // fetch category name 
                    $mysql = "SELECT * FROM category WHERE id = '{$myauction['categoryId']}'";
                    $mystatement = $db->prepare($mysql);
                    $mystatement->execute();
                    $mycategory = $mystatement->fetch(PDO::FETCH_ASSOC);
                ?>
                  <!-- display category name -->
                <h3><?php echo $mycategory['name']; ?></h3>
                    <!--display auction description -->
                <p><?php echo $myauction['description']; ?></p>

                <?php
                      //fetch the highest bid
                    $mysql = "SELECT * FROM bid WHERE auctionId = '{$myauction['id']}' ORDER BY bid DESC LIMIT 1";
                    $mystatement = $db->prepare($mysql);
                    $mystatement->execute();
                    $mybid = $mystatement->fetch(PDO::FETCH_ASSOC);
                ?>
                 <!-- for the current bid or no bid -->
                <p class="price">Current bid: <?php echo $mybid ? '£'.$mybid['bid'] : 'No bid'; ?></p>
                 <!-- for detail of auction -->
                <a href="auction.php?id=<?php echo $myauction['id']; ?>" class="more auctionLink">More &gt;&gt;</a>
            </article>
        </li>
        <?php endforeach; ?>
    </ul>
 <!-- inlcudes footer-->

<?php require "footer.php" ?>