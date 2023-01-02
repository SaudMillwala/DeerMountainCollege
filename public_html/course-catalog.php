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
            <title>Course Catalog</title>
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
                    <div class="tableContainer" id="tableContainer" style="background-color: black;padding-bottom: 120px;padding-top: 20px;font-size: 200%">
                        <div class="calenderNav" id="calenderNav">
                            <table class="tableContent" id="tableContent">
                               
                                <tbody><br>
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
                                                    
                                                echo "Course Catalog<br>".$moddedYear;
                                                echo '</th>';
                                                echo '<th colspan="1" class="rightCarrot"></th><br>';
                                                $oldYear = $currentYear;
                                            }
                                        }
                                        echo '</tr>';
                                        $currentDept = null;
                                        $result = $pdo->query('SELECT * FROM course INNER JOIN department ON course.dept_ID=department.dept_ID INNER JOIN user ON department.manager_ID=user.user_ID;');
                                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                                        {   
                                            if($currentDept != $row["dept_Name"]){
                                                $currentDept = $row["dept_Name"];
                                                
                                                echo '<tr>';
                                                echo '<th colspan="3">'.$row["dept_Name"].'</th>';
                                                echo '</tr>';
                                                echo '<span>';
                                                echo '<th colspan="3" style="font-size:20px;font-weight:normal;padding-right: 30px;">';
                                                echo '<div style="color:white;word-wrap:break-word">';
                                                echo '<span style="color: #234c63;">Manager: </span>';
                                                echo $row["first_Name"];
                                                echo " ";
                                                echo $row["last_Name"];
                                                echo '<span style="color: white; float:right">';
                                                echo $row["manager_ID"];
                                                echo '</span>';
                                                echo '<span style="color: #234c63; float:right">Manager ID:&nbsp';
                                                echo '</span>';
                                                echo '<span style="color: #234c63; float:right"></span>';
                                                echo '<br>';
                                                echo '<span style="color: #234c63;">Email: </span>';
                                                echo $row["Email"];
                                                echo '<span>';
                                                echo '<span style="color: white; float:right;padding-right:68px;">';
                                                echo $row["phone_Number"];
                                                echo '</span>';
                                                echo '<span style="color: #234c63; float:right">Cell:&nbsp</span>';
                                                echo '<br>';
                                                echo '<span style="color: #234c63;">Office: </span>';
                                                echo $row["room_ID"];
                                                echo '<span style="color: white; float:right;padding-right:85px;">';
                                                echo $row["dept_ID"];
                                                echo '</span>';
                                                echo '<span style="color: #234c63; float:right">Department:&nbsp</span>';   
                                                echo '</th>';
                                                echo '</span>';
                                            }
                                            echo '</thead>';
                                            echo '<tr >';
                                            echo'<td class="semesterTableDay">';
                                            echo $row["dept_ID"];
                                            echo'</td>';
                                            echo'<td class="semesterTableTitle">';
                                            echo $row["course_Name"];
                                            echo'</td>';
                                            echo'<td class="semesterTableDescription";">';
                                            echo $row["course_Desc"];
                                            echo '<br>';
                                            echo '<div style="color:white;">';
                                            echo '<span style="color: white; float:right;">';
                                            echo $row["Type"];
                                            echo '</span>';
                                            echo '<span style="color: #234c63; float:right">Type:&nbsp';
                                            echo '</span>';
                                            echo '</div>';
                                            
                                            echo '<span style="color: #234c63;">';
                                            echo "Prerequisites: "; 
                                            echo "</span>";
                                            echo '<span style="color: white;">';
                                            $result2 = $pdo->query('SELECT * FROM course_prerequisite WHERE "'.$row["course_ID"].'" = course_prerequisite.course_ID;');
                                            $count = $result2->rowCount();
                                            $startCount = 0;
                                            
                                            while($row = $result2->fetch(PDO::FETCH_ASSOC))
                                            {   
                                                if($row["course_Prerequisite_ID"] != null){
                                                    echo $row["course_Prerequisite_ID"];
                                                    echo '&nbsp';
                                                    if($count > 1){
                                                        echo $row["Type"];
                                                        echo '&nbsp';
                                                        $count--;
                                                    }
                                                    
                                                }
                                            }
                                            if($count == 0){
                                                echo "None";
                                            }
                                            echo "</span>";
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            echo'</td>';
                                            echo '</tr>';
                                        }
                                        
                                    ?>
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