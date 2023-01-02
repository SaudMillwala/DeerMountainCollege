

<?php
session_start();

if ($_SESSION["status"] != true) {
    header("Location: login.php");
}

if ($_SESSION["status"] == true) {
    $_SESSION["faculty"] = true;
}
?>

<?php
include "Database.php";

ini_set("display_errors", "1");

ini_set("display_startup_errors", "1");

error_reporting(E_ALL);
?>

<!doctype html>

<html lang="en">
	<head>
		<link rel='stylesheet' type='text/css' href='admin.css'>
		<script src="homepage.js"></script>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Faculty Portal</title>
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
			<div class="bg" style="padding-bottom:1660px;">
				<header id="header">
					<div class=logoContainer>
						<button onclick="panelOpen()" class='panelButton' id='panelButton'>☰</button>
						<img src="https://i.imgur.com/ZSJeGdX.png" id="logo" alt="logo" onclick = "window.location.href = 'index.html'">
						<img src="https://i.imgur.com/4WU9EeP.png" alt="titleImg" class=' logoContainer titleImg' height="150px" onclick = "window.location.href = 'index.html'">
					</div>

					<div class=loginContainer>
						<form action="faculty.php" method="POST">
							<button class=logButton type="submit" name="logout">LOGOUT</button><br>
						</form>
						<button class=logButton onclick="window.location.href = 'index.html'">HOMEPAGE</button>
					</div>
				</header>
				<section>
					<div class=adminContainer>
					    <h1 style="font-size:30px;">Faculty Portal</h1>
					    <?php 
					    if ($_SESSION["user_Type"] != "Faculty"){
					        if ($_SESSION["user_Type"] == "Admin"){
					            header("Location: admin.php");
					        }
					        if ($_SESSION["user_Type"] == "Graduate"){
					            header("Location: graduate.php");
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
						<form action="faculty.php" method="POST">
							<input class="reset-btn" type="submit" name="refresh" value="Refresh Page">
						</form>
					</div>
					<?php
                    if (isset($_POST["logout"])) {
                        header("Location: logout.php");
                    }
                    if (isset($_POST["refresh"])) {
                        header("Location: faculty.php");
                    }
                    ?>
					<table style="padding-bottom:10px;width:119%;">
						<tbody style="text-align: center; ">
							<tr colspan="5">
								
								<td>
									<button onclick="window.location.href = 'UserDataManagerFaculty.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">User Data<br>Manager</button>
								</td>
								<td>
									<button onclick="window.location.href = 'ScheduleDataManagerFaculty.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Schedule<br>Manager</button>
								</td>
								<td>
									<button onclick="window.location.href = 'AcademicDataManagerFaculty.php'" class=adminNav; style="background-color:#006a4e;font-size:80%;margin-top:0px;height:58px;">Academic<br>Manager</button>
								</td>
								<td>
									<button onclick="window.location.href = 'StudentTranscriptFaculty.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Student<br>Transcripts</button>
								</td>
								<td>
									<button onclick="window.location.href = 'StudentDegreeAuditFaculty.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Student<br>Degree Audit</button>
								</td>
							</tr>
						</tbody>
					</table>
                    <table id="academicDataManagerFaculty" style="display:block;">
                        
                        <!--<tr><td>
					    <div id="missingFunction">
						<thead>
							<tr>
								<th>Missing</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th>Current Semester Class Attendance</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <tr>
                                <td>
                                    <?php
                                        $result = $pdo->query('SELECT schedule.week_Day,schedule.start_Time,schedule.end_Time,class.semester_ID,faculty_history.faculty_ID, faculty_history.CRN,faculty_history.course_ID,student_history.student_ID,student_history.Grade,class.time_Slot_ID FROM schedule,faculty_history,class,student_history where schedule.time_Slot_ID = class.time_Slot_ID AND student_history.CRN = faculty_history.CRN AND student_history.semester_ID = faculty_history.semester_ID AND faculty_history.CRN = class.CRN AND faculty_history.faculty_ID = "'.$_SESSION["user_ID"].'" AND faculty_history.semester_ID = class.semester_ID');
                                        
                                         
                                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                                        { 
                                            $studentID = $row["student_ID"];
                                            
                                         
                                            echo "<b>Time: </b>".$row["week_Day"]."<br>";
                                            echo "<b>Time: </b>".$row["start_Time"]." - ".$row["end_Time"]."<br>";
                                            echo "<b>Course: </b>".$row["course_ID"];
                                            echo "<b>Semester: </b>".$row["semester_ID"]."<br>";
                                            echo "<b>CRN: </b>".$row["CRN"]."<br>";
                                            echo "<b>Student: </b>".$row["student_ID"]."<br><br>";
                                            
                                             if(isset($_POST["submitAttendance"]))
							                {
							                   
							                    $result = $pdo->query('INSERT INTO attendance VALUES('.$studentID.', '.$row["CRN"].' , "'.$time.'", "'.$_POST["attendanceDays"].'")');
							                }
                                           
                                            
                                        }
                                        
                                        
                                        
                                    ?>
                                </td>
                            </tr>
							</tr>
						</tbody>
					    </div>
                        </td></tr>-->
                        
                        <tr><td>
					    <div id="missingFunction">
						<tbody>
							<tr>
								<th colspan = 8>Current Semester Class Attendance</th>
								<tr style = "text-align: center">
								    <td>Day</td>
								    <td>Course</td>
								    <td>Semester</td>
								    <td>Time</td>
								    <td>CRN</td>
								    <td>Student ID</td>
								    <td>Mark Attendance</td>
								    <td>Name</td>
                                </tr>
                            </tr>
                        </thead> 
                        <tbody>
                            <tr>
                                <td>
                                    <?php
                                        $result = $pdo->query('SELECT schedule.time_Slot_ID,schedule.day_ID,schedule.start_Time,schedule.end_Time,class.semester_ID,faculty_history.faculty_ID, faculty_history.CRN,faculty_history.course_ID,student_history.student_ID,student_history.Grade,class.time_Slot_ID FROM schedule,faculty_history,class,student_history where schedule.time_Slot_ID = class.time_Slot_ID AND student_history.CRN = faculty_history.CRN AND student_history.semester_ID = faculty_history.semester_ID AND faculty_history.CRN = class.CRN AND faculty_history.faculty_ID = "'.$_SESSION["user_ID"].'" AND faculty_history.semester_ID = class.semester_ID');
                                        
                                         
                                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                                        { 
                                            
                                            
                                            $studentID = $row["student_ID"];
                                            $time = $row["time_Slot_ID"];
                                             if(isset($_POST["submitAttendance"]))
							                {
							                   
							                    $result = $pdo->query('INSERT INTO attendance VALUES('.$studentID.', '.$row["CRN"].' , "'.$time.'", "'.$_POST["attendanceDays"].'")');
							                }
                                            echo "<tr style='font-size:15px;text-align:center'>";
                                            
                                            echo "<td>&nbsp". $row["day_ID"] ."&nbsp</td>";
                                            
                                            echo "<td>&nbsp". $row["course_ID"] . "&nbsp</td>";
                                            echo "<td>&nbsp". $row["semester_ID"] ."&nbsp</td>";
                                            echo "<td>&nbsp". $row["start_Time"] . ' ' . $row["end_Time"] ."&nbsp</td>";
                                            echo "<td>&nbsp". $row["CRN"] ."&nbsp</td>";
                                            echo "<td>&nbsp". $row["student_ID"] ."&nbsp</td>";
                                            echo "<form>";
                                            echo "<td>";
                                            echo "<select name = attendanceDays>";
                                            echo "<option selected disabled></option>";
                                            echo "<option>0</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option><option>24</option><option>25</option><option>26</option><option>27</option><option>28</option><option>29</option><option>30</option>";
                                           
                                            echo "</select>";
                                            echo '<input type = "submit" name = "submitAttendance"  style="background-color: grey;color:white;border-color: white;">';
                                           
                                            echo "</td>";
                                            echo "</form>";
                                            
                                            
                                            $result2 = $pdo->query('SELECT user.first_Name,user.last_Name FROM user WHERE "'.$row["student_ID"].'" = user.user_ID');
                                            while($row = $result2->fetch(PDO::FETCH_ASSOC))
                                            {
                                                echo "<td>". $row["first_Name"] . ' ' . $row["last_Name"] ."</td>";
                                            }
                                            echo "</tr>";
                                           
                                            
							                
                                        }
                                        
                                        
                                        
                                    ?>
                                </td>
                            </tr>
							</tr>
						</tbody>
					    </div>
                        </td></tr>
                        
                    </table>
                    
				</section>
				<br><br><br><br><br><br><br><br><br><br><br><br>
			</div>
		</div>
		<footer>
            <div></div>
        </footer>
	</body>
</html>