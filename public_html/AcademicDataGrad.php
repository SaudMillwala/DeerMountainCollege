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
								    <button onclick="window.location.href = 'AcademicDataGrad.php'" class=adminNav; style="background-color:#006a4e;font-size:80%;margin-top:0px;height:58px;">Academic<br>Information</button>
							    </td>
							    <td>
								    <button onclick="window.location.href = 'StudentTranscriptGrad.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Unofficial<br>Transcript</button>
							    </td>
							    <td>
								    <button onclick="window.location.href = 'StudentDegreeAuditGrad.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Degree<br>Audit</button>
							    </td>
								
						    </tr>
					    </tbody>
				    </table>
                    <form action = "AcademicDataGrad.php" method = "POST">
                    <table id="academicDataManager" style="display:block;">
					    <tr><td>
					    <div id="showScheduleDataFilterSearch">
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
								<th>Search and Filter Master Schedules</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="ScheduleDataManager.php" method="POST">
										<select name = "semester">
            							    <?php
							                    $result = $pdo->query('SELECT * FROM semester GROUP BY AUTO desc');
							                    while($row = $result->fetch(PDO::FETCH_ASSOC))
                    							{
                    							    echo '<option value = "'.$row["semester_ID"].'">' . $row["semester_Name"] . ' (' . $row["Operation"] . ')' .  '</option>';
                							    }
            							    ?>
            							</select>
            							<select name = "department">
            							    
            							    <?php
            							        $result = $pdo->query('SELECT * FROM department WHERE ACTIVE = 1 ORDER BY dept_ID');
            							        while($row = $result->fetch(PDO::FETCH_ASSOC))
            							        {
            							            echo '<option value = "'.$row["dept_ID"].'">'.$row["dept_Name"].'</option>';
            							        }
            							    ?>
        							    </select>
        							    <input type = "submit" name = "schedule_search" value = "Select a department"><br>
        							    <select name = "courses">
        							        <?php
        							            $result = $pdo->query('SELECT class.CRN, class.course_ID, course.course_Name, class.section_Num, class.faculty_ID, user.first_Name, user.last_Name, class.time_Slot_ID, schedule.day_ID, schedule.start_Time, schedule.end_Time, class.room_ID, class.semester_ID, semester.semester_Name, class.seat_Avail FROM class, course, user, schedule, semester WHERE course.ACTIVE = 1 AND class.faculty_ID = user.user_ID AND class.course_ID = course.course_ID AND class.time_Slot_ID = schedule.time_Slot_ID AND class.semester_ID = semester.semester_ID AND class.semester_ID = "'.$_POST["semester"].'" AND class.course_ID LIKE "%'.$_POST["department"].'%"');
        							            while($row = $result->fetch(PDO::FETCH_ASSOC))
        							            {
        							                echo '<option value = "'.$row["course_Name"].'">'.$row["course_ID"].' - '.$row["course_Name"].'</option>';
        							            }
        							        ?>
        							    </select>
        							    <input type = "submit" name = "filter_courses" value = "Select a course"><br>
        							    <select name = "faculty">
        							        <?php
        							            $result = $pdo->query('SELECT class.CRN, class.course_ID, course.course_Name, class.section_Num, class.faculty_ID, user.first_Name, user.last_Name, class.time_Slot_ID, schedule.day_ID, schedule.start_Time, schedule.end_Time, class.room_ID, class.semester_ID, semester.semester_Name, class.seat_Avail FROM class, course, user, schedule, semester WHERE course.ACTIVE = 1 AND class.faculty_ID = user.user_ID AND class.course_ID = course.course_ID AND class.time_Slot_ID = schedule.time_Slot_ID AND class.semester_ID = semester.semester_ID AND class.semester_ID = "'.$_POST["semester"].'" AND class.course_ID LIKE "%'.$_POST["department"].'%" GROUP BY faculty_ID');
        							            while($row = $result->fetch(PDO::FETCH_ASSOC))
        							            {
        							                echo '<option value = "'.$row["faculty_ID"].'">'.$row["first_Name"].' '.$row["last_Name"].'</option>';
        							            }
        							        ?>
        							    </select>
        							    <input type = "submit" name = "filter_faculty" value = "Select a faculty"><br>
        							    <select name = "time">
        							        <?php
        							            $result = $pdo->query('SELECT class.CRN, class.course_ID, course.course_Name, class.section_Num, class.faculty_ID, user.first_Name, user.last_Name, class.time_Slot_ID, schedule.day_ID, schedule.start_Time, schedule.end_Time, class.room_ID, class.semester_ID, semester.semester_Name, class.seat_Avail FROM class, course, user, schedule, semester WHERE course.ACTIVE = 1 AND class.faculty_ID = user.user_ID AND class.course_ID = course.course_ID AND class.time_Slot_ID = schedule.time_Slot_ID AND class.semester_ID = semester.semester_ID AND class.semester_ID = "'.$_POST["semester"].'" AND class.course_ID LIKE "%'.$_POST["department"].'%" GROUP BY time_Slot_ID');
        							            while($row = $result->fetch(PDO::FETCH_ASSOC))
        							            {
        							                echo '<option value = "'.$row["time_Slot_ID"].'">'.$row["day_ID"].' / '.$row["start_Time"].' - '.$row["end_Time"].'</option>';
        							            }
        							        ?>
        							    </select>
        							    <input type = "submit" name = "filter_time" value = "Select a time period"><br>
        							    <select name = "room">
        							        <?php
        							            $result = $pdo->query('SELECT class.CRN, class.course_ID, course.course_Name, class.section_Num, class.faculty_ID, user.first_Name, user.last_Name, class.time_Slot_ID, schedule.day_ID, schedule.start_Time, schedule.end_Time, class.room_ID, class.semester_ID, semester.semester_Name, class.seat_Avail FROM class, course, user, schedule, semester WHERE course.ACTIVE = 1 AND class.faculty_ID = user.user_ID AND class.course_ID = course.course_ID AND class.time_Slot_ID = schedule.time_Slot_ID AND class.semester_ID = semester.semester_ID AND class.semester_ID = "'.$_POST["semester"].'" AND class.course_ID LIKE "%'.$_POST["department"].'%" GROUP BY room_ID');
        							            while($row = $result->fetch(PDO::FETCH_ASSOC))
        							            {
        							                echo '<option value = "'.$row["room_ID"].'">'.$row["room_ID"].'</option>';
        							            }
        							        ?>
        							    </select>
        							    <input type = "submit" name = "filter_room" value = "Select a room"><br>
        							    <select name = "seats">
        							        <?php
        							            $result = $pdo->query('SELECT class.CRN, class.course_ID, course.course_Name, class.section_Num, class.faculty_ID, user.first_Name, user.last_Name, class.time_Slot_ID, schedule.day_ID, schedule.start_Time, schedule.end_Time, class.room_ID, class.semester_ID, semester.semester_Name, class.seat_Avail FROM class, course, user, schedule, semester WHERE course.ACTIVE = 1 AND class.faculty_ID = user.user_ID AND class.course_ID = course.course_ID AND class.time_Slot_ID = schedule.time_Slot_ID AND class.semester_ID = semester.semester_ID AND class.semester_ID = "'.$_POST["semester"].'" AND class.course_ID LIKE "%'.$_POST["department"].'%"');
        							            while($row = $result->fetch(PDO::FETCH_ASSOC))
        							            {
        							                echo '<option value = "'.$row["course_ID"].'">'.$row["course_ID"].' - '.$row["seat_Avail"].' seats left '.'</option>';
        							            }
        							        ?>
        							    </select>
        							    <input type = "submit" name = "filter_seats" value = "Select a class">
    							    <br>
    							    <?php
        							    if(isset($_POST["schedule_search"]))
        							    {
    							            $result = $pdo->query('DELETE FROM temp_class');
    							            $result = $pdo->query('INSERT INTO temp_class (SELECT class.CRN, class.course_ID, course.course_Name, class.section_Num, class.faculty_ID, user.first_Name, user.last_Name, class.time_Slot_ID, schedule.day_ID, schedule.start_Time, schedule.end_Time, class.room_ID, class.semester_ID, semester.semester_Name, class.seat_Avail FROM class, course, user, schedule, semester WHERE class.faculty_ID = user.user_ID AND class.course_ID = course.course_ID AND class.time_Slot_ID = schedule.time_Slot_ID AND class.semester_ID = semester.semester_ID AND class.semester_ID = "'.$_POST["semester"].'" AND class.course_ID LIKE "%'.$_POST["department"].'%")');
    							            $result = $pdo->query('SELECT * FROM temp_class');
    							            while($row = $result->fetch(PDO::FETCH_ASSOC))
    							            {
    							                echo 'CRN: ' . $row["CRN"] . '<br>'
    							                . 'Course: ' . $row["course_ID"] . ' - ' . $row["course_Name"] . '<br>'
    							                . 'Section: ' . $row["section_Num"] . '<br>'
    							                . 'Faculty ID: ' . $row["faculty_ID"] . '<br>'
    							                . 'Faculty name:  ' . $row["first_Name"] . ' ' . $row["last_Name"] . '<br>'
    							                . 'Days: ' . $row["day_ID"] . '<br>'
    							                . 'Time: ' . $row["start_Time"] . ' - ' . $row["end_Time"] . '<br>'
    							                . 'Room: ' . $row["room_ID"] . '<br>'
    							                . 'Semester: ' . $row["semester_Name"] . '<br>'
    							                . 'Capacity: ' . $row["seat_Avail"] . '<br><br>';
    							            }
    							        }
    							    ?>
    							    <?php
    							        if(isset($_POST["filter_courses"]))
    							        {
    							            $result = $pdo->query('SELECT * from temp_class WHERE course_Name = "'.$_POST["courses"].'"');
    							            while($row = $result->fetch(PDO::FETCH_ASSOC))
    							            {
    							                echo 'CRN: ' . $row["CRN"] . '<br>'
    							                . 'Course: ' . $row["course_ID"] . ' - ' . $row["course_Name"] . '<br>'
    							                . 'Section: ' . $row["section_Num"] . '<br>'
    							                . 'Faculty ID: ' . $row["faculty_ID"] . '<br>'
    							                . 'Faculty name:  ' . $row["first_Name"] . ' ' . $row["last_Name"] . '<br>'
    							                . 'Days: ' . $row["day_ID"] . '<br>'
    							                . 'Time: ' . $row["start_Time"] . ' - ' . $row["end_Time"] . '<br>'
    							                . 'Room: ' . $row["room_ID"] . '<br>'
    							                . 'Semester: ' . $row["semester_Name"] . '<br>'
    							                . 'Capacity: ' . $row["seat_Avail"] . '<br><br>';
    							            }
    							        }
    							    ?>
    							    <?php
    							        if(isset($_POST["filter_faculty"]))
    							        {
    							            $result = $pdo->query('SELECT * from temp_class WHERE faculty_ID = '.$_POST["faculty"]);
    							            while($row = $result->fetch(PDO::FETCH_ASSOC))
    							            {
    							                echo 'CRN: ' . $row["CRN"] . '<br>'
    							                . 'Course: ' . $row["course_ID"] . ' - ' . $row["course_Name"] . '<br>'
    							                . 'Section: ' . $row["section_Num"] . '<br>'
    							                . 'Faculty ID: ' . $row["faculty_ID"] . '<br>'
    							                . 'Faculty name:  ' . $row["first_Name"] . ' ' . $row["last_Name"] . '<br>'
    							                . 'Days: ' . $row["day_ID"] . '<br>'
    							                . 'Time: ' . $row["start_Time"] . ' - ' . $row["end_Time"] . '<br>'
    							                . 'Room: ' . $row["room_ID"] . '<br>'
    							                . 'Semester: ' . $row["semester_Name"] . '<br>'
    							                . 'Capacity: ' . $row["seat_Avail"] . '<br><br>';
    							            }
    							        }
    							    ?>
    							    <?php
    							        if(isset($_POST["filter_time"]))
    							        {
    							            $result = $pdo->query('SELECT * from temp_class WHERE time_Slot_ID = "'.$_POST["time"].'"');
    							            while($row = $result->fetch(PDO::FETCH_ASSOC))
    							            {
    							                echo 'CRN: ' . $row["CRN"] . '<br>'
    							                . 'Course: ' . $row["course_ID"] . ' - ' . $row["course_Name"] . '<br>'
    							                . 'Section: ' . $row["section_Num"] . '<br>'
    							                . 'Faculty ID: ' . $row["faculty_ID"] . '<br>'
    							                . 'Faculty name:  ' . $row["first_Name"] . ' ' . $row["last_Name"] . '<br>'
    							                . 'Days: ' . $row["day_ID"] . '<br>'
    							                . 'Time: ' . $row["start_Time"] . ' - ' . $row["end_Time"] . '<br>'
    							                . 'Room: ' . $row["room_ID"] . '<br>'
    							                . 'Semester: ' . $row["semester_Name"] . '<br>'
    							                . 'Capacity: ' . $row["seat_Avail"] . '<br><br>';
    							            }
    							        }
    							    ?>
    							    <?php
            							if(isset($_POST["filter_room"]))
            							{
                							$result = $pdo->query('SELECT * from temp_class WHERE room_ID = "'.$_POST["room"].'"');
                							while($row = $result->fetch(PDO::FETCH_ASSOC))
                							{
                    							echo 'CRN: ' . $row["CRN"] . '<br>'
							                    . 'Course: ' . $row["course_ID"] . ' - ' . $row["course_Name"] . '<br>'
    							                . 'Section: ' . $row["section_Num"] . '<br>'
    							                . 'Faculty ID: ' . $row["faculty_ID"] . '<br>'
    							                . 'Faculty name:  ' . $row["first_Name"] . ' ' . $row["last_Name"] . '<br>'
    							                . 'Days: ' . $row["day_ID"] . '<br>'
    							                . 'Time: ' . $row["start_Time"] . ' - ' . $row["end_Time"] . '<br>'
    							                . 'Room: ' . $row["room_ID"] . '<br>'
    							                . 'Semester: ' . $row["semester_Name"] . '<br>'
    							                . 'Capacity: ' . $row["seat_Avail"] . '<br><br>';
    							            }
    							        }
    							    ?>
    							    <?php
    							        if(isset($_POST["filter_seats"]))
    							        {
    							            $result = $pdo->query('SELECT * from temp_class WHERE course_ID = "'.$_POST["seats"].'"');
    							            while($row = $result->fetch(PDO::FETCH_ASSOC))
    							            {
    							                echo 'CRN: ' . $row["CRN"] . '<br>'
    							                . 'Course: ' . $row["course_ID"] . ' - ' . $row["course_Name"] . '<br>'
    							                . 'Section: ' . $row["section_Num"] . '<br>'
    							                . 'Faculty ID: ' . $row["faculty_ID"] . '<br>'
    							                . 'Faculty name:  ' . $row["first_Name"] . ' ' . $row["last_Name"] . '<br>'
    							                . 'Days: ' . $row["day_ID"] . '<br>'
    							                . 'Time: ' . $row["start_Time"] . ' - ' . $row["end_Time"] . '<br>'
    							                . 'Room: ' . $row["room_ID"] . '<br>'
    							                . 'Semester: ' . $row["semester_Name"] . '<br>'
    							                . 'Capacity: ' . $row["seat_Avail"] . '<br><br>';
    							            }
    							        }
    							    ?>
									</form>
								</td>
							</tr>
						</tbody>
					</div>
					    </td></tr>
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