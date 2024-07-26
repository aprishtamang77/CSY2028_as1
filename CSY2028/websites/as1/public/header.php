<?php
    session_start();
    require "db.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Carbuy Auctions</title>
		<link rel="stylesheet" href="carbuy.css" />
	</head>

	<body>
        
    <div class="login-profile" style="text-align: right; 
	width: 100%;">
    <?php if(!empty($_SESSION['user'])): ?>
           <!-- is shows the user name after loggedin-->
        <span><?php echo $_SESSION['user']['name']; ?></span>
        <?php if($_SESSION['user']['type'] == 'admin'): ?>
            <!--admin seperate link if user is an admin -->
        <a href="adminCategories.php"style="	border: 2px solid black; padding:5px;">Categories</a>
        <a href="manageAdmins.php"style="	border: 2px solid black; padding:5px;">Admins</a>
        <?php else: ?>
              <!--user seperate link if user is not admin -->
        <a href="userAuctions.php"style="	border: 2px solid black; padding:5px;">Auctions</a>
        <?php endif; ?>
          <!-- for log out -->
        <a href="logout.php" style="	border: 2px solid black; padding:5px;">Logout</a>
    <?php else: ?>
          <!-- login and reg links for new users -->
        <a href="login.php" style="	border: 2px solid black; padding:5px;">Log In</a>
        <a href="register.php" style="	border: 2px solid black; padding:5px;">Register</a>
    <?php endif; ?>
</div>
		<header>
			<h1><span class="C">C</span>
 			<span class="a">a</span>
			<span class="r">r</span>
			<span class="b">b</span>
			<span class="u">u</span>
			<span class="y">y</span></h1>

			<form action="search.php">
				<input type="text" name="search" placeholder="Search for a car" />
				<input type="submit" name="submit" value="Search" />
			</form>
		</header>

		<nav>
		<ul>
        <?php
         //fetch all the category added by admin form db
            $mysql = "SELECT * FROM category";
            $mystatement = $db->prepare($mysql);
            $mystatement->execute();
            $mydata = $mystatement->fetchAll(PDO::FETCH_ASSOC);
        //run loop for each
            foreach ($mydata as $mycategory):
        ?>
        <li><a class="categoryLink" href="category.php?id=<?php echo $mycategory['id']; ?>"><?php echo $mycategory['name']; ?></a></li>
        <?php endforeach; ?>
    </ul>
		</nav>
		<img src="banners/1.jpg" alt="Banner" />


