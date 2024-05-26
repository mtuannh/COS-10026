<?php include_once 'header.inc'; ?>
<body>
    <?php include_once 'menu.inc'; ?>
    <div id="background-apply-image"></div>
    <div id="slider-apply">
        <h1>Jobs Application Form</h1>
        <div class="apply-section-content">
            <fieldset>
            <form id="job-application-page" method="post" action="processEOI.php" novalidate = "novalidate">
                    <label for="jrn">Job Reference Number: </label>
                    <input type="text" name="jrn" id="jrn" pattern="[A-Za-z0-9]{5}" maxlength="5" required="required">  
                    <span> * </span>
                    <br><br>
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" pattern="^[a-zA-Z]+$" maxlength="20" placeholder="Enter first name" required="required">
                    <span> * </span>
                    <br><br>
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" pattern="^[a-zA-Z]+$" maxlength="20" placeholder="Enter last name" required="required">
                    <span> * </span>
                    <br><br>
                    <label for="dob">Date of Birth:</label>
                    <input type="text" id="dob" name="dob" pattern="\d{2}/\d{2}/\d{4}" placeholder="dd/mm/yyyy" maxlength="10" size="15" required="required">
                    <span> * </span>
                    <br><br>
                <fieldset>
                    <legend>Gender:<span> * </span></legend>
                    <input type="radio" id="male" name="gender" value="Male" required="required">
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="Female" required="required">
                    <label for="female">Female</label>
                    <input type="radio" id="Prefer_not_to_say" name="gender" value="Prefer not to say" required="required">
                    <label for="Prefer_not_to_say">Prefer not to say</label>
                </fieldset><br>
                
                    <label for="street_address">Street Address:</label>
                    <input type="text" id="street_address" name="street_address" required="required" maxlength="40" size="40" placeholder="Enter street name">
                    <span> * </span>
                    <br><br>
                    <label for="suburb_town">Suburb/Town:</label>
                    <input type="text" id="suburb_town" name="suburb_town" placeholder="Enter suburb/town name" required="required" maxlength="40" size="40">
                    <span> * </span>
                    <br><br>
                    <label for="state">State:</label>
                    <select id="state" name="state" required="required">
                        <option value="" disabled selected>Select your state</option>
                        <option value="VIC">VIC</option>
                        <option value="NSW">NSW</option>
                        <option value="QLD">QLD</option>
                        <option value="NT">NT</option>
                        <option value="WA">WA</option>
                        <option value="SA">SA</option>
                        <option value="TAS">TAS</option>
                        <option value="ACT">ACT</option>
                      </select>
                    <span> * </span>  
                    <br><br>

                    <label for="postcode">Postcode:</label>
                    <input type="text" id="postcode" name="postcode" pattern="[0-9]{4}$" placeholder="Enter only 4 digits" maxlength="4" required="required" size="15">
                    <span> * </span>
                    <br><br>
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" required="required">
                    <span> * </span>
                    <br><br>
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" pattern="^[0-9]{8,12}$" placeholder="Enter phone number" required="required">
                    <span> * </span>
                    <br><br>
                    <p>Skill lists:</p>
                    <input type="checkbox" id="skill1" name="skill[]" value="Front-end Developer">
                    <label for="skill1">Front-end Developer</label><br>
                    <input type="checkbox" id="skill2" name="skill[]" value="Back-end Developer">
                    <label for="skill2">Back-end Developer</label><br>
                    <input type="checkbox" id="skill3" name="skill[]" value="Full Stack Developer">
                    <label for="skill3">Full Stack Developer</label><br>
                    <input type="checkbox" id="other_skill" name="skill[]" value="Other skills...">
                    <label for="other_skill">Other skills...</label><br><br>

                    <label for="other_skills">Other Skills (if any):</label><br>
                    <textarea id="other_skills" name="other_skills" rows="4" cols="50" placeholder="Enter your other skills"></textarea><br><br>

                    <input type="submit" value="Submit">
                    <input type="reset" value="Reset Form">
            </form>
            </fieldset>
        </div>
    </div>
<?php include_once 'footer.inc'; ?>
</body>
</html>