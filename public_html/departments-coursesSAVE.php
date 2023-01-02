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
            <title>Departments&Courses</title>
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
                            
                            <tbody><br>
                                <tr style="width:98%">
                                    <h1 style="font-size:30px;margin-left:15px;">Departments & Courses</h1>
                                    <form method = "POST">
                                        <select name = "semester" style="background-color: black;color:white;margin-left:5%;width: 20%;height: 33px;font-size: 25px;">
                                            <option selected disabled>Select Semester</option>
                                            <option>2023-S</option>
                                            <option>2022-F</option>
                                            <option>2022-S</option>
                                            <option>2021-F</option>
                                            <option>2021-F</option>
                                            <option>2020-S</option>
                                            <option>2020-S</option>
                                            <option>2019-S</option>
                                            <option>2019-S</option>
                                            <option>2018-F</option>
                                        </select>
                                        <select name = "department" style="background-color: black;color:white;margin-left:5%;width: 45%;height: 33px;font-size: 25px;">
                                            <option selected disabled>Select Department</option>
                                            <?php
                                                $result = $pdo->query('SELECT dept_ID, dept_Name FROM department ORDER BY dept_ID');
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
                                        $tempCourseID = null;
                                            
                                        $result1 = $pdo->query('SELECT * FROM course WHERE course.dept_ID = "'.$_POST["department"].'" AND course.dept_ID NOT IN (SELECT course.course_ID FROM course, course_prerequisite WHERE course.course_ID = course_prerequisite.course_ID AND course.dept_ID = "'.$_POST["department"].'");');
                                        
                                        while($row = $result1->fetch(PDO::FETCH_ASSOC))
                                        {
                                                
                                            if($tempCourseID != $row[course_ID]){
                                                echo '<tr style="font-size:22px;">';
                                                echo '<th colspan="2">'.$row[course_Name].'<br>'.$row[course_ID].'';
                                                echo '</th>';
                                                echo '</tr>';
                                                echo '</thead>';
                                                echo '<span style="float:right">';
                                                echo '</span>';
                                                echo '<tbody>';
                                                echo '<tr>';
                                                echo '<td style="font-size:17px;">'.$row[course_Desc].'</td>';
                                                echo '<td style="color: black;font-size:22px;"><span style = "color:#234c63">Credits Available:</span>'.$row[course_Credit];
                                                
                                                if($prereqNone == null){
                                                    $prereqNone = " None";
                                                }
                                                echo '<span style = "color:#234c63"><br><br>Prerequisites:</span><br>'.$prereqNone;
                                                echo '<br>';    
                                                $minGradeNone = null;
                                                $minGradeNone = $row[minimum_Grade];
                                                if($minGradeNone == null){
                                                    $minGradeNone = " None";
                                                }
                                                echo '<span style = "color:#234c63"><br>Minimum Grade Required:</span>'.$minGradeNone;
                                                
                                                
                                            }
                                            else if($tempCourseID = $row[course_ID]){
                                                echo '<br>';
                                                echo $row[Type];
                                                echo '&nbsp'.$row[course_Prerequisite_ID];
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            $tempCourseID = $row[course_ID];
                                        }
                                            
                                            
                                 
                                       $tempCourseID = null;
                                    
                                        $result = $pdo->query('SELECT course.course_ID,course.dept_ID, course.course_Name,course.course_Desc, course_prerequisite.Type, course_prerequisite.course_Prerequisite_ID, course.course_Credit, course_prerequisite.minimum_Grade FROM course, course_prerequisite WHERE course.course_ID = course_prerequisite.course_ID && course.dept_ID="'.$_POST["department"].'";');
                                            
                                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                                        {
                                                
                                                
                                            if($tempCourseID != $row[course_ID]){
                                                $tempCourseID = $row[course_ID];  
                                                
                                                echo '<tr style="font-size:22px;">';
                                                echo '<th colspan="2">'.$row[course_Name].'<br>'.$row[course_ID].'';
                                                    
                                                echo '</th>';
                                                        
                                                echo '</tr>';
                                                echo '</thead>';
                                                echo '<span style="float:right">';
                                                echo '</span>';
                                                echo '<tbody>';
                                                echo '<tr>';
                                                echo '<td style="font-size:17px;">'.$row[course_Desc].'</td>';
                                                    
                                                echo '<td style="color: black;font-size:22px;"><span style = "color:#234c63">Credits Available:</span>'.$row[course_Credit];
                                                echo '<br>';
                                                echo '<span style = "color:#234c63"><br>Prerequisites:</span><br>';
                                                $minGradeNone = null;
                                                $loopChecker = null;
                                                $result2 = $pdo->query('SELECT course.course_ID,course.dept_ID, course.course_Name,course.course_Desc, course_prerequisite.Type, course_prerequisite.course_Prerequisite_ID, course.course_Credit, course_prerequisite.minimum_Grade FROM course, course_prerequisite WHERE course.course_ID = course_prerequisite.course_ID && course.dept_ID="'.$row[dept_ID].'" && course_prerequisite.course_ID = "'.$row[course_ID].'";');
                                                    
                                                $count = $result2->rowCount();
                                                while($row = $result2->fetch(PDO::FETCH_ASSOC))
                                                {
                                                    if($row["course_Prerequisite_ID"] != null){
                                                        echo $row["course_Prerequisite_ID"];
                                                        
                                                        if($count == 1){
                                                            echo '<br><span style = "color:#234c63"><br>Minimum Grade Required: </span>';
                                                            echo $row["minimum_Grade"];
                                                            $count--;
                                                        }   
                                                        echo '&nbsp';
                                                        if($count > 1){
                                                            echo $row["Type"];
                                                            echo '&nbsp';
                                                            $count--;
                                                        }
                                                    }
                                                }
                                            }
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