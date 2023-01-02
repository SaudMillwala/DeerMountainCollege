<!DOCTYPE html>
<html>
    <?php
    include "Database.php";

    ?>
    <?php
        include 'Database.php';
    ?>
    <head>
            <link rel='stylesheet' type='text/css' href='homepage.css'>
            <script src="homepage.js"></script>
            <meta charset = "utf-8">
            <title>Master Schedule</title>
    </head>    
    <body>
        <div id="blur" class="blurContainer" >
            <aside class="panelContainer" style="display:none" id="myPanel">
                <div>
                    <button onclick="panelClose()" class="panelHeader">Close X</button>
                </div>
                <div>
                    <button onclick = "window.location.href = 'course-catalog.php'" class='sidePanelButton'>Course<br>Catalog</button>
                </div>
                <div>
                    <button onclick = "window.location.href = 'degree-programs.php'" class='sidePanelButton'>Degree<br>Programs</button>
                </div>
                <div>
                    <button onclick = "window.location.href = 'master_schedule.php'" class='sidePanelButton'>Master<br>Schedule</button>
                </div>
                <div>
                    <button onclick = "window.location.href = 'academic_calendar.php'" class='sidePanelButton'>Academic<br>Calender</button>
                </div>
                <div>
                    <button onclick = "window.location.href = 'departments-courses.php'" class='sidePanelButton'>Departments<br>& Courses</button>
                </div>
                <div>
                    <button onclick = "window.location.href = 'about.html'" class='sidePanelButton'>About Us</button>
                </div>
            </aside>
            <aside class = "rightColumnContainer" id="rightColumnContainer">
                <div>
                </div>
            </aside>
            <div class="bg" id="bg">
                
                <header id="header">
                    <div class = logoContainer>
                        <button onclick="panelOpen()" class='panelButton' id='panelButton'>☰</button>
                        <img src="https://i.imgur.com/ZSJeGdX.png" id="logo" alt="logo" onclick = "window.location.href = 'index.html'">
                        <img src="https://i.imgur.com/4WU9EeP.png" alt="titleImg" class=' logoContainer titleImg' height="150px" onclick = "window.location.href = 'index.html'">
                    </div>
                    
                    <div class = loginContainer>
                        <button class = logButton onclick = "window.location.href = 'login.php'">LOGIN</button><br>
                        <button class = logButton onclick = "window.location.href = 'index.html'">HOMEPAGE</button>
                    </div>
                </header>
                <section>
                    <div class="tableContainer" id="tableContainer" style="background-color: black;">
                        <div class="calenderNav" id="calenderNav">
                            <table class="tableContent" id="tableContent" width="98%" style="text-align: center;">
                            <thead>
                                
                                <tr style="font-size: 15px;">
                                    <th onclick="sortTable(0)" style="position: sticky; top:0; text-align: center">CRN</th>
                                    <th onclick="sortTable(1)" style="position: sticky; top:0; text-align: center">Course</th>
                                    <th onclick="sortTable(2)" style="position: sticky; top:0; text-align: center">Section</th>
                                    <th onclick="sortTable(3)" style="position: sticky; top:0; text-align: center">Faculty</th>
                                    
                                    <th onclick="sortTable(4)" style="position: sticky; top:0; text-align: center">Day ID</th>
                                    <th onclick="sortTable(5)" style="position: sticky; top:0; text-align: center">Time</th>
                                    
                                    <th onclick="sortTable(6)" style="position: sticky; top:0; text-align: center">Room</th>
                                    <th onclick="sortTable(7)" style="position: sticky; top:0; text-align: center">Semester ID</th>
                                    <th onclick="sortTable(8)" style="position: sticky; top:0; text-align: center">Seats Available</th>
                                </tr>
                            </thead>
                            <tbody><br>
                                <tr style="width:98%">
                                    <form method = "POST">
                                        <h1 style="font-size:30px;margin-left:15px;">Master Schedule Finder</h1>
                                        <select name = "semester" style="background-color: black;color:white;margin-left:5%;width: 20%;height: 33px;font-size: 25px;">
                                            <option selected disabled>Select Semester</option>
                                            <option value = "2023-S">Spring 2023</option>
                                            <option value = "2022-F">Fall 2022</option>
                                        </select>
                                        <select name = "department" style="background-color: black;color:white;margin-left:5%;width: 45%;height: 33px;font-size: 25px;">
                                            <option selected disabled>Select Department</option>
                                            <?php
                                                $result = $pdo->query('SELECT dept_ID, dept_Name FROM department WHERE ACTIVE = 1 ORDER BY dept_ID');
                                                while($row = $result->fetch(PDO::FETCH_ASSOC))
                                                {
                                                    echo '<option value = '.$row["dept_ID"].'>' . $row["dept_Name"] . '</option>';
                                                }
                                            ?>
                                        </select>
                                        <input type = "submit" name = "schedule_search"  style="margin-left:5%;background-color: black;color:white;width: 15%;height: 33px;font-size: 25px;border-color: white;">
                                    </form>
                                </tr>
                                <?php
                                if(isset($_POST["schedule_search"]))
                                    {
                                    if (empty($_POST["department"])){
                                        echo " Please Select A Valid Department <br>";
                                    }
                                    if (empty($_POST["semester"])){
                                        echo " Please Select A Valid Semester <br>";
                                    }
                                    }
                                 if(!empty($_POST["department"] && $_POST["semester"]))
                                    {
                                        $result = $pdo->query('SELECT class.CRN, class.course_ID, class.section_Num, user.first_Name, user.last_Name, schedule.day_ID, schedule.start_Time, schedule.end_Time, class.room_ID, class.semester_ID, class.seat_Avail FROM course, class, user, schedule WHERE class.faculty_ID = user.user_ID AND class.time_Slot_ID = schedule.time_Slot_ID AND course.course_ID = class.course_ID AND course.ACTIVE = 1 AND class.semester_ID = "'.$_POST["semester"].'" AND class.course_ID LIKE "%'.$_POST["department"].'%"');
                                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                                        {
                                            echo "<tr style='font-size:15px'>";
                                            echo "<td>". $row["CRN"] ."</td>";
                                            echo "<td>". $row["course_ID"] ."</td>";
                                            echo "<td>". $row["section_Num"] ."</td>";
                                            echo "<td>". $row["first_Name"] . ' ' . $row["last_Name"] ."</td>";
                                            echo "<td>". $row["day_ID"] ."</td>";
                                            echo "<td>". $row["start_Time"] . ' ' . $row["end_Time"] ."</td>";
                                            echo "<td>". $row["room_ID"] ."</td>";
                                            echo "<td>". $row["semester_ID"] ."</td>";
                                            echo "<td>". $row["seat_Avail"] ."</td>";
                                            echo "</tr>";
                                        }
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                        </div>   
                </section>
            </div>
            
        </div>
        <footer>
            <div></div>
        </footer>
    </body>
</html>
