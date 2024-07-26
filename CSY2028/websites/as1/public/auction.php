<?php
    require "header.php";
    require "db.php";

    //this is to fetch auction detail
    $mysql = "SELECT * FROM auction WHERE id = '{$_GET['id']}'";
    $mystatement = $db->prepare($mysql);
    $mystatement->execute();
    $myauction = $mystatement->fetch(PDO::FETCH_ASSOC);

 //this is to fetch category detail
    $mysql = "SELECT * FROM category WHERE id = '{$myauction['categoryId']}'";
    $mystatement = $db->prepare($mysql);
    $mystatement->execute();
    $mycategory = $mystatement->fetch(PDO::FETCH_ASSOC);

 //this is to fetch user detail
    $mysql = "SELECT * FROM user WHERE id = '{$myauction['userId']}'";
    $mystatement = $db->prepare($mysql);
    $mystatement->execute();
    $myuser = $mystatement->fetch(PDO::FETCH_ASSOC);

     //this is to fetch latest bid detail
    $mysql = "SELECT * FROM bid WHERE auctionId = '{$myauction['id']}' ORDER BY bid DESC LIMIT 1";
    $mystatement = $db->prepare($mysql);
    $mystatement->execute();
    $mybid = $mystatement->fetch(PDO::FETCH_ASSOC);

 //this is to fetch review related to auction 
    $mysql = "SELECT * FROM review WHERE auctionId = '{$myauction['id']}' ORDER BY reviewDate DESC";
    $mystatement = $db->prepare($mysql);
    $mystatement->execute();
    $myreviews = $mystatement->fetchAll(PDO::FETCH_ASSOC);
?>
<main>
         <!--headin g--> 
    <h1>Product Page</h1>
    <article class="product">
     <!--for img --> 
        <img src="car.png" alt="cars">
        <section class="details">
     <!--dynamic call for title and name--> 
            <h2><?php echo $myauction['title']; ?></h2>
            <h3><?php echo $mycategory['name'] ?></h3>
            <p>Auction created by <a href="user.php?id=<?php echo $myuser['id'] ?>"><?php echo $myuser['name'] ?></a></p>
            <p class="price">Current bid: <?php echo $mybid ? '£'.$mybid['bid'] : 'No bid'; ?></p>
            <?php
                // Code for showing countdown https://stackoverflow.com/questions/1735252/php-countdown-to-date

                $mydate = strtotime($myauction['endDate']);
                $myremaining = $mydate - time();
                $mydays_remaining = floor($myremaining / 86400);
                $myhours_remaining = floor(($myremaining % 86400) / 3600);
                $myminutes_remaining = floor(($myremaining % 3600) / 60);
                
            ?>
            <time>Time left: <?php echo $mydays_remaining ?> days <?php echo $myhours_remaining ?> hours <?php echo $myminutes_remaining ?> minutes</time>

            <?php if(!empty($_GET['success'])): ?>
            <h3 class="success-text"><?php echo $_GET['success'] ?></h3>
            <?php endif; ?>
<?php if(!empty($_GET['success'])): ?>
            <h3 class="success-text"><?php echo $_GET['success'] ?></h3>
            <?php endif; ?>
  <!-- to display bid -->
            <?php if(!empty($_SESSION['user'])): ?>
            <form action="createBid.php" class="bid" method="post">
                <input type="hidden" name="id" value="<?php echo $myauction['id']; ?>">
                <input type="text" name="bid" placeholder="Enter bid amount" />
                <input type="submit" value="Place bid" />
            </form>
            <?php else: ?>
            <h1>Login to place bid</h1>
            <?php endif; ?>
        </section>
        <section class="description">
              <!--auction desc -->
            <p><?php echo $myauction['description'] ?></p>


        </section>

        <section class="reviews">
            <h2>Reviews of <?php echo $myuser['name'] ?> </h2>
            <ul>
                  <!-- display reivew and loop -->
                <?php foreach($myreviews as $myreview): ?>
                <?php
                            //this is for fetching and displaying reviews of product and reviewer
                    $mysql = "SELECT * FROM user WHERE id = '{$myreview['userId']}'";
                    $mystatement = $db->prepare($mysql);
                    $mystatement->execute();
                    $myreviewer = $mystatement->fetch(PDO::FETCH_ASSOC);
                ?>
                  <!-- review of contents -->
                <li><strong><?php echo $myreviewer['name'] ?> said </strong> <?php echo $myreview['reviewText'] ?> <em><?php echo date('d/m/Y', strtotime($myreview['reviewDate'])); ?></em></li>
                <?php endforeach; ?>

            </ul>

            <?php if(!empty($_SESSION['user'])): ?>
                    <!-- add review form-->
                <form action="createReview.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $myauction['id']; ?>">
                    <label>Add your review</label> <textarea name="reviewText" required></textarea>

                    <input type="submit" name="submit" value="Add Review" />
                </form>
            <?php else: ?>
              <!--show login message if user is'nt logged -->  
                <br><br>
                <h1>Login to add review</h1>
            <?php endif; ?>
        </section>
    </article>
<!-- includes footer-->
<?php require "footer.php" ?>

</main>

            <?php if(!empty($_SESSION['user'])): ?>
            <form action="createBid.php" class="bid" method="post">
                <input type="hidden" name="id" value="<?php echo $myauction['id']; ?>">
                <input type="text" name="bid" placeholder="Enter bid amount" />
                <input type="submit" value="Place bid" />
            </form>
            <?php else: ?>
            <h1>Login to place bid</h1>
            <?php endif; ?>
        </section>
        <section class="description">
            <p><?php echo $myauction['description'] ?></p>


        </section>

        <section class="reviews">
            <h2>Reviews of <?php echo $myuser['name'] ?> </h2>
            <ul>
                <?php foreach($myreviews as $myreview): ?>
                <?php
                            //this is for fetching and displaying reviews of product and reviewer
                    $mysql = "SELECT * FROM user WHERE id = '{$myreview['userId']}'";
                    $mystatement = $db->prepare($mysql);
                    $mystatement->execute();
                    $myreviewer = $mystatement->fetch(PDO::FETCH_ASSOC);
                ?>
                <li><strong><?php echo $myreviewer['name'] ?> said </strong> <?php echo $myreview['reviewText'] ?> <em><?php echo date('d/m/Y', strtotime($myreview['reviewDate'])); ?></em></li>
                <?php endforeach; ?>

            </ul>

            <?php if(!empty($_SESSION['user'])): ?>
                <form action="createReview.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $myauction['id']; ?>">
                    <label>Add your review</label> <textarea name="reviewText" required></textarea>

                    <input type="submit" name="submit" value="Add Review" />
                </form>
            <?php else: ?>
                <br><br>
                <h1>Login to add review</h1>
            <?php endif; ?>
        </section>
    </article>

<?php require "footer.php" ?>

</main>
