<!DOCTYPE html>
<html lang = "en">

<?php $title = "Login";
include('header.inc'); ?>

<body>
  <div id = "slider-login">
    <div id = "header-manage">
      <p1><a href="index.php"><strong>INDINAM COMPANY</strong></a></p1>
      <p2>For Human Resources</p2>
    </div>
    <div class = "login-box">
      <p>Login</p>
      <form method = "post" action = "login_process.php">
        <?php if (isset($_GET['error'])) {
          echo $_GET['error'] . "<p class='wrong-notify'>Incorrect username or password!</p><br>";
          }
        ?>
        <div class = "user-box">
          <input type = "text" name = "user_name" class = "form-control" placeholder=" " required>
          <label for = "user_name">Username</label>
        </div>
        <div class = "user-box">
          <input type = "password" name = "password" class = "form-control" placeholder=" " required>
          <label for = "password">Password</label>
        </div>
        <button type = "submit" class = "sign-in">Sign in</button>
      </form>
      <p>
        Username: 104527639<br>
        Password: thisisassignment2
      </p>
    </div>
  </div>
</body>
</html>