<?php
session_start();

if ($_SESSION["status"] != true) {
    header("Location: login.php");
}

if ($_SESSION["status"] == true) {
    $_SESSION["admin"] = true;
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
		<title>Admin Portal</title>
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
			<div class="bg" style="padding-bottom:1000px;">
				<header id="header">
					<div class=logoContainer>
						<button onclick="panelOpen()" class='panelButton' id='panelButton'>☰</button>
						<img src="https://i.imgur.com/ZSJeGdX.png" id="logo" alt="logo" onclick = "window.location.href = 'index.html'">
						<img src="https://i.imgur.com/4WU9EeP.png" alt="titleImg" class=' logoContainer titleImg' height="150px" onclick = "window.location.href = 'index.html'">
					</div>

					<div class=loginContainer>
						<form action="admin.php" method="POST">
							<button class=logButton type="submit" name="logout">LOGOUT</button><br>
						</form>
						<button class=logButton onclick="window.location.href = 'index.html'">HOMEPAGE</button>
					</div>
				</header>
				<section>
					<div class=adminContainer>
					    <h1 style="font-size:30px;">Administrator Portal</h1>
					    <?php 
					    if ($_SESSION["user_Type"] != "Admin"){
					        if ($_SESSION["user_Type"] == "Faculty"){
					            header("Location: faculty.php");
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
						<form action="admin.php" method="POST">
							<input class="reset-btn" type="submit" name="refresh" value="Refresh Page">
						</form>
					</div>
					<?php
                    if (isset($_POST["logout"])) {
                        header("Location: logout.php");
                    }
                    if (isset($_POST["refresh"])) {
                        header("Location: admin.php");
                    }
                    ?>
					<table style="padding-bottom:10px;width:119%;">
						<tbody style="text-align: center; ">
							<tr colspan="6">
								
								<td>
									<button onclick="window.location.href = 'UserDataManager.php'" class=adminNav; style="background-color:#006a4e;font-size:80%;margin-top:0px;height:58px;">User Data<br>Manager</button>
								</td>
								<td>
									<button onclick="window.location.href = 'ScheduleDataManager.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Schedule<br>Manager</button>
								</td>
								<td>
									<button onclick="window.location.href = 'AcademicDataManager.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Academic<br>Manager</button>
								</td>
								<td>
									<button onclick="window.location.href = 'StudentTranscript.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Student<br>Transcripts</button>
								</td>
								<td>
									<button onclick="window.location.href = 'StudentDegreeAudit.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Student<br>Degree Audit</button>
								</td>
								<td>
									<button onclick="window.location.href = 'PasswordResetManager.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Password Reset<br>Manager</button>
								</td>
							</tr>
						</tbody>
					</table>
                    <table id="userDataManager" style="display:block;">
                        <tr><td>
					    <div id="showUserDataElementViewUser" style="display:block;">
						<thead>
							<tr>
								<th>View Users</th>
							</tr>
						</thead>
						<tbody style="margin-bottom:100px;">
							<tr><td>
									<form action="UserDataManager.php" method="POST">
										<input type="text" name="user_Search"placeholder="Enter user ID"><br>
										<input type="submit" name="user_Search_submit"></button>
										<input type="reset" name="user_Search_reset">
									</form>
									<?php 
									$infocounter = 1;
									if (isset($_POST["user_Search_submit"])) {
                                        if (!empty($_POST["user_Search"])) {
                                            $user_Input = $_POST["user_Search"];
                                            $result = $pdo->query("SELECT * FROM user, login WHERE user.user_ID = login.user_ID AND user.user_ID = " .$user_Input);
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
                                                 "<b>Email: </b>" .$row["user_Email"] ."<br>";
                                            }
                                            
                                                 if ($row["user_Type"] = "faculty")
                                                 {
                                                     $result = $pdo->query('SELECT * FROM department,faculty_department,user,faculty WHERE department.dept_ID = faculty_department.dept_ID AND faculty_department.faculty_ID = faculty.faculty_ID AND faculty.faculty_ID = user.user_ID AND user.user_ID = ' .$user_Input);
                                                     while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                               if ($infocounter == 1)
                                            {
                                                echo "<b>Faculty Type: </b>" .$row["faculty_Type"] ."<br>".
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
                                                 
                                                 
                                                 }
                                                 
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
					    <div id="showUserDataElementViewHold" style="display:block;">
						<thead>
							<tr>
								<th>View Student Holds</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="UserDataManager.php" method="POST">
										<input type="text" name="student_Hold_search"placeholder="Enter student ID"><br>
										<input type="submit" name="student_Hold_submit">
										<input type="reset" name="student_Hold_reset">
									</form>

									<?php 
									if (isset($_POST["student_Hold_submit"]))
									{
                                        if (!empty($_POST["student_Hold_search"]))
                                        {
                                            $user_Input = $_POST["student_Hold_search"];
                                            $result = $pdo->query("SELECT student_hold.student_ID, user.first_Name, user.last_Name, hold.hold_type, student_hold.hold_Date FROM user, `hold`, `student_hold` WHERE hold.hold_ID = student_hold.hold_ID AND user.user_ID = student_hold.student_ID AND student_hold.student_ID = " .$user_Input);
                                            while ($row = $result->fetch(PDO::FETCH_ASSOC))
                                            {
                                                echo "Student ID: " .$row["student_ID"] ."<br>" .
                                                  "Name: " .$row["first_Name"] ." " .$row["last_Name"] ."<br>" ."Hold: " .
                                                  $row["hold_type"] ."<br>" .
                                                  "Placed on: " .$row["hold_Date"] ."<br><br>";
                                            }
                                        } else
                                        {
                                            echo "Enter a valid student ID";
                                        }
                                    } ?>
								</td>
							</tr>
						</tbody>
					    </div>
                        </td></tr>
                        <tr><td>
					    <div id="showUserDataElementAddUser" style="display:block;">
						<thead>
							<tr>
								<th>Add Users</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="UserDataManager.php" method="POST">
										<label for="user_Type">Select User Type:</label>
										<select id="user_Type" name="user_Type" onchange="returnForm()">
											<option selected disabled></option>
											<option disabled>----Student</option>
											<option disabled>--Undergrad</option>
											<option value="UserUndergradPartTime">Part-time</option>
											<option value="UserUndergradFullTime">Full-time</option>
											<option disabled>--Graduate</option>
											<option value="UserGraduatePartTime">Part-time</option>
											<option value="UserGraduateFullTime">Full-time</option>
											<option disabled></option>
											<option disabled>----Faculty</option>
											<option value="UserFacultyPartTime">Part-time</option>
											<option value="UserFacultyFullTime">Full-time</option>
											<option disabled></option>
											<option value="UserResearchStaff">Research Staff</option>
											<option disabled></option>
											<option value="UserAdmin">Admin</option>
										</select>

										<div id="UserUndergradPartTime" style="display:none;">
											UndergradPartTimeForm<br>
											<input type="text" name="add_first_Name" placeholder="First name">
											<input type="text" name="add_last_Name" placeholder="Last name"><br>
											<select name = "gender"><option>M</option><option>F</option></select>
											<input type="text" name="add_DOB" placeholder="Date of birth"><br>
											<input type="text" name="add_City" placeholder="City">
											<input type="text" name="add_Street" placeholder="Street"><br>
											<input type="text" name="add_State" placeholder="State">
											<input type="number" name="add_zip_Code" placeholder="Zip code"><br>
											<input type="text" name="add_user_Email" placeholder="Email (Name only)" maxlength="10"><br>
											<input type="password" name="add_user_Password" placeholder="Password"><br>
											<input type="submit" name="part_time_undergrad">
											<input type="reset" name="user_Create_reset">
										</div>

										<div id="UserUndergradFullTime" style="display:none;">
											UndergradFullTimeForm<br>
											<input type="text" name="add_first_Name" placeholder="First name">
											<input type="text" name="add_last_Name" placeholder="Last name"><br>
											<select name = "gender"><option>M</option><option>F</option></select>
											<input type="text" name="add_DOB" placeholder="Date of birth"><br>
											<input type="text" name="add_City" placeholder="City">
											<input type="text" name="add_Street" placeholder="Street"><br>
											<input type="text" name="add_State" placeholder="State">
											<input type="number" name="add_zip_Code" placeholder="Zip code"><br>
											<input type="text" name="add_user_Email" placeholder="Email (Name only)" maxlength="10"><br>
											<input type="password" name="add_user_Password" placeholder="Password"><br>
											<input type="submit" name="full_time_undergrad">
											<input type="reset" name="user_Create_reset">
										</div>
										<div id="UserGraduatePartTime" style="display:none;">
											GraduatePartTimeForm<br>
											<input type="text" name="add_first_Name" placeholder="First name">
											<input type="text" name="add_last_Name" placeholder="Last name"><br>
											<select name = "gender"><option>M</option><option>F</option></select>
											<input type="text" name="add_DOB" placeholder="Date of birth"><br>
											<input type="text" name="add_City" placeholder="City">
											<input type="text" name="add_Street" placeholder="Street"><br>
											<input type="text" name="add_State" placeholder="State">
											<input type="number" name="add_zip_Code" placeholder="Zip code"><br>
											<input type="text" name="add_user_Email" placeholder="Email (Name only)" maxlength="10"><br>
											<input type="password" name="add_user_Password" placeholder="Password"><br>
											<input type="submit" name="part_time_grad">
											<input type="reset" name="user_Create_reset">
										</div>
										<div id="UserGraduateFullTime" style="display:none;">
											GraduateFullTimeForm<br>
											<input type="text" name="add_first_Name" placeholder="First name">
											<input type="text" name="add_last_Name" placeholder="Last name"><br>
											<select name = "gender"><option>M</option><option>F</option></select>
											<input type="text" name="add_DOB" placeholder="Date of birth"><br>
											<input type="text" name="add_City" placeholder="City">
											<input type="text" name="add_Street" placeholder="Street"><br>
											<input type="text" name="add_State" placeholder="State">
											<input type="number" name="add_zip_Code" placeholder="Zip code"><br>
											<input type="text" name="add_user_Email" placeholder="Email (Name only)" maxlength="10"><br>
											<input type="password" name="add_user_Password" placeholder="Password"><br>
											<input type="submit" name="full_time_grad">
											<input type="reset" name="user_Create_reset">
										</div>
										<div id="UserFacultyPartTime" style="display:none;">
											FacultyPartTimeForm<br>
											<input type="text" name="add_first_Name" placeholder="First name">
											<input type="text" name="add_last_Name" placeholder="Last name"><br>
											<select name = "gender"><option>M</option><option>F</option></select>
											<input type="text" name="add_DOB" placeholder="Date of birth"><br>
											<input type="text" name="add_City" placeholder="City">
											<input type="text" name="add_Street" placeholder="Street"><br>
											<input type="text" name="add_State" placeholder="State">
											<input type="number" name="add_zip_Code" placeholder="Zip code"><br>
											<input type="text" name="add_user_Email" placeholder="Email (Name only)" maxlength="10"><br>
											<input type="password" name="add_user_Password" placeholder="Password"><br>
											<input type="submit" name="part_time_faculty">
											<input type="reset" name="user_Create_reset">
										</div>
										<div id="UserFacultyFullTime" style="display:none;">
											FacultyFullTimeForm<br>
											<input type="text" name="add_first_Name" placeholder="First name">
											<input type="text" name="add_last_Name" placeholder="Last name"><br>
											<select name = "gender"><option>M</option><option>F</option></select>
											<input type="text" name="add_DOB" placeholder="Date of birth"><br>
											<input type="text" name="add_City" placeholder="City">
											<input type="text" name="add_Street" placeholder="Street"><br>
											<input type="text" name="add_State" placeholder="State">
											<input type="number" name="add_zip_Code" placeholder="Zip code"><br>
											<input type="text" name="add_user_Email" placeholder="Email (Name only)" maxlength="10"><br>
											<input type="password" name="add_user_Password" placeholder="Password"><br>
											<input type="submit" name="full_time_faculty">
											<input type="reset" name="user_Create_reset">
										</div>
										<div id="UserResearcher" style="display:none;">
											ResearcherForm<br>
											<input type="text" name="add_first_Name" placeholder="First name">
											<input type="text" name="add_last_Name" placeholder="Last name"><br>
											<select name = "gender"><option>M</option><option>F</option></select>
											<input type="text" name="add_DOB" placeholder="Date of birth"><br>
											<input type="text" name="add_City" placeholder="City">
											<input type="text" name="add_Street" placeholder="Street"><br>
											<input type="text" name="add_State" placeholder="State">
											<input type="number" name="add_zip_Code" placeholder="Zip code"><br>
											<input type="text" name="add_user_Email" placeholder="Email (Name only)" maxlength="10"><br>
											<input type="password" name="add_user_Password" placeholder="Password"><br>
											<input type="submit" name="researcher">
											<input type="reset" name="user_Create_reset">
										</div>
										<div id="UserAdmin" style="display:none;">
											AdminForm<br>
											<input type="text" name="add_first_Name" placeholder="First name">
											<input type="text" name="add_last_Name" placeholder="Last name"><br>
											<select name = "gender"><option>M</option><option>F</option></select>
											<input type="text" name="add_DOB" placeholder="Date of birth"><br>
											<input type="text" name="add_City" placeholder="City">
											<input type="text" name="add_Street" placeholder="Street"><br>
											<input type="text" name="add_State" placeholder="State">
											<input type="number" name="add_zip_Code" placeholder="Zip code"><br>
											<input type="text" name="add_user_Email" placeholder="Email (Name only)" maxlength="10"><br>
											<input type="password" name="add_user_Password" placeholder="Password"><br>
											<input type="submit" name="admin">
											<input type="reset" name="user_Create_reset">
										</div>

										
									</form>
									<?php
        							$result = $pdo->query("SELECT user_ID FROM temp_user ORDER BY AUTO DESC LIMIT 1");
        							while ($row = $result->fetch(PDO::FETCH_ASSOC))
        							{
            							$user_ID = $row["user_ID"];
        							}
        							$result = $pdo->query("SELECT faculty.Office, room.room_Number FROM faculty, room WHERE faculty.Office = room.room_ID ORDER BY faculty.Office DESC LIMIT 1");
        							while ($row = $result->fetch(PDO::FETCH_ASSOC))
        					        {
            							$room_num = $row["room_Number"] + 1;
                                        $FOB = "FOB".$room_num;
        							}
        							if (isset($_POST["user_Create_submit"])) {
            							$first_Name = $_POST["add_first_Name"];
            							$last_Name = $_POST["add_last_Name"];
            							$Gender = $_POST["add_Gender"];
            							$DOB = $_POST["add_DOB"];
            							$City = $_POST["add_City"];
            							$Street = $_POST["add_Street"];
            							$State = $_POST["add_State"];
            							$zip_Code = $_POST["add_zip_Code"];
            							$user_Email = $_POST["add_user_Email"] . "@deermountain.edu";
            							$user_Password = $_POST["add_user_Password"];
            							if (empty($_POST["user_Type"]) || empty($_POST["add_first_Name"]) || empty($_POST["add_last_Name"]) || empty($_POST["add_Gender"]) || empty($_POST["add_DOB"]) || empty($_POST["add_City"]) || empty($_POST["add_Street"]) || empty($_POST["add_State"]) || empty($_POST["add_zip_Code"]) || empty($_POST["add_User_Email"]) || empty($_POST["add_user_Password"])
                							){
                                            echo "<br>Invalid or missing details!";
                                        } elseif (!empty($_POST["user_Type"])) {
                                            if ($Gender == "M") {
                                                $Gender = "M";
                                            } elseif ($Gender == "m") {
                                                $Gender = "M";
                                            } elseif ($Gender == "F") {
                                                $Gender = "F";
                                            } elseif ($Gender == "f") {
                                                $Gender = "F";
                                            } else {
                                                echo "<h1>Invalid gender<h1>";
                                                die();
                                            }
                                            $result = $pdo->query("SELECT user_Email FROM Login");
                                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                if ($user_Email != $row["user_Email"]) {
                                                    if ($_POST["user_Type"] == "Undergraduate") {
                                                        $user_ID = $undergraduate;
                                                        $user_Email = strtolower($user_Email);
                                                        $result = $pdo->query("INSERT INTO User (user_ID, first_Name, last_Name, Gender, DOB, City, Street, State, zip_Code, user_Type) VALUES (" .$user_ID .', "' .$first_Name .'", "' .$last_Name .'", "' .$Gender .'", "' .$DOB .'", "' .$City .'", "' .$Street .'", "' .$State .'", ' .$zip_Code .', "Student")');
                                                        $result = $pdo->query("INSERT INTO Login (user_ID, user_Email, user_Password, user_Type) VALUES (" .$user_ID .', "' .$user_Email .'", "' .$user_Password .'", "Student")');$result = $pdo->query("INSERT INTO Student (student_ID, student_Year,student_Type) VALUES (" .$user_ID .', "Year 1", "Pending")');
                                                        $result = $pdo->query("INSERT INTO Undergraduate (student_ID, undergraduate_Student_Type) VALUES (" .$user_ID .', "Pending")'
                                                        );
                                                        $result = $pdo->query("SELECT * FROM user, login WHERE user.user_ID = login.user_ID AND user.user_ID = " .$user_Input);
                                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                            echo "User ID: " .$row["user_ID"] ."<br>" ."Name: " .$row["first_Name"] ." " .$row["last_Name"] ."<br>" ."Gender: " .$row["Gender"] ."<br>" ."Date of birth: " .$row["DOB"] ."<br>" ."City: " .$row["City"] ."<br>" ."Street: " .$row["Street"] ."<br>" ."State: " .$row["State"] ."<br>" ."User type: " .$row["user_Type"] ."<br>" ."Email: " .$row["user_Email"] ."<br>";
                                                        }
                                                    } elseif ($_POST["user_Type"] == "Graduate") {
                                                        $user_ID = $graduate;
                                                    } elseif ($_POST["user_Type"] == "Faculty") {
                                                        $user_ID = $faculty;
                                                        $user_Email = strtolower($user_Email);
                                                        $result = $pdo->query("INSERT INTO User (user_ID, first_Name, last_Name, Gender, DOB, City, Street, State, zip_Code, user_Type) VALUES (" .$user_ID .', "' .$first_Name .'", "' .$last_Name .'", "' .$Gender .'", "' .$DOB .'", "' .$City .'", "' .$Street .'", "' .$State .'", ' .$zip_Code .', "Faculty")');
                                                        $result = $pdo->query("INSERT INTO Login (user_ID, user_Email, user_Password, user_Type) VALUES (" .$user_ID .', "' .$user_Email .'", "' .$user_Password .'", "Student")');
                                                        $result = $pdo->query("INSERT INTO Faculty (faculty_ID, Office, faculty_Specialty, faculty_Rank, faculty_Type) VALUES (" .$user_ID .', "' .$FOB .'", "Pending", "Pending", "Pending")');$result = $pdo->query("SELECT * FROM user, login WHERE user.user_ID = login.user_ID AND user.user_ID = " .$user_ID);
                                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                            echo "User ID: " .$row["user_ID"] ."<br>" ."Name: " .$row["first_Name"] ." " .$row["last_Name"] ."<br>" ."Gender: " .$row["Gender"] ."<br>" ."Date of birth: " .$row["DOB"] ."<br>" ."City: " .$row["City"] ."<br>" ."Street: " .$row["Street"] ."<br>" ."State: " .$row["State"] ."<br>" ."User type: " .$row["user_Type"] ."<br>" ."Email: " .$row["user_Email"] ."<br>";
                                                        }
                                                    } elseif ($_POST["user_Type"] == "Admin") {
                                                        $user_ID = $admin;
                                                        $user_Email = strtolower($user_Email);
                                                        $result = $pdo->query("INSERT INTO User (user_ID, first_Name, last_Name, Gender, DOB, City, Street, State, zip_Code, user_Type) VALUES (" .$user_ID .', "' .$first_Name .'", "' .$last_Name .'", "' .$Gender .'", "' .$DOB .'", "' .$City .'", "' .$Street .'", "' .$State .'", ' .$zip_Code .', "Faculty")');
                                                        $result = $pdo->query("INSERT INTO Login (user_ID, user_Email, user_Password, user_Type) VALUES (" .$user_ID .', "' .$user_Email .'", "' .$user_Password .'", "Student")');
                                                        $result = $pdo->query("INSERT INTO Admin (admin_ID, Level) VALUES (" .$user_ID .', "Pending")');
                                                        $result = $pdo->query("SELECT * FROM user, login WHERE user.user_ID = login.user_ID AND user.user_ID = " .$user_ID);
                                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                            echo "User ID: " .$row["user_ID"] ."<br>" ."Name: " .$row["first_Name"] ." " .$row["last_Name"] ."<br>" ."Gender: " .$row["Gender"] ."<br>" ."Date of birth: " .$row["DOB"] ."<br>" ."City: " .$row["City"] ."<br>" ."Street: " .$row["Street"] ."<br>" ."State: " .$row["State"] ."<br>" ."User type: " .$row["user_Type"] ."<br>" ."Email: " .$row["user_Email"] ."<br>";
                                                        }
                                                    } elseif ($_POST["user_Type"] == "Research Staff") {
                                                        $user_ID = $research;
                                                        $user_Email = strtolower($user_Email);
                                                        $result = $pdo->query("INSERT INTO User (user_ID, first_Name, last_Name, Gender, DOB, City, Street, State, zip_Code, user_Type) VALUES (" .$user_ID .', "' .$first_Name .'", "' .$last_Name .'", "' .$Gender .'", "' .$DOB .'", "' .$City .'", "' .$Street .'", "' .$State .'", ' .$zip_Code .', "Faculty")');
                                                        $result = $pdo->query("INSERT INTO Login (user_ID, user_Email, user_Password, user_Type) VALUES (" .$user_ID .', "' .$user_Email .'", "' .$user_Password .'", "Student")');
                                                        $result = $pdo->query("INSERT INTO research_Staff (research_ID, Status) VALUES (" .$user_ID .', "Pending")');
                                                        $result = $pdo->query("SELECT * FROM user, login WHERE user.user_ID = login.user_ID AND user.user_ID = " .$user_ID);
                                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {echo "User ID: " .$row["user_ID"] ."<br>" ."Name: " .$row["first_Name"] ." " .$row["last_Name"] ."<br>" ."Gender: " .$row["Gender"] ."<br>" ."Date of birth: " .$row["DOB"] ."<br>" ."City: " .$row["City"] ."<br>" ."Street: " .$row["Street"] ."<br>" ."State: " .$row["State"] ."<br>" ."User type: " .$row["user_Type"] ."<br>" ."Email: " .$row["user_Email"] ."<br>";
                                                        }
                                                    } else {
                                                        echo "Invalid user ID!";
                                                    }
                                                } else {
                                                    echo "<br>Email already in use. Try another.";
                                                }
                                            }
                                        }
        							}
        							?>
								</td>
							</tr>
						</tbody>
                        </div>
                        </td></tr>
                        <tr><td>
					    <div id="showUserDataElementUpdateUser" style="display:block;">
						<thead>
							<tr>
								<th>Update Users</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="UserDataManager.php" method="POST">
										<input type="text" name="update_user_ID" placeholder="User ID (Required)"><br>
										<br>
										<input type="text" name="update_first_Name" placeholder="First name"><br>
										<input type="text" name="update_last_Name" placeholder="Last name"><br>
										<input type="text" name="update_Gender" placeholder="Gender"><br>
										<input type="text" name="update_DOB" placeholder="Date of birth"><br>
										<input type="text" name="update_City" placeholder="City"><br>
										<input type="text" name="update_Street" placeholder="Street"><br>
										<input type="text" name="update_State" placeholder="State"><br>
										<input type="text" name="update_zip_Code" placeholder="Zip code"><br>
										<input type="text" name="update_user_Type" placeholder="User type"><br>
										<input type="text" name="update_user_Email" placeholder="Email"><br>
										<input type="text" name="update_user_Password" placeholder="Password"><br>
										<input type="submit" name="user_Update_submit">
										<input type="reset" name="user_Update_reset">
									</form>
									<?php 
									if (isset($_POST["user_Update_submit"])) {
                                        if (!empty($_POST["update_user_ID"])) {
                                            $user_ID = $_POST["update_user_ID"];
                                            $first_Name = $_POST["update_first_Name"];
                                            $last_Name = $_POST["update_last_Name"];
                                            $Gender = $_POST["update_Gender"];
                                            $DOB = $_POST["update_DOB"];
                                            $City = $_POST["update_City"];
                                            $Street = $_POST["update_Street"];
                                            $State = $_POST["update_State"];
                                            $zip_Code = $_POST["update_zip_Code"];
                                            $user_Type = $_POST["update_user_Type"];
                                            $user_Email = $_POST["update_user_Email"];
                                            $user_Password = $_POST["update_user_Password"];
                                            $user_Type = $_POST["update_user_Type"];
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
                                            if ($City != "") {$result = $pdo->query('UPDATE user SET City = "' .$City .'" WHERE user_ID = ' .$user_ID);
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
                                            if ($user_Type != "") {
                                                $result = $pdo->query('UPDATE user SET user_Type = "' .$user_Type .'" WHERE user_ID = ' .$user_ID);
                                            }
                                            if ($user_Email != "") {
                                                $result = $pdo->query('UPDATE login SET user_Email = "' .$user_Email .'" WHERE user_ID = ' .$user_ID);
                                            }
                                        } else {
                                            echo "Enter a user ID.";
                                        }
                                    } 
                                    ?>
								</td>
							</tr>
						</tbody>
					    </div>
                        </td></tr>
                        <tr><td>
					    <div id="showUserDataElementDeleteUser" style="display:block;">
						<thead>
							<tr>
								<th>Delete Users</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="UserDataManager.php" method="POST">
										<input type="text" name="user_Delete" placeholder="Enter user ID"><br>
										<select name = "user_active">
										    <option value = "1">Activate</option>
										    <option value = "2">Deactivate</option>
										</select>
										<input type="submit" name="user_Delete_submit">
										<input type="reset" name="user_Delete_reset">
									</form>
									
									
									<?php
									if(isset($_POST["user_Delete_submit"]))
                					    {
									 $result = $pdo->query('UPDATE user SET Active = "'.$_POST["user_active"].'" WHERE user_ID = "'.POST["user_Delete"]);
									echo "User Deleted";
                					    }
									
									?>
								</td>
							</tr>
						</tbody>
					    </div>
                        </td></tr>
                        <tr><td>
					    <div id="showUserDataElementStudentCurrentSchedule" style="display:block;">
						<thead>
							<tr>
								<th>View current student schedule</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="UserDataManager.php" method="POST">
										<input type="number" name="student_schedule_view" placeholder="Enter student ID"><br>
										<select name = "semester_schedule">
										    <option value = "2023-S">Semester Spring 2023</option>
										    <option value = "2022-F">Semester Fall 2022</option>
										</select><br>
										<input type="submit" name="student_schedule_search">
										<input type="reset" name="student_schedule_reset">
									</form>
                					<?php
                					    if(isset($_POST["student_schedule_search"]))
                					    {
                					        $result = $pdo->query('SELECT count(student_ID) FROM student WHERE student_ID = '.$_POST["student_schedule_view"]);
                					        while($row = $result->fetch(PDO::FETCH_ASSOC))
                					        {
                					            if($row["count(student_ID)"] == 1)
                					            {
                    						        $result = $pdo->query('SELECT * FROM enrollment, class WHERE enrollment.CRN = class.CRN AND enrollment.student_ID = '.$_POST["student_schedule_view"].' AND enrollment.semester_ID = "'.$_POST["semester_schedule"].'"');
                    						        while($row = $result->fetch(PDO::FETCH_ASSOC))
                    						        {
                    						            echo "CRN: ".$row["CRN"]."<br>"
                    						            ."Course: ".$row["course_ID"]."<br>"
                    						            ."Semester: ".$row["semester_ID"]."<br>"
                    						            ."Grade: ".$row["Grade"]."<br><br>";
                    						        }
                					            }
                					            elseif($row["count(student_ID)"] == 0)
                					            {
                					                echo "Student not recognized.";
                					            }
                					        }
                					    }
                				    ?>
								</td>
							</tr>
						</tbody>
					    </div>
                        </td></tr>
                        <tr><td>
					    <div id="showUserDataElementStudentCurrentSchedule" style="display:block;">
						<thead>
							<tr>
								<th>View a student's advisor</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="UserDataManager.php" method="POST">
										<input type="number" name="view_student_advisor" placeholder="Enter student ID"><br>
										<input type="submit" name="student_advisor_search">
										<input type="reset" name="student_advisor_reset">
									</form>
                					<?php
                					    if(isset($_POST["student_advisor_search"]))
                					    {
                					        $result = $pdo->query('SELECT count(student_ID) FROM student WHERE student_ID = '.$_POST["view_student_advisor"]);
                					        while($row = $result->fetch(PDO::FETCH_ASSOC))
                					        {
                					            if($row["count(student_ID)"] == 1)
                					            {
                    						        $result = $pdo->query('SELECT * FROM advisor, user WHERE user.user_ID = advisor.faculty_ID AND advisor.student_ID = '.$_POST["view_student_advisor"]);
                    						        while($row = $result->fetch(PDO::FETCH_ASSOC))
                    						        {
                    						            echo "Adivsor ID: ".$row["faculty_ID"]."<br>"
                    						            ."Name: ".$row["first_Name"]." ".$row["last_Name"]."<br>"
                    						            ."Date of appointment: ".$row["date_Of_Appointment"]."<br><br>";
                    						        }
                					            }
                					            elseif($row["count(student_ID)"] == 0)
                					            {
                					                echo "Student not recognized.";
                					            }
                					        }
                					    }
                				    ?>
								</td>
							</tr>
						</tbody>
					    </div>
                        </td></tr>
                        <tr><td>
					    <div id="showUserDataElementStudentCurrentSchedule" style="display:block;">
						<thead>
							<tr>
								<th>View a faculty's schedule</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="UserDataManager.php" method="POST">
										<input type="number" name="view_faculty_schedule" placeholder="Enter faculty ID"><br>
										<select name = "faculty_semester">
										    <option value = "2023-S">Semester Spring 2023</option>
										    <option value = "2022-F">Semester Fall 2022</option>
										    <option value = "2022-S">Semester Spring 2022</option>
										    <option value = "2021-F">Semester Fall 2021</option>
										    <option value = "2021-S">Semester Spring 2021</option>
										    <option value = "2020-F">Semester Fall 2020</option>
										    <option value = "2020-S">Semester Spring 2020</option>
										    <option value = "2019-F">Semester Fall 2019</option>
										    <option value = "2019-S">Semester Spring 2019</option>
										    <option value = "2018-F">Semester Fall 2018</option>
										</select>
										<input type="submit" name="faculty_schedule_search">
										<input type="reset" name="faculty_schedule_reset">
									</form>
                					<?php
                					    if(isset($_POST["faculty_schedule_search"]))
                					    {
                					        $result = $pdo->query('SELECT count(faculty_ID) FROM faculty WHERE faculty_ID = '.$_POST["view_faculty_schedule"]);
                					        while($row = $result->fetch(PDO::FETCH_ASSOC))
                					        {
                					            if($row["count(faculty_ID)"] == 1)
                					            {
                    						        $result = $pdo->query('SELECT * FROM course, semester, faculty_history WHERE semester.semester_ID = faculty_history.semester_ID AND course.course_ID = faculty_history.course_ID AND faculty_history.semester_ID = "'.$_POST["faculty_semester"].'" AND faculty_history.faculty_ID = '.$_POST["view_faculty_schedule"]);
                    						        while($row = $result->fetch(PDO::FETCH_ASSOC))
                    						        {
                    						            echo "CRN: ".$row["CRN"]." | "."Course: ".$row["course_ID"]." - ".$row["course_Name"]." | "."Semester: ".$row["semester_Name"]."<br><br>";
                    						        }
                					            }
                					            elseif($row["count(faculty_ID)"] == 0)
                					            {
                					                echo "Faculty not recognized.";
                					            }
                					        }
                					    }
                				    ?>
								</td>
							</tr>
						</tbody>
					    </div>
                        </td></tr>
                        <tr><td>
					    <div id="showUserDataElementStudentCurrentSchedule" style="display:block;">
						<thead>
							<tr>
								<th>View a faculty's advisees</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="UserDataManager.php" method="POST">
										<input type="number" name="view_advisee" placeholder="Enter faculty ID"><br>
										<input type="submit" name="faculty_advisee">
										<input type="reset">
									</form>
                					<?php
                					    if(isset($_POST["faculty_advisee"]))
                					    {
                					        $result = $pdo->query('SELECT count(faculty_ID) FROM faculty WHERE faculty_ID = '.$_POST["view_advisee"]);
                					        while($row = $result->fetch(PDO::FETCH_ASSOC))
                					        {
                					            if($row["count(faculty_ID)"] == 1)
                					            {
                    						        $result = $pdo->query('SELECT advisor.student_ID, user.first_Name, user.last_Name, advisor.date_Of_Appointment FROM user, advisor WHERE user.user_ID = advisor.student_ID AND advisor.faculty_ID = '.$_POST["view_advisee"]);
                    						        while($row = $result->fetch(PDO::FETCH_ASSOC))
                    						        {
                    						            echo "Advisee ID: ".$row["student_ID"]."<br>"
                    						            ."Name: ".$row["first_Name"]." ".$row["last_Name"]."<br>"
                    						            ."Date of appointment: ".$row["date_Of_Appointment"]."<br><br>";
                    						        }
                					            }
                					            elseif($row["count(student_ID)"] == 0)
                					            {
                					                echo "Faculty not recognized.";
                					            }
                					        }
                					    }
                				    ?>
								</td>
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
	</body>
</html>