<?php
    require "header.php";
    require "db.php";
?>
<main>
    <h1>User Login</h1>
  <!-- this is to display the error msg -->
    <?php if(!empty($_GET['error'])): ?>
    <h3 class="error-text"><?php echo $_GET['error'] ?></h3>
    <?php endif; ?>
    <!--create from login-check.php -->
    <form action="login-check.php" method="post">
        <label>Email</label> <input type="email" name="email" required />
        <label>Password</label> <input type="password" name="password" required />
        <input type="submit" value="Submit" />

    </form>
     <!-- for Admin Login section -->
    <h1>Admin Login</h1>
  <!-- this is to display the error msg -->
    <?php if(!empty($_GET['error'])): ?>
          <!--error message  -->

    <h3 class="error-text"><?php echo $_GET['error'] ?></h3>
    <?php endif; ?>
 <!--form for admin login -->
    <form action="login-check.php" method="post">
        <label>Email</label> <input type="email" name="email" required />
        <label>Password</label> <input type="password" name="password" required />
        <input type="submit" value="Submit" />

    </form>

 <!--include footer-->
<?php require "footer.php" ?>
</main>

