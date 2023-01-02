<!DOCTYPE html>
<html>
    <?php
    include "Database.php";

    // ini_set("display_errors", "1");

    // ini_set("display_startup_errors", "1");

    // error_reporting(E_ALL);
    ?>
    <?php
        include 'Database.php';
    ?>
    <head>
            <link rel='stylesheet' type='text/css' href='homepage.css'>
            <script src="homepage.js"></script>
            <meta charset = "utf-8">
            <title>Degree Programs</title>
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
                    <div class="tableContainer" id="tableContainer" style="background-color: black;padding-bottom: 120px;padding-top: 20px;font-size: 200%;margin-right:-0.2%">
                        <div class="calenderNav" id="calenderNav">
                            <table class="tableContent" id="tableContent" style="padding-top: 0;">
                               
                                <tbody>
                                    <?php
                                        
                                        $oldYear = 2000;
                                        $oldMonth = 'June';
                                        $result = $pdo->query('SELECT * FROM academic_calendar');
                                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                                        {
                                            echo '<thead>';
                                            echo '<tr>';
                                            $currentYear = $row["semester_ID"];
                                            if($currentYear != $oldYear){
                                                echo '<th colspan="1" class="leftCarrot"></th>';
                                                echo '<th class ="semesterTableData" colspan="1">';
                                                if(strpos($currentYear,'F') == true){
                                                    $moddedYear = str_replace("F","Fall","$currentYear");
                                                }
                                                if(strpos($currentYear,'S') == true){
                                                    $moddedYear = str_replace("S","Spring","$currentYear");
                                                }
                                                    
                                                echo "Degree Programs<br>".$moddedYear;
                                                echo '</th>';
                                                echo '<th colspan="1" class="rightCarrot"></th><br>';
                                                $oldYear = $currentYear;
                                            }
                                        }
                                    ?>
                                    <form method = "POST">
                                        <br>

                                        <select name = "department" style="background-color: black;color:white;margin-left:4%;width: 55%;height: 33px;font-size: 25px;">
                                            <option selected disabled>Select Department</option>
                                            <?php
                                                $result = $pdo->query('SELECT dept_ID, dept_Name FROM department WHERE ACTIVE = 1 ORDER BY dept_ID');
                                                while($row = $result->fetch(PDO::FETCH_ASSOC))
                                                {
                                                    echo "<option value =   '".$row["dept_ID"]."'>".$row["dept_Name"]."</option>";
                                                }
                                            ?>
                                        </select>
                                        <input type = "submit" name = "schedule_search"  style="float:right;margin-right:6%;margin-top:5px;background-color: black;color:white;width: 16%;height: 33px;font-size: 25px;border-color: white;">
                                    
                                    <?php
                                        echo '</tr>';
                                        if(!empty($_POST["department"])){
                                            
                                            $currentDept = $_POST["department"];
                                            
                                            $result = $pdo->query('SELECT * FROM course, major_requirements, minor_requirements WHERE course.course_ID = major_requirements.course_ID AND course.course_ID = minor_requirements.course_ID AND course.dept_ID = "'.$currentDept.'";');
                                            
                                            $tempDeptName = null;
                                            
                                            while($row = $result->fetch(PDO::FETCH_ASSOC))
                                            {   
                                                if($tempDeptName != $row["course_Name"]){
                                                    $tempDeptName = $row["course_Name"];
                                                    echo '<tr>';
                                                    echo '<th colspan="3">'.$row["course_Name"].'</th>';
                                                    echo '</tr>';
                                                    echo '<th colspan="3" style="font-size:20px;font-weight:normal;padding-right: 30px;">';
                                                
                                                
                                                
                                                    echo '<div style="color:white;  ">';
                                                
                                                    echo '<span style="color: #234c63;">Course ID: </span>';
                                                    echo '<span style="color: white;">';
                                                    echo $row["course_ID"];
                                                    echo '</span>';
                                                    
                                                    echo '<span style="color: white; float:right">';
                                                    echo $row["minor_ID"];
                                                    echo '&nbsp&nbsp';
                                                    echo '</span>';
                                                    
                                                    echo '<span style="color: #234c63; float:right">Minor ID:&nbsp';
                                                    echo '</span>';
                                                
                                                    echo '<span style="position:absolute;color: #234c63; float:right"></span>';
                                                
                                                    echo '<br>';
                                                    echo '<span style="color: #234c63;">Minimum Grade: </span>';
                                                    echo $row["minimum_Grade"];
                                                    
                                                    echo '<span style="color: white; float:right;padding-right:38px;">';
                                                    echo $row["course_Credit"];
                                                    echo '&nbsp&nbsp';
                                                    echo '</span>';
                                                    echo '<span style="color: #234c63; float:right">Credit:&nbsp</span>';
                                                    
                                                    echo '<br>';
                                                    
                                                    
                                                
                                                
                                                    echo '</th>';
                                                    
                                                    
                                                }
            
                                                echo '</thead>';
                                                echo '<tr >';
                                                echo'<td class="semesterTableDay">';
                                                echo $row["dept_ID"];
                                                echo'</td>';
                                                echo'<td class="semesterTableTitle">';
                                                
                                                
                                                echo'</td>';
                                                echo'<td class="semesterTableDescription";">';
                                                echo $row["course_Desc"];
                                                echo '<br>';
                                                
                                                echo '<div style="color:white;">';
                                                
                                                echo '<span style="color: white;float:right;">';
                                                echo $row["Type"];
                                                
                                                echo '</span>';
                                                echo '<span style="color: #234c63; float:right">Type:&nbsp</span>';
                                                echo '<br>';
                                                
                                                $tempCourseID = null;
                                                 
                                                    if($tempCourseID != $row["course_ID"]){
                                                        
                                                        $tempCourseID = $row["course_ID"];
                                                        
                                                        
                                                       
                                                    }
                                                    

                                                    
                                                    echo '</div>';
                                                
                                                
                                                
                                                
                                                echo '</div>';
                                                echo'</td>';
                                                echo '</tr>';
                                                
                                              
                                            
                                        }
                                        }
                                    ?>
                                    </form>
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </section>
            </div>
            
        </div>
        <footer>
            <div></div>
        </footer>
    </body>
</html>