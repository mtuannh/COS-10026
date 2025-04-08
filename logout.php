<?php 
session_start();
session_unset();
session_destroy();
header("Location: login.php");
?>

<!--https://devnetwork.net/viewtopic.php?t=135287
https://www.linkedin.com/advice/0/what-steps-creating-php-login-form-skills-web-development-eww7c#:~:text=For%20a%20PHP%20login%20form%2C%20create%20an%20HTML%20form%20element,with%20type%3D%22submit%22.
https://www.quora.com/How-do-you-create-a-logout-button-using-PHP-->