<?php
    include 'Database.php';
?>

<!DOCTYPE html>
<html>
    <head>
            <link rel='stylesheet' type='text/css' href='homepage.css'>
            <script src="homepage.js"></script>
            <meta charset = "utf-8">
            <title>Academic Calendar</title>
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
                    <button onclick = "window.location.href = 'academic_calendar.php'" class='sidePanelButton'>Academic<br>Calendar</button>
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
                                                    
                                                echo "Academic Calender<br>".$moddedYear;
                                                echo '</th>';
                                                echo '<th colspan="1" class="rightCarrot"></th><br>';
                                                $oldYear = $currentYear;
                                            }
                                            echo '</tr>';
                                            echo '<tr>';
                                            $currentMonth = $row["Month"];
                                            if($currentMonth != $oldMonth){
                                                echo '<th colspan="3">'.$currentMonth.'</th>';  
                                                $oldMonth = $currentMonth;
                                            }
                                            echo '</tr>';
                                            echo '</thead>';
                                            echo '<tr>';
                                            echo'<td class="semesterTableDay">';
                                            echo $row["Day"];
                                            echo'</td>';
                                            echo'<td class="semesterTableTitle">';
                                            echo $row["Title"];
                                            echo'</td>';
                                            echo'<td class="semesterTableDescription";">';
                                            echo $row["Description"];
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