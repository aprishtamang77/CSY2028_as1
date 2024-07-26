<?php
    require "header.php";
    require "db.php";
?>
<main>
    <h1>Register</h1>
 <!-- error message -->
    <?php if(!empty($_GET['error'])): ?>
    <h3 class="error-text"><?php echo $_GET['error'] ?></h3>
    <?php endif; ?>
      <!--success message-->
    <?php if(!empty($_GET['success'])): ?>
        <h3 class="success-text"><?php echo $_GET['success'] ?></h3>
    <?php endif; ?>
     
    <!--this is to register for the new users -->
    <form action="registration.php" method="post">
         <!-- label and input field -->
        <label>Name</label> <input type="text" name="name" required />
        <label>Email</label> <input type="email" name="email" required />
        <label>Password</label> <input type="password" name="password" required />
        <!--this for button -->
        <input type="submit" value="Submit" />

    </form>
 <!--includes footer-->
<?php require "footer.php" ?>
</main>
