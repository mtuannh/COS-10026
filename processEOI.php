<?php include_once 'header.inc'; ?>
<body>
    <h1 class="slider-confirm"><a href="index.php">EOI Confirmation</a></h1>

    <?php
    function sanitise_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data; 
    }
    require_once("validation.php");
    require_once("settings.php");

    $conn = mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    mysqli_select_db($conn,$sql_db);

// This function ensures all data should be sanitized to remove leading and trailing spaces, backslashes, and HTML control characters.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["jrn"])) {
        echo "<p>Please enter Job Reference Number!</p><br>";
        exit;
    } else {
        $job_reference_number = sanitise_input($_POST["jrn"]);
        // check if name only contains letters and whitespace
        if (!preg_match('/^[a-zA-Z0-9]{5}$/',$job_reference_number)) {
        echo "<p>Only 5 digits allowed</p><br>";
        exit;
        }
    }
    
    if (empty($_POST["first_name"])) {
        echo "<p>Please enter your first name!</p><br>";
        exit;
    } else {
        $first_name = sanitise_input($_POST["first_name"]);
        // check if name only contains letters and whitespace
        if (!preg_match('/^[a-zA-Z ]{1,20}$/',$first_name)) {
        echo "<p>Only letters and white space allowed, 20 characters maximum!</p><br>";
        exit;
        }
    }

    if (empty($_POST["last_name"])) {
        echo "<p>Please enter your last name!</p><br>";
        exit;
    } else {
        $last_name = sanitise_input($_POST["last_name"]);
        // check if name only contains letters and whitespace
        if (!preg_match('/^[a-zA-Z ]{1,20}$/',$last_name)) {
        echo "<p>Only letters and white space allowed, 20 characters maximum!</p><br>";
        exit;
        }
    }

    if (isset($_POST["dob"])) {
        $date_of_birth = sanitise_input($_POST["dob"]);
    } else {
        echo "Invalid date of birth";
        exit;
    }
    
    if (isset($_POST["gender"])) {
        $gender = sanitise_input($_POST["gender"]);
    } else {
        echo "Please select gender";
        exit;
    }

    if (empty($_POST["street_address"])) {
        echo "<p>Please enter your address!</p><br>";
        exit;
    } else {
        $street_address = sanitise_input($_POST["street_address"]);
        // check if name only contains letters and whitespace
        if (!preg_match('/^[a-zA-Z0-9, ]{1,40}$/',$street_address)) {
        echo "<p>(Address) No include any special characters, 40 characters maximum!</p><br>";
        exit;
        }
    }

    if (empty($_POST["suburb_town"])) {
        echo "<p>Please enter your suburb/town!</p><br>";
        exit;
    } else {
        $suburb_town = sanitise_input($_POST["suburb_town"]);
        // check if name only contains letters and whitespace
        if (!preg_match('/^[a-zA-Z0-9, ]{1,40}$/',$suburb_town)) {
        echo "<p>(Suburb/town) No include any special characters, 40 characters maximum!</p><br>";
        exit;
        }
    }
    
    if (isset($_POST["state"])) {
        $state = sanitise_input($_POST["state"]);
    } else {
        echo "Invalid state";
        exit;
    }
    
    if (empty($_POST["postcode"])) {
        echo "<p>Please enter your postcode!</p><br>";
        exit;
    } else {
        $postcode = sanitise_input($_POST["postcode"]);
        // check if name only contains letters and whitespace
        if (!preg_match('/^\d{4}$/',$postcode)) {
        echo "<p>Invalid postcode!</p><br>";
        exit;
        }
    }
    
    if (empty($_POST["email"])) {
        echo "<p>Please enter your email!</p><br>";
        exit;
    } else {
        $email = sanitise_input($_POST["email"]);
        // check if name only contains letters and whitespace
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p>Invalid email format!</p><br>";
        exit;
        }
    }
    
    if (empty($_POST["phone"])) {
        echo "<p>Please enter your phone number!</p><br>";
        exit;
    } else {
        $phone_number = sanitise_input($_POST["phone"]);
        // check if name only contains letters and whitespace
        if (!preg_match('/^\d{8,12}$/', $phone_number)) {
        echo "<p>Invalid phone number format!</p><br>";
        exit;
        }
    }

    if (isset($_POST["skill"]) && is_array($_POST["skill"])) {
        $skills = implode(", ", $_POST["skill"]); 
    } else {
        $skills = ""; 
    }

    if (isset($_POST["other_skills"])) {
        $otherskills = sanitise_input($_POST["other_skills"]);
    } else {
        $otherSkills = "";
    }

    $postcodestate = array (
        "3000" => "VIC",
        "2000" => "NSW",
        "4000" => "QLD",
        "0800" => "NT",
        "6000" => "WA",
        "5000" => "SA",
        "7000" => "TAS",
        "2600" => "ACT",  
      );
    
    if (isset($state) && isset($postcode)) {
        $Postcode = sanitise_input($postcode);
        $Postcode = str_pad($Postcode, 4, "0", STR_PAD_LEFT); // this pads the postcode with leading zeros if necessary
        
    if (!isset($postcodestate[$Postcode])) {
        echo "<p>Invalid postcode.</p>";
        exit;
    } else if ($postcodestate[$Postcode] !== $state) {
        echo "<p>The selected state does not match the entered postcode.</p>";
        exit;    
    }

    }

    $createTableQuery = "CREATE TABLE IF NOT EXISTS eoi (
        EOInumber INT AUTO_INCREMENT PRIMARY KEY,
        `job_reference_number` VARCHAR(20),
        `first_Name` VARCHAR(30),
        `last_Name` VARCHAR(30),
        `date_of_birth` VARCHAR(30),
        `gender` VARCHAR(10),
        `street_address` VARCHAR(100),
        `suburb_town` VARCHAR(50),
        `state` VARCHAR(20),
        `postcode` VARCHAR(10),
        `email` VARCHAR(50),
        `phone_number` VARCHAR(20),
        `skills` VARCHAR(255),
        `otherSkills` TEXT,
        status ENUM('New', 'Current', 'Final') DEFAULT 'New'
    
    )";
        mysqli_query($conn, $createTableQuery);

        $query = "INSERT INTO eoi (
            job_reference_number, 
            first_name, 
            last_name, 
            date_of_birth, 
            gender, 
            street_address, 
            suburb_town, 
            state, 
            postcode, 
            email, 
            phone_number, 
            skills, 
            otherskills
        ) VALUES (
            '$job_reference_number', 
            '$first_name', 
            '$last_name',
            '$date_of_birth', 
            '$gender', 
            '$street_address', 
            '$suburb_town', 
            '$state', 
            '$postcode', 
            '$email', 
            '$phone_number', 
            '$skills', 
            '$otherskills'
        )";
        
        $result = mysqli_query($conn, $query);	
        $tableEOI ="<details id='summary-confirm'><summary id='button-confirm'>Click to review your apply!</summary>
        <table id='table-confirm'>
        <tr>
            <th colspan='2'>Applicant information</th>
        </tr>
        <tr>
            <td>Job reference number</td>
            <td>$job_reference_number</td>
        </tr>
        <tr>
            <td>First name</td>
            <td>$first_name</td>
        </tr>
        <tr>
            <td>Last name</td>
            <td>$last_name</td>
        </tr>
        <tr>
            <td>Date of birth</td>
            <td>$date_of_birth</td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>$gender</td>
        </tr>
        <tr>
            <td>Street Address</td>
            <td>$street_address</td>
        </tr>
        <tr>
            <td>Suburb/town</td>
            <td>$suburb_town</td>
        </tr>
        <tr>
            <td>State</td>
            <td>$state</td>
        </tr>
        <tr>
            <td>Postcode</td>
            <td>$postcode</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>$email</td>
        </tr>
        <tr>
            <td>Phone</td>
            <td>$phone_number</td>
        </tr>
        <tr>
            <td>Skills</td>
            <td>$skills</td>
        </tr>
        <tr>
            <td>Other skills</td>
            <td>$otherskills</td>
        </tr>
        </table>
        </details>";

        if ($result){
            $id = mysqli_insert_id($conn); // Get the ID from the database
	        echo "
            <div id='output-noti'>
                <div class='tick-pic'>
                    <img src='images/greentick.png' alt=''>
                </div><br>
                <p><strong>Data inserted successfully!</strong></p>
                <p>EOI ID: <strong>$id</strong></p>
	        </div>";

            echo $tableEOI;

        } else {
            echo "<p>Error: " . mysqli_error($conn) . "</p>";
        }

        mysqli_close($conn);
        
        } else {
            echo "
            <div id='output-noti'>
                <div class='tick-pic'>
                    <img src='images/redtick.png' alt=''>
                </div><br><br>
                <p><strong>Form not submitted!</strong></p>
            </div>";
        }
?>
</body>
</html>
