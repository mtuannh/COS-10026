<?php include_once 'header.inc'; ?>
<body>
        <?php include_once 'menu.inc'; ?>
        <div id="slider-about">
            <h1 id="main_head">ABOUT OUR GROUP</h1><br>
            <figure>
                <img class="grouppicture" src="images/group.jpg" alt="Indinam Group">
            </figure>
            <dl>
                <dt class="remove-margin">My group name:</dt>
                <dd class="remove-margin">Indinam Company</dd>
                <dt class="remove-margin">Group ID:</dt>
                <dd class="remove-margin">COS 10026 - G6</dd> 
                <dt class="remove-margin">Tutor's name:</dt> 
                <dd class="remove-margin">Mostafa Farshchi</dd>
                <dt class="remove-margin">Course:</dt>
                <dd class="remove-margin">COS10026 - Computing Technology Inquiry Project</dd>
            </dl>
            <br>
            <details>
                <summary>Meet our teammates</summary>
                <div class="personal-section">
                    <h1>Hoang Minh Tuan Nguyen</h1>
                    <p>Student ID: 104527639<br>
                    DOB: 22/12/2005<br>
                    Hometown: Ha Noi, Viet Nam<br>
                    Situation: Team member, freshman.
                    </p>
                    <div class="profile-pic">
                        <img src="images/me.jpg" alt="Hoang Minh Tuan Nguyen">
                    </div>
                </div>
                <hr>
                <div class="personal-section">
                    <h1>Vu Thuan Huynh</h1>
                    <p>Student ID: 105218471<br>
                    DOB: 04/11/2004<br>
                    Hometown: Ho Chi Minh, Viet Nam<br>
                    Situation: Team member, freshman.
                    </p>
                    <div class="profile-pic">
                        <img src="images/anh_thuan.jpg" alt="Vu Thuan Huynh">
                    </div>
                </div>
                <hr>
                <div class="personal-section">
                    <h1>Akshara Malampurathu Rajan</h1>
                    <p>Student ID: 105107799<br>
                    DOB: 03/11/2004<br>
                    Hometown: Kerala, India<br>
                    Situation: Team member, freshman.
                    </p>
                    <div class="profile-pic">
                        <img src="images/akshara.jpg" alt="Akshara">
                    </div>
                </div>
            </details>
            <h2 id="schedule">TIMETABLE</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>8:30 - 10h30</td>
                            <td></td>
                            <td class="subject1">COS 10009 - Introduction of Programming</td>
                            <td></td>
                            <td></td>
                            <td class="subject1">COS 10009 - Introduction of Programming</td>
                        </tr>
                        <tr>
                            <td>10h30 - 12h30</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="subject2">TNE 10006 - Network and Switching</td>
                        </tr>
                        <tr>
                            <td>12h30 - 13h30</td>
                            <td class="subject3">COS 10026 - Computing Inquiry Project</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>15h30 - 16h30</td>
                            <td></td>
                            <td></td>
                            <td class="subject3" rowspan="2">COS 10026 - Computing Inquiry Project</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>16h30 - 18h30</td>
                            <td class="subject2" rowspan="2">TNE 10006 - Network and Switching</td>
                            <td></td>
                            <td></td>
                            <td class="subject4">COS 10004 - Computer Systems</td>
                        </tr>
                        <tr>
                            <td>18h30 - 20h30</td>
                            <td></td>
                            <td></td>
                            <td class="subject4">COS 10004 - Computer Systems</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>    
            <div class="mail-section">
                <a class="groupemail" href="mailto:104527639@student.swin.edu.au">Group Email</a>
            </div> 
        </div>
        <br>
        <br>
<?php include_once 'footer.inc'; ?>
</body>
</html>
