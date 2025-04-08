<?php
session_start();
    require_once ("settings.php");	//connection info
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
    $table = "admin";
    // Checks if connection is successful
    if (!$conn) {
        die("Database connection failed!");		//connection failed
    } else {
        if ((isset($_POST["user_name"])) and (isset($_POST["password"]))) {
            function sanitise_input($input) {
                $input = trim($input);
                $input = stripslashes($input);
                $input = htmlspecialchars($input);
                return $input;
            }
        }
    }
    $name = sanitise_input($_POST["user_name"]);
    $pwd  = sanitise_input($_POST["password"]);
    $sql = "SELECT * FROM $table WHERE user_name = '$name' AND password = '$pwd'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if ($row["user_name"] === $name and $row["password"] === $pwd) {
            $_SESSION['loggedin'] = 1;
            header("Location: manage.php");
            exit;
        } else {
            header("Location: login.php?error");
            exit;
        }
    } else {
        header("Location: login.php?error");
        exit;
    }
?>

<!--https://devnetwork.net/viewtopic.php?t=135287
https://www.linkedin.com/advice/0/what-steps-creating-php-login-form-skills-web-development-eww7c#:~:text=For%20a%20PHP%20login%20form%2C%20create%20an%20HTML%20form%20element,with%20type%3D%22submit%22.-->