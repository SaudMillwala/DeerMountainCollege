<?php
    session_start();
    if($_SESSION["status"] != true)
    {
        header("Location: login.php");
    }
    if($_SESSION["status"] == true)
    {
        $_SESSION["graduate"] = true;
    }
?>

<?php
include "Database.php";

// ini_set("display_errors", "1");

// ini_set("display_startup_errors", "1");

// error_reporting(E_ALL);
?>

<!doctype html>

<html lang="en">
	<head>
		<link rel='stylesheet' type='text/css' href='admin.css'>
		<script src="homepage.js"></script>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Graduate Portal</title>
	</head>
	<body>
		<div id="blur" class="blurContainer">
			<aside class="panelContainer" style="display:none" id="myPanel">
				<div>
					<button onclick="panelClose()" class="panelHeader">Close X</button>
				</div>
				<div>
					<button onclick="window.location.href = 'course-catalog.php'" class='sidePanelButton'>Course<br>Catalog</button>
				</div>
				<div>
					<button onclick="window.location.href = 'degree-programs.php'" class='sidePanelButton'>Degree<br>Programs</button>
				</div>
				<div>
					<button onclick="window.location.href = 'master_schedule.php'" class='sidePanelButton'>Master<br>Schedule</button>
				</div>
				<div>
					<button onclick="window.location.href = 'academic_calendar.php'" class='sidePanelButton'>Academic<br>Calender</button>
				</div>
				<div>
					<button onclick="window.location.href = 'departments-courses.php'" class='sidePanelButton'>Departments<br>& Courses</button>
				</div>
				<div>
					<button onclick="window.location.href = 'about.html'" class='sidePanelButton'>About Us</button>
				</div>
			</aside>
			<aside class="rightColumnContainer" id="rightColumnContainerAdmin" >
				<div></div>
			</aside>
			<div class="bg" style="padding-bottom:700px">
				<header id="header">
					<div class=logoContainer>
						<button onclick="panelOpen()" class='panelButton' id='panelButton'>☰</button>
						<img src="https://i.imgur.com/ZSJeGdX.png" id="logo" alt="logo" onclick = "window.location.href = 'index.html'">
						<img src="https://i.imgur.com/4WU9EeP.png" alt="titleImg" class=' logoContainer titleImg' height="150px" onclick = "window.location.href = 'index.html'">
					</div>

					<div class=loginContainer>
						<form action="faculty.php" method="POST">
							<button class=logButton onclick="window.location.href = 'logout.php'" type="submit" name="logout">LOGOUT</button><br>
						</form>
						
                        
						<button class=logButton onclick="window.location.href = 'index.html'">HOMEPAGE</button>
					</div>
				</header>
				<section>
					<div class=adminContainer>
					    <h1 style="font-size:30px;">Graduate Student Portal</h1>
					    <?php 
					    if ($_SESSION["user_Type"] != "Graduate"){
					        if ($_SESSION["user_Type"] == "Admin"){
					            header("Location: admin.php");
					        }
					        if ($_SESSION["user_Type"] == "Faculty"){
					            header("Location: faculty.php");
					        }
					        if ($_SESSION["user_Type"] == "Undergraduate"){
					            header("Location: undergraduate.php");
					        }
					        if ($_SESSION["user_Type"] == "Research Staff"){
					            header("Location: research_Staff.php");
					        }
					    }
					    ?>
					    
						<h2 class="mt-2">Logged in as: <?php echo $_SESSION["user_Email"]; ?></h2>


                        <form action="graduate.php" method="POST">
							<input class="reset-btn" type="submit" name="refresh" value="Refresh Page">
						</form>
					</div>
                    <?php
                        if(isset($_POST["logout"]))
                        {
                            $_SESSION["logout"] = true;
                            header("Location: logout.php");
                        }
                    ?>
                    <table style="padding-bottom:10px;width:120%;">
					    <tbody style="text-align: center; ">
						    <tr colspan="5">
							    <td>
								    <button onclick="window.location.href = 'UserDataGrad.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Student<br>Information</button>
								</td>
							    <td>
								    <button onclick="window.location.href = 'ScheduleDataGrad.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">My Schedule</button>
							    </td>
							    <td>
								    <button onclick="window.location.href = 'AcademicDataGrad.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Academic<br>Information</button>
							    </td>
							    <td>
								    <button onclick="window.location.href = 'StudentTranscriptGrad.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Unofficial<br>Transcript</button>
							    </td>
							    <td>
								    <button onclick="window.location.href = 'StudentDegreeAuditGrad.php'" class=adminNav; style="background-color:#006a4e;font-size:80%;margin-top:0px;height:58px;">Degree<br>Audit</button>
							    </td>
								
						    </tr>
					    </tbody>
				    </table>
                    <form action = "StudentDegreeAuditGrad.php" method = "POST">
                        <table>
					    <thead>
							<tr> <?php 
							    
							    $result = $pdo->query('SELECT * FROM hold, student_hold WHERE hold.hold_ID = student_hold.hold_ID AND student_ID = '.$_SESSION["user_ID"]);
							    $count = 1;
        					                while($row = $result->fetch(PDO::FETCH_ASSOC))
        					                {
        					                    if ($count == 1)
        					                    {
        					                        echo '<i style="color:RED;font-size:20px;font-family:calibri ;"> -Please Contact An Administrator To Remove The Hold On Your Account-<br></i>';
        					                    }
        					                    echo '<i style="color:RED;font-size:20px;font-family:calibri ;"> '.$row["hold_Type"]. ' Hold On Account<br></i>';
        					                    
        					                    $count++;
        					                }
        					                
        					                
							    
							    ?>
								<th>Worksheets</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>You are currently majoring in:<br>
								    <?php
                                        $result = $pdo->query('SELECT * FROM major, student_major WHERE major.major_ID = student_major.major_ID AND student_major.student_ID = '.$_SESSION["user_ID"]);
                                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                                        {
                                            echo $row["major_Name"]."<br>";
                                        }
                                        
                                        
                                        $result = $pdo->query('SELECT SUM(course_Credit) FROM course,student_history WHERE course.course_ID = student_history.course_ID AND student_history.student_ID = '.$_SESSION["user_ID"]);
                                        
                                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                                        {
                                            echo "Credits Taken: ".$row["SUM(course_Credit)"]."<br>";
                                        }
                                        
                                        
                                        
                                        
                                        
                                        
                                    ?>
								</td>
							</tr>
						</tbody>
					</table>
					
					<table>
						
					    <thead>
					        <tr>
                                <th>Courses currently registered in</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <tr>
                                <td>
                                    <?php
                                        $result = $pdo->query('SELECT * FROM semester, course, class, enrollment WHERE semester.semester_ID = enrollment.semester_ID AND course.course_ID = class.course_ID AND class.CRN = enrollment.CRN AND enrollment.student_ID = '.$_SESSION["user_ID"].' ORDER BY enrollment.semester_ID DESC');
                                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                                        { 
                                            echo "Course: ".$row["course_ID"]." - ".$row["course_Name"]." | "."Credits: ".$row["course_Credit"]." | ".$row["semester_Name"]."<br><br>";
                                        }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
					    <thead>
                            <tr>
                                <th>Courses Taken</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <tr>
                                <td>
							        <?php
    					                $result = $pdo->query('SELECT * FROM course, student_history WHERE course.course_ID = student_history.course_ID AND student_history.student_ID = '.$_SESSION["user_ID"].' ORDER BY student_history.semester_ID DESC');
    					                while($row = $result->fetch(PDO::FETCH_ASSOC))
    					                {
    					                    echo "Course: ".$row["course_ID"].": ".$row["course_Name"]." | "."Semester: ".$row["semester_ID"]." | "."Grade: ".$row["Grade"]."<br><br>";
    					                }
							        ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
					
					
					<table>
						<thead>
							<tr>
								<th>Degree Audit</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
                                    <?php
                                        $result = $pdo->query('SELECT * FROM course, student_major, major_requirements WHERE major_requirements.course_ID = course.course_ID AND student_major.major_ID = major_requirements.major_ID AND student_major.student_ID = "'.$_SESSION["user_ID"].'" AND major_requirements.course_ID NOT IN (SELECT course_ID FROM student_history WHERE student_ID = '.$_SESSION["user_ID"].')');
                                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                                        { 
                                            echo "Course: ".$row["course_ID"]." - ".$row["course_Name"]." | "."Credits: ".$row["course_Credit"]."<br><br>";
                                        }   
                                    ?>
								</td>
							</tr>
						</tbody>
					</table>
                    </form> 
                </section>
				<br><br><br><br><br><br><br><br><br><br><br><br>
			</div>
		</div>
		<footer>
            <div></div>
        </footer>
	</body>
</html>