

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
			<div class="bg" style="padding-bottom:960px;">
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
									<button onclick="window.location.href = 'UserDataManagerFaculty.php'" class=adminNav; style="background-color:#006a4e;font-size:80%;margin-top:0px;height:58px;">User Data<br>Manager</button>
								</td>
								<td>
									<button onclick="window.location.href = 'ScheduleDataManagerFaculty.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Schedule<br>Manager</button>
								</td>
								<td>
									<button onclick="window.location.href = 'AcademicDataManagerFaculty.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Academic<br>Manager</button>
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
                    <table id="userDataManager" style="display:block;">
                        <tr><td>
					    <div id="showUserDataElementMyInfo">
						<thead>
							<tr>
								<th>View My Information</th>
							</tr>
						</thead>
						<tbody style="margin-bottom:100px;">
							<tr><td>
									<form action="UserDataManagerFaculty.php" method="POST">
										<input type="submit" value="See More" name="user_Search_submit"></button>
									</form>
									<?php 
									$infocounter = 1;
									if (isset($_POST["user_Search_submit"])) {
                                        $result = $pdo->query('SELECT * FROM department,faculty_department,user,faculty WHERE department.dept_ID = faculty_department.dept_ID AND faculty_department.faculty_ID = faculty.faculty_ID AND faculty.faculty_ID = user.user_ID AND user.user_ID = '.$_SESSION["user_ID"]);
                                            
                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                            if ($infocounter == 1)
                                            {
                                            echo "<b>User ID: </b>" .$row["user_ID"] ."<br>" .
                                             "<b>Name: </b>" .$row["first_Name"] ." " .$row["last_Name"] ."<br>" .
                                             "<b>Gender: </b>" .$row["Gender"] ."<br>" .
                                             "<b>Date of birth: </b>" .$row["DOB"] ."<br>" .
                                             "<b>City: </b>" .$row["City"] ."<br>" ."<b>Street: </b>" .$row["Street"] ."<br>".
                                             "<b>State: </b>" .$row["State"] ."<br>" .
                                             "<b>Zip Code: </b>" .$row["zip_Code"] ."<br>" .
                                             "<b>User type: </b>" .$row["user_Type"] ."<br>".
                                             "<b>Faculty Type: </b>" .$row["faculty_Type"] ."<br>".
                                             "<b>Faculty Rank: </b>" .$row["faculty_Rank"] ."<br><br>";
                                            }
                                            $infocounter++;
                                            $dep_percent = 0;
                                            
                                            
                                             
                                            $result = $pdo->query('SELECT COUNT(*),dept_Name,room_ID FROM department,faculty_department,user,faculty WHERE department.dept_ID = faculty_department.dept_ID AND faculty_department.faculty_ID = faculty.faculty_ID AND faculty.faculty_ID = user.user_ID AND user.user_ID = '.$_SESSION["user_ID"]);
                                             while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                                             {
                                                 
                                                 if ($row["COUNT(*)"] == 3)
                                            {
                                                $dep_percent = 33.33;
                                               
                                            }
                                            if ($row["COUNT(*)"] == 2)
                                            {
                                                
                                                $dep_percent = 50;
                                                
                                            }
                                            if ($row["COUNT(*)"] == 1)
                                            {
                                                $dep_percent = 100;
                                                
                                            }
                                             }
                                            $result = $pdo->query('SELECT * FROM department,faculty_department,user,faculty WHERE department.dept_ID = faculty_department.dept_ID AND faculty_department.faculty_ID = faculty.faculty_ID AND faculty.faculty_ID = user.user_ID AND user.user_ID = '.$_SESSION["user_ID"]);
                                            
                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                            
                                             echo "<b>Department: </b>" .$row["dept_Name"] ."<br>".""."<b>Office: </b>". $row["room_ID"] ."<br>".
                                             "<b>Department Commitment Percentage: </b>". $dep_percent . "%"."<br><br>"; 
                                             }
                                            
                                             
                                        }
                                    }?>
								</td>
							</tr>
						</tbody>
					    </div>
                        </td></tr>
                        <tr><td>
					    <div id="showUserDataElementUpdateUser" style="display:block;">
						<thead>
							<tr>
								<th>Update My Information</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="UserDataManagerFaculty.php" method="POST">
										
										<input type="text" name="update_first_Name" placeholder="First name"><br>
										<input type="text" name="update_last_Name" placeholder="Last name"><br>
										<input type="text" name="update_Gender" placeholder="Gender"><br>
										<input type="text" name="update_DOB" placeholder="Date of birth"><br>
										<input type="text" name="update_City" placeholder="City"><br>
										<input type="text" name="update_Street" placeholder="Street"><br>
										<input type="text" name="update_State" placeholder="State"><br>
										<input type="text" name="update_zip_Code" placeholder="Zip code"><br>
										<input type="text" name="update_user_Password" placeholder="Password"><br>
										<input type="submit" name="user_Update_submit">
										<input type="reset" name="user_Update_reset">
									</form>
									<?php 
									if (isset($_POST["user_Update_submit"])) {
                                        
                                            $user_ID = $_SESSION["user_ID"];
                                            $first_Name = $_POST["update_first_Name"];
                                            $last_Name = $_POST["update_last_Name"];
                                            $Gender = $_POST["update_Gender"];
                                            $DOB = $_POST["update_DOB"];
                                            $City = $_POST["update_City"];
                                            $Street = $_POST["update_Street"];
                                            $State = $_POST["update_State"];
                                            $zip_Code = $_POST["update_zip_Code"];
                                            $user_Password = $_POST["update_user_Password"];
                                            if ($first_Name != "") {
                                                $result = $pdo->query('UPDATE user SET first_Name = "' .$first_Name .'" WHERE user_ID = ' .$user_ID);
                                            }
                                            if ($last_Name != "") {
                                            $result = $pdo->query('UPDATE user SET last_Name = "' .$last_Name .'" WHERE user_ID = ' .$user_ID);
                                            }
                                            if ($Gender != "") {
                                                $result = $pdo->query('UPDATE user SET Gender = "' .$Gender .'" WHERE user_ID = ' .$user_ID);
                                            }
                                            if ($DOB != "") {
                                                $result = $pdo->query('UPDATE user SET DOB = "' .$DOB .'" WHERE user_ID = ' .$user_ID);
                                            }
                                            if ($City != "") {
                                                $result = $pdo->query('UPDATE user SET City = "' .$City .'" WHERE user_ID = ' .$user_ID);
                                            }
                                            if ($Street != "") {
                                                $result = $pdo->query('UPDATE user SET Street = "' .$Street .'" WHERE user_ID = ' .$user_ID);
                                            }
                                            if ($State != "") {
                                                $result = $pdo->query('UPDATE user SET State = "' .$State .'" WHERE user_ID = ' .$user_ID);
                                            }
                                            if ($zip_Code != "") {
                                                $result = $pdo->query("UPDATE user SET zip_Code = " .$zip_Code ." WHERE user_ID = " .$user_ID);
                                            }
                                            if ($user_Password != "") {
                                                $result = $pdo->query("UPDATE login SET user_password = " .$user_Password ." WHERE user_ID = " .$user_ID);
                                            }
                                            
                                        } 
                                     
                                    ?>
								</td>
							</tr>
						</tbody>
					    </div>
                        </td></tr>
                        <tr><td>
					    <div id="showUserDataElementViewUser">
						<thead>
							<tr>
								<th>View Student Data</th>
							</tr>
						</thead>
						<tbody style="margin-bottom:100px;">
							<tr><td>
									<form action="UserDataManagerFaculty.php" method="POST">
										<input type="text" name="user_Search" placeholder = "Enter student ID"><br>
										<input type="submit" name="user_Search_submit"></button>
										<input type="reset" name="user_Search_reset">
									</form>
									<?php 
									if (isset($_POST["user_Search_submit"])) {
                                        if (!empty($_POST["user_Search"])) {
                                            $user_Input = $_POST["user_Search"];
                                            $result = $pdo->query("SELECT * FROM user, login WHERE (user.user_Type = 'Graduate' OR user.user_Type = 'Undergraduate') AND user.user_ID = login.user_ID AND user.user_ID = " .$user_Input);
                                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                echo "User ID: " .$row["user_ID"] ."<br>" .
                                                 "Name: " .$row["first_Name"] ." " .$row["last_Name"] ."<br>" .
                                                 "Gender: " .$row["Gender"] ."<br>" .
                                                 "Date of birth: " .$row["DOB"] ."<br>" .
                                                 "City: " .$row["City"] ."<br>" ."Street: " .$row["Street"] ."<br>" ."State: " .$row["State"] ."<br>" .
                                                 "User type: " .$row["user_Type"] ."<br>" .
                                                 "Email: " .$row["user_Email"] ."<br>";
                                                 
                                            }
                                        }else{
                                            echo "Enter a user ID!";
                                        }
                                    }?>
								</td>
							</tr>
						</tbody>
					    </div>
                        </td></tr>
                        <tr><td>
					    <div id="showUserDataElementViewHold">
						<thead>
							<tr>
								<th>View Student Holds</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="UserDataManagerFaculty.php" method="POST">
										<input type="text" name="student_Hold_search" placeholder = "Enter student ID"><br>
										<input type="submit" name="student_Hold_submit">
										<input type="reset" name="student_Hold_reset">
									</form>

									<?php 
									if (isset($_POST["student_Hold_submit"])) {
                                        if (!empty($_POST["student_Hold_search"])) {
                                            $user_Input = $_POST["student_Hold_search"];
                                            $result = $pdo->query("SELECT student_hold.student_ID, user.first_Name, user.last_Name, hold.hold_Type, student_hold.hold_Date FROM user, `hold`, `student_hold` WHERE hold.hold_ID = student_hold.hold_ID AND user.user_ID = student_hold.student_ID AND student_hold.student_ID = " .$user_Input);
                                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                echo "Student ID: " .$row["student_ID"] ."<br>" .
                                                  "Name: " .$row["first_Name"] ." " .$row["last_Name"] ."<br>" ."Hold: " .
                                                  $row["hold_Type"] ."<br>" .
                                                  "Placed on: " .$row["hold_Date"] ."<br>";
                                            }
                                        } else {
                                            echo "Enter a valid student ID";
                                        }
                                    } ?>
								</td>
							</tr>
						</tbody>
					    </div>
                        </td></tr>
                        <tr><td>
					    <div id="showUserDataElementViewAdvisee">
						<thead>
							<tr>
								<th>View Advisees</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="UserDataManagerFaculty.php" method="POST">
										<select name = "advisee_search">
										    <?php
										        $result = $pdo->query('SELECT * FROM advisor WHERE faculty_ID = '.$_SESSION["user_ID"]);
										        while($row = $result->fetch(PDO::FETCH_ASSOC))
										        {
										            echo "<option>".$row["student_ID"]."</option>";
										        }
										    ?>
										</select>
										<input type = "submit" name = "advisee_submit" value = "View Advisee">
									</form>
									<?php
									    if(isset($_POST["advisee_submit"]))
									    {
									        $result = $pdo->query('SELECT * FROM user WHERE user_ID = '.$_POST["advisee_search"]);
									        while($row = $result->fetch(PDO::FETCH_ASSOC))
									        {
									            echo "Name: " .$row["first_Name"] ." " .$row["last_Name"] ."<br>" .
                                                 "Gender: " .$row["Gender"] ."<br>" .
                                                 "Date of birth: " .$row["DOB"] ."<br>" .
                                                 "City: " .$row["City"] ."<br>" ."Street: " .$row["Street"] ."<br>" ."State: " .$row["State"] ."<br>"." Zip Code: " .$row["zip_Code"] ."<br>" .
                                                 "User type: " .$row["user_Type"];
									        }
									    }
									?>
								</td>
							</tr>
							
							<tr><td>
					    <div id="showScheduleUndergrad" style="display:block;">
						<thead>
							<tr>
								<th>My Schedule</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
								    <form  method="POST">
								        <select name = "faculty_semester">
                                            <option>2023-S</option>
                                            <option>2022-F</option>
                                        </select>
                                        <input type = "submit" name = "faculty_schedule" value = "View Schedule"><br>
                                        <?php
                                            if(isset($_POST["faculty_schedule"]))
                                            {
                                                $result = $pdo->query('SELECT distinct * FROM faculty_history,class,enrollment WHERE class.CRN = enrollment.CRN AND faculty_history.CRN = class.CRN ORDER BY class.course_ID DESC LIMIT 1');
                                                while($row = $result->fetch(PDO::FETCH_ASSOC))
                                                {
                                                    
                                                    echo "Course: ".$row["course_ID"]."<br>"
                                                    . "Semester: ".$row["semester_ID"]."<br>"
                                                    . "Room: ".$row["room_ID"]."<br><br>";
                                                    
                                                    
                                                }
                                            }
                                        ?>
								    </form>
								</td>
							</tr>
						</tbody>
						</div>
					    </td></tr>
							
							
							
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
	</body>
</html>