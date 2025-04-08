<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== 1) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
<meta name="description" content="Assignment 2" /> 
<meta name="keywords" content="PHP, Mysql" /> 
<title>INDINAM HR MANAGEMENT</title> 
<link href="styles/style.css" rel="stylesheet"/>
</head> 

<body>
    <div id = "header-manage">
        <p1><a href=" "><strong>INDINAM COMPANY</strong></a></p1>
        <p2>For Human Resources</p2>
    </div>

    <div id = "slider-manage">     
        <h1>EOI Management</h1><br>

        <h4>List all EOIs</h4>
        <form action="processManage.php" method="post">
        <input type="hidden" name="action" value="listall">
        <input type="submit" value="List All EOIs">
        </form>
        <br>
        <hr>
        <br>
        <h4>List EOIs by Job Reference Number</h4>
        <form action="processManage.php" method="post">
        <input type="hidden" name="action" value="listbyjobref">
        <label for="job_reference">Job Reference Number:</label>
        <input type="text" id="job_reference" name="job_reference">
        <input type="submit" value="List EOIs">
        </form>
        <br>
        <hr>
        <br>
        <h4>List EOIs by Applicant Name</h4>
        <form action="processManage.php" method="post">
        <input type="hidden" name="action" value="listbyname">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name">
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name">
        <input type="submit" value="List EOIs">
        </form>
        <br>
        <hr>
        <br>
        <h4>Delete EOIs by Job Reference Number</h4>
        <form action="processManage.php" method="post">
        <input type="hidden" name="action" value="deletebyjobref">
        <label for="job_reference_delete">Job Reference Number:</label>
        <input type="text" id="job_reference_delete" name="job_reference">
        <input type="submit" value="Delete">
        </form>
        <br>
        <hr>
        <br>
        <h4>Change EOI Status</h4>
        <form action="processManage.php" method="post">
        <input type="hidden" name="action" value="changestatus">
        <label for="EOInumber">EOI ID:</label>
        <input type="text" id="EOInumber" name="EOInumber">
        <label for="update_status">New Status:</label>

        <select name="update_status" id="update_status">
            <option value="New" selected="selected">New</option>
            <option value="Current">Current</option>
            <option value="Final">Final</option>
        </select>

        <input type="submit" value="Update">
        </form>
    	<h2 class='logout'><a href='logout.php'>Logout</a></h2>

    </div>
    <?php include_once 'footer.inc'; ?>
</body> 
</html>