<!DOCTYPE html>
<html lang="en">

<?php $title = "Records";
include('header.inc'); ?>

<body>
<div id = "slider-manage">
    <div id = "header-manage">
      <p1><a href="index.php"><strong>INDINAM COMPANY</strong></a></p1>
      <p2>For Human Resources</p2>
    </div>
    <?php
    require_once("settings.php");

    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$conn) {
        echo "<p>Database connection failed!</p>";
    } else {
        function sanitise_input($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
        // Function to display EOIs in a table
        function ListAllData($result) {
            if (mysqli_num_rows($result) >0) {
                echo "<table border='1' class='manage-table'>";
                echo "<tr>";
                echo "<th>EOI Number</th>";
                echo "<th>Job Reference Number</th>";
                echo "<th>First Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Date Of Birth</th>";
                echo "<th>Gender</th>";
                echo "<th>Street Address</th>";
                echo "<th>Suburb/Town</th>";
                echo "<th>State</th>";
                echo "<th>Postcode</th>";
                echo "<th>Email Address</th>";
                echo "<th>Phone Number</th>";
                echo "<th>Skills</th>";
                echo "<th>Other Skills Description</th>";
                echo "<th>Status</th>";
                echo "</tr>";
                
                
                while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['EOInumber']) . "</td>";
                echo "<td>" . htmlspecialchars($row['job_reference_number']) . "</td>";
                echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['date_of_birth']) . "</td>";
                echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                echo "<td>" . htmlspecialchars($row['street_address']) . "</td>";
                echo "<td>" . htmlspecialchars($row['suburb_town']) . "</td>";
                echo "<td>" . htmlspecialchars($row['state']) . "</td>";
                echo "<td>" . htmlspecialchars($row['postcode']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['phone_number']) . "</td>";
                echo "<td>" . htmlspecialchars($row['skills']) . "</td>";
                echo "<td>" . htmlspecialchars($row['otherskills']) . "</td>";
                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                echo "</tr>";
              }
              echo "</table>";
            } else {
              echo "No data found in the database.";
            }
          }
          
        $sortField = isset($_POST['sort_field']) ? sanitise_input($_POST['sort_field']) : 'EOInumber';

        function listAndSortEOIs($conn, $query, $sortField, $title) {
            $result = mysqli_query($conn, $query);
            echo "<h2>$title (Sorted by $sortField)</h2>";
            ListAllData($result);
            echo "<div class='manage-button-list'>
                    <a href='manage.php'>Go Back</a>
                </div>";
        }

        // Check if a specific action was submitted
        if (isset($_POST['action'])) {
            $action = sanitise_input($_POST['action']);

            if ($action === 'listall') {
                $query = "SELECT * FROM eoi";
                $result = mysqli_query($conn, $query) 
                or die("<p>Failed to execute query!</p>");
                listAndSortEOIs($conn, $query, $sortField, "List of All EOIs");

            } elseif ($action === 'listbyjobref') {
                $jobReference = sanitise_input($_POST['job_reference']);
                $query = "SELECT * FROM eoi WHERE job_reference_number = '$jobReference'";
                $result = mysqli_query($conn, $query);
                listAndSortEOIs($conn, $query, $sortField, "<h2>EOIs for Job Reference: $jobReference</h2>");

            } elseif ($action === 'listbyname') {
                $firstName = sanitise_input($_POST['first_name']);
                $lastName = sanitise_input($_POST['last_name']);
                $query = "SELECT * FROM eoi WHERE first_name = '$firstName' OR last_name = '$lastName'";
                $result = mysqli_query($conn, $query);
                listAndSortEOIs($conn, $query, $sortField, "<h2>EOIs for Applicant: $firstName $lastName</h2>");

            } elseif ($action === 'deletebyjobref') {
                $jobReference = sanitise_input($_POST['job_reference']);
                $deleteQuery = "DELETE FROM eoi WHERE job_reference_number = '$jobReference'";
                $deleteResult = mysqli_query($conn, $deleteQuery);

                if ($deleteResult) {
                    echo "
                    <div id='user-noti'>
                        <p>EOIs with job reference number $jobReference deleted successfully!</p>
                        <div class='manage-button'>
                            <a href='manage.php'>Go Back</a>
                        </div>
                    </div>";
                } else {
                    echo "
                    <div id='user-noti'>
                        <p>Error deleting EOIs with job reference number $jobReference!</p>
                        <div class='manage-button'>
                            <a href='manage.php'>Go Back</a>
                        </div>
                    </div>";
                }
            } elseif ($action === 'changestatus') {
                
                $newStatus = sanitise_input($_POST['update_status']);
                $eoi_num = sanitise_input($_POST['EOInumber']);
                
                $update = "UPDATE eoi SET status = '$newStatus' WHERE EOInumber = $eoi_num";
                $Result = mysqli_query($conn, $update);

                if ($Result) {
                    echo "
                    <div id='user-noti'>
                        <p>EOI status updated successfully!</p>
                        <div class='manage-button'>
                        <a href='manage.php'>Go Back</a>
                        </div>
                    </div>";
                } else {
                    echo "<div id='user-noti'>
                    <p>Error updating EOI status!</p>
                    <div class='manage-button'>
                    <a href='manage.php'>Go Back</a>
                    </div>
                </div>";
                }
            }
        }
        mysqli_close($conn);
    }
    ?>
</div>
</body>
</html>
<!--
https://www.w3schools.com/php/php_variables.asp
https://www.w3schools.com/php/php_functions.asp
https://www.w3schools.com/php/php_if_else.asp
https://www.tutorialspoint.com/php/php_functions.htm-->
