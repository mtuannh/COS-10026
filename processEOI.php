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
    require_once("settings.php");

    $conn = mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    mysqli_select_db($conn,$sql_db);

// This function ensures all data should be sanitized to remove leading and trailing spaces, backslashes, and HTML control characters.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["jrn"])) {
        echo "
        <div id='user-noti'>
            <p>Please enter Job Reference Number!</p>
            <div class='manage-button'>
                <a href='apply.php'>Go Back</a>
            </div>
        </div>";
        exit;
    } else {
        $job_reference_number = sanitise_input($_POST["jrn"]);
        // check if name only contains letters and whitespace
        if (!preg_match('/^[a-zA-Z0-9]{5}$/',$job_reference_number)) {
        echo "
        <div id='user-noti'>
            <p>Only 5 digits allowed!</p>
            <div class='manage-button'>
                <a href='apply.php'>Go Back</a>
            </div>
        </div>";
        exit;
        }
    }
    
    if (empty($_POST["first_name"])) {
        echo "
        <div id='user-noti'>
            <p>Please enter your first name!</p>
            <div class='manage-button'>
                <a href='apply.php'>Go Back</a>
            </div>
        </div>";
        exit;
    } else {
        $first_name = sanitise_input($_POST["first_name"]);
        // check if name only contains letters and whitespace
        if (!preg_match('/^[a-zA-Z ]{1,20}$/',$first_name)) {
            echo "
            <div id='user-noti'>
                <p>Only letters and white space allowed, 20 characters maximum!</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>";
        exit;
        }
    }

    if (empty($_POST["last_name"])) {
        echo "
            <div id='user-noti'>
                <p>Please enter your last name!</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>";
        exit;
    } else {
        $last_name = sanitise_input($_POST["last_name"]);
        // check if name only contains letters and whitespace
        if (!preg_match('/^[a-zA-Z ]{1,20}$/',$last_name)) {
            echo "
            <div id='user-noti'>
                <p>Only letters and white space allowed, 20 characters maximum!</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>";
            exit;
        }
    }

    $birthDateTime = DateTime::createFromFormat('d/m/Y', ($_POST['dob']));
    $birthdate = sanitise_input($_POST['dob']);

    if (!$birthDateTime || $birthDateTime->format('d/m/Y') !== $birthdate) {
        die("
            <div id='user-noti'>
                <p>Invalid date of birth format<br>(dd/mm/YYYY)!</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>"
        );
    }

    $currentDate = new DateTime();
    $age = $currentDate->diff($birthDateTime)->y;

    if ($age < 15 || $age > 80) {
        die("
        <div id='user-noti'>
                <p>Invalid age range.<br>You must from 15 to 80 years old!</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>"
        );
    }

    if (isset($_POST["gender"])) {
        $gender = sanitise_input($_POST["gender"]);
    } else {
        echo "
            <div id='user-noti'>
                <p>Please select gender</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>";
        exit;
    }

    if (empty($_POST["street_address"])) {
        echo "
            <div id='user-noti'>
                <p>Please enter your address!</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>";
        exit;
    } else {
        $street_address = sanitise_input($_POST["street_address"]);
        // check if name only contains letters and whitespace
        if (!preg_match('/^[a-zA-Z0-9, ]{1,40}$/',$street_address)) {
            echo "
            <div id='user-noti'>
                <p>(Address) No include any special characters, 40 characters maximum!</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>";
        exit;
        }
    }

    if (empty($_POST["suburb_town"])) {
        echo "
            <div id='user-noti'>
                <p>Please enter your suburb/town!</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>";
        exit;
    } else {
        $suburb_town = sanitise_input($_POST["suburb_town"]);
        // check if name only contains letters and whitespace
        if (!preg_match('/^[a-zA-Z0-9, ]{1,40}$/',$suburb_town)) {
            echo "
            <div id='user-noti'>
                <p>(Suburb/town) No include any special characters, 40 characters maximum!</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>";
        exit;
        }
    }
    
    if (isset($_POST["state"])) {
        $state = sanitise_input($_POST["state"]);
    } else {
        echo "
            <div id='user-noti'>
                <p>Invalid state</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>";
        exit;
    }
    
    if (empty($_POST["postcode"])) {
        echo "
            <div id='user-noti'>
                <p>Please enter your postcode!</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>";
        exit;
    } else {
        $postcode = sanitise_input($_POST["postcode"]);
        // check if name only contains letters and whitespace
        if (!preg_match('/^\d{4}$/',$postcode)) {
            echo "
            <div id='user-noti'>
                <p>Invalid postcode!</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>";
        exit;
        }
    }
    
    if (empty($_POST["email"])) {
        echo "
            <div id='user-noti'>
                <p>Please enter your email!</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>";
        exit;
    } else {
        $email = sanitise_input($_POST["email"]);
        // check if name only contains letters and whitespace
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "
            <div id='user-noti'>
                <p>Invalid email format!</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>";
        exit;
        }
    }
    
    if (empty($_POST["phone"])) {
        echo "
            <div id='user-noti'>
                <p>Please enter your phone number!</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>";
        exit;
    } else {
        $phone_number = sanitise_input($_POST["phone"]);
        // check if name only contains letters and whitespace
        if (!preg_match('/^\d{8,12}$/', $phone_number)) {
            echo "
            <div id='user-noti'>
                <p>Invalid phone number format!</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>";
        exit;
        }
    }

    if (!isset($_POST["skill"])) {
        echo "
            <div id='user-noti'>
                <p>Please select your skills.</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>";
        exit;
    } 

    $skill = array (
        "Front-end Developer",
        "Back-end Developer",
        "Full Stack Developer",
        "Other skills...",
    );
    
    if (isset($_POST["skill"]) && is_array($_POST["skill"])) {
        $skills = implode(", ", $_POST["skill"]); 
    } else {
        $skills = ""; 
    }
    
    if (in_array("Other skills...", $skill) && in_array("Other skills...", $_POST["skill"]) && empty($_POST["other_skills"])) {
        echo "
            <div id='user-noti'>
                <p>Please enter information about other skills.</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>";
        exit;
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
    if (!isset($postcodestate[$Postcode])) {
        echo "
            <div id='user-noti'>
                <p>Invalid postcode.</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>";
        exit;
    } else if ($postcodestate[$Postcode] !== $state) {
        echo "
            <div id='user-noti'>
                <p>The selected state does not match the entered postcode.</p>
                <div class='manage-button'>
                    <a href='apply.php'>Go Back</a>
                </div>
            </div>";
        exit;    
    }

    }

    $createTableQuery = "CREATE TABLE IF NOT EXISTS eoi (
        EOInumber INT AUTO_INCREMENT PRIMARY KEY,
        `job_reference_number` VARCHAR(20) NOT NULL,
        `first_Name` VARCHAR(30) NOT NULL,
        `last_Name` VARCHAR(30) NOT NULL,
        `date_of_birth` VARCHAR(30) NOT NULL,
        `gender` VARCHAR(10) NOT NULL,
        `street_address` VARCHAR(100) NULL,
        `suburb_town` VARCHAR(50) NULL,
        `state` VARCHAR(20) NOT NULL,
        `postcode` VARCHAR(10) NOT NULL,
        `email` VARCHAR(50) NULL,
        `phone_number` VARCHAR(20) NULL,
        `skills` VARCHAR(255) NOT NULL,
        `otherskills` TEXT NULL,
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
            '$birthdate', 
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
            <td>$birthdate</td>
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

<!--https://www.ninjaone.com/it-hub/endpoint-security/what-is-input-sanitization/#:~:text=Input%20sanitization%2C%20also%20known%20as,user%20inputs%20to%20ensure%20safety.
https://www.w3schools.com/php/php_form_validation.asp
https://www.w3schools.com/php/php_form_required.asp
https://www.w3schools.com/php/php_form_url_email.asp-->
