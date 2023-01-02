

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

// error_reporting(0);
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
					<button onclick="window.location.href = 'portal.html'" class='sidePanelButton'>Degree<br>Programs</button>
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
			<div class="bg" style="padding-bottom:2475px;">
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
									<button onclick="window.location.href = 'UserDataManager.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">User Data<br>Manager</button>
								</td>
								<td>
									<button onclick="window.location.href = 'ScheduleDataManager.php'" class=adminNav; style="background-color:#006a4e;font-size:80%;margin-top:0px;height:58px;">Schedule<br>Manager</button>
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
                    
                    <table id="scheduleManager" style="display:block;">
                        <tr><td>
					    <div id="showScheduleDataElementCreateDep">
						<thead>
							<tr>
								<th>Create Department</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="ScheduleDataManager.php" method="POST">
										<input type = "text" name = "add_dept_ID" placeholder = "Department ID" minlength = "2" maxlength = "2"> *2 characters required*<br>
                                        <input type = "text" name = "add_dept_Name" placeholder = "Name" minlength = "6"> *At least 6 characters required*<br>
                                        <select name = "DOB">
                                        <?php
                                            $result = $pdo->query('SELECT room.room_ID FROM room WHERE room.room_ID LIKE "%DOB%" AND room.room_ID NOT IN (SELECT room.room_ID FROM room, department WHERE room.room_ID = department.room_ID)');
                                            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                                                echo "<option>".$row["room_ID"]."</option>";
                                            }
                                        ?>
                                        </select><br>
                                        <input type = "text" name = "add_Email" placeholder = "Email name" min = "3"> *deermountain.com domain will automatically be added*<br>
                                        <input type = "number" name = "add_phone_Number" placeholder = "Phone Number" value = "1000000000" min = "1000000000" max = "9999999999"><br>
                                        <input type = "number" name = "add_Manager" placeholder = "Manager ID" min = "100000000" max = "999999999"><br>
                                        <input type = "submit" name = "department_Create_submit" value = "Create department">
                                        <input type = "reset" name = "department_Create_reset">
                                        <?php
                                            if(isset($_POST["department_Create_submit"]))
                                            {
                                                $result = $pdo->query('SELECT count(dept_ID) FROM department where dept_ID = "'.$_POST["add_dept_ID"].'"');
                                                while($row = $result->fetch(PDO::FETCH_ASSOC))
                                                {
                                                    if($row["count(dept_ID)"] == 0)
                                                    {
                                                        $result = $pdo->query('SELECT user.user_ID, user.first_Name, user.last_Name, count(user.user_ID) FROM user, faculty WHERE user.user_ID = faculty.faculty_ID AND faculty.faculty_ID = '.$_POST["add_Manager"]);
                                                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                                                        {
                                                            if($row["count(user.user_ID)"] == 1)
                                                            {
                                                                $manager_Name = $row["first_Name"]." ".$row["last_Name"];
                                                                $dept_Email = $_POST["add_Email"]."@deermountain.edu";
                                                                $result = $pdo->query('INSERT INTO department VALUES ("'.$_POST["add_dept_ID"].'", "'.$_POST["add_dept_Name"].'", "'.$dept_Email.'", '.$_POST["add_phone_Number"].', "'.$_POST["DOB"].'", '.$_POST["add_Manager"].', "'.$manager_Name.'", 1)');
                                                                $result = $pdo->query('INSERT INTO faculty_department VALUES ("'.$_POST["add_Manager"].'", "'.$_POST["add_dept_ID"].'", "100", "'.date("m/d/Y").'")');
                                                            }
                                                            elseif($row["count(user.user_ID)"] == 0)
                                                            {
                                                                echo "Faculty ID is not recognized.";
                                                            }
                                                        }
                                                    }
                                                    elseif($row["count(dept_ID)"] == 1)
                                                    {
                                                        echo "Department ID already exists.";
                                                    }
                                                }
                                            }
                                        ?><br>
									</form>
									
								</td>
							</tr>
						</tbody>
					</div>
					    </td></tr>
                        <tr><td>
					    <div id="showScheduleDataElementUpdateDep">
						<thead>
							<tr>
								<th>Update Departments</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form method="POST">
										<select name = "update_dept">
										    <option selected disabled>Select Department</option>
                						<?php
    						                $result = $pdo->query('SELECT * FROM department');
    						                while($row = $result->fetch(PDO::FETCH_ASSOC))
    						                {
    						                    echo "<option value = ".$row["dept_ID"].">".$row["dept_ID"].": ".$row["dept_Name"]."</option>";
    						                }
    						            ?>
    						        </select><br>
            
    						        <input type = "number" name = "update_phone_Number" placeholder = "Phone Number" value = "1000000000" min = "1000000000" max = "9999999999">
    						        <input type = "submit" name = "update_phone_Number_submit" value = "Update Phone Number"><br>
    						        <?php
    						            if(isset($_POST["update_phone_Number_submit"]))
    						            {
    						                $result = $pdo->query('UPDATE department SET phone_Number = '.$_POST["update_phone_Number"].' WHERE dept_ID = "'.$_POST["update_dept"].'"');
    						            }
    						        ?>
    						        
    						        <select name = "update_DOB">
    						            <?php
    						                $result = $pdo->query('SELECT room.room_ID FROM room WHERE room.room_ID LIKE "%DOB%" AND room.room_ID NOT IN (SELECT room.room_ID FROM room, department WHERE room.room_ID = department.room_ID)');
    						                while($row = $result->fetch(PDO::FETCH_ASSOC))
        						            {
        						                echo "<option>".$row["room_ID"]."</option>";
        						            }
        						        ?>
        						    </select>
        						    <input type = "submit" name = "confirm_update_DOB" value = "Update DOB"><br>
        						    <?php
            						    if(isset($_POST["confirm_update_DOB"]))
            						    {
            			                    $result = $pdo->query('UPDATE department SET room_ID = "'.$_POST["update_DOB"].'" WHERE dept_ID = "'.$_POST["update_dept"].'"');
            						    }
        						    ?>
        						    <input type = "number" name = "update_Manager" placeholder = "Manager ID" min = "100000000" max = "999999999">
        						    <input type = "submit" name = "manager_Update_submit" value = "Update manager">
        						    <?php
        						        if(isset($_POST["manager_Update_submit"]))
        						        {
        						            $result = $pdo->query('DELETE FROM faculty_department WHERE dept_ID = "'.$_POST["update_dept"].'" AND faculty_ID = (SELECT manager_ID FROM department WHERE dept_ID = "'.$_POST["update_dept"].'")');
        						            $result = $pdo->query('SELECT count(dept_ID) FROM faculty_department WHERE faculty_ID = '.$_POST["update_DOB"]);
            						        while($row = $result->fetch(PDO::FETCH_ASSOC))
            						        {
            						            if($row["count(dept_ID)"] == 1)
            						            {
            						                echo "This faculty is already part of this department.";
            						            }
            						            elseif($row["count(dept_ID)"] == 0)
            						            {
            						                $result = $pdo->query('SELECT user_ID, first_Name, last_Name FROM user WHERE user_ID = '.$_POST["update_Manager"]);
                						            while($row = $result->fetch(PDO::FETCH_ASSOC))
                						            {
                						                $new_Manager = $row["first_Name"]." ".$row["last_Name"];
                						                $result = $pdo->query('UPDATE department SET manager_ID = '.$_POST["update_Manager"].'WHERE dept_ID = "'.$_POST["update_dept"].'"');
                						                $result = $pdo->query('UPDATE department SET manager_Name = "'.$new_Manager.'" WHERE dept_ID = "'.$_POST["update_dept"].'"');
                						                $result = $pdo->query('INSERT INTO faculty_department VALUES ("'.$_POST["update_Manager"].'", "'.$_POST["update_dept"].'", "100", "'.date("m/d/Y").'")');
                						            }
            						            }
            						        }
        						            $result = $pdo->query('UPDATE department SET manager_ID = '.$_POST["update_Manager"].' WHERE dept_ID = "'.$_POST["update_dept"].'"');
        						            $result = $pdo->query('SELECT user_ID, first_Name, last_Name FROM user WHERE user_ID = '.$_POST["update_Manager"]);
        						            while($row = $result->fetch(PDO::FETCH_ASSOC))
        						            {
        						                $new_Manager = $row["first_Name"]." ".$row["last_Name"];
        						                $result = $pdo->query('UPDATE department SET manager_Name = "'.$new_Manager.'" WHERE dept_ID = "'.$_POST["update_dept"].'"');
        						            }
        						        }
        						    ?>
									</form>
								</td>
							</tr>
						</tbody>
					</div>
					    </td></tr>
                        <tr><td>
					    <div id="showScheduleDataElementDeleteDep">
						<thead>
							<tr>
								<th>Enable/Disable a Department</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="ScheduleDataManager.php" method="POST">
										<select name = "current_dept">
										    <option selected disabled>Select Department</option>
                						    <?php
						                        $result = $pdo->query('SELECT * FROM department');
    						                    while($row = $result->fetch(PDO::FETCH_ASSOC))
	    					                    {
		    				                        echo "<option value = ".$row["dept_ID"].">".$row["dept_Name"]."</option>";
			    			                    }
				    		                ?>
						                </select>
						                <select name = "active">
						                    <option value = "1">Enable</option>
						                    <option value = "0">Disable</option>
						                </select>
						                <input type = "submit" name = "activation" value = "Activation mode"><br>
						                <?php
						                    if(isset($_POST["activation"]))
						                    {
						                        $result = $pdo->query('UPDATE department SET ACTIVE = '.$_POST["active"].' WHERE dept_ID = "'.$_POST["current_dept"].'"');
    						                }
    						            ?>
    						            <?php
    						                $result = $pdo->query('SELECT dept_Name, ACTIVE FROM department');
    						                while($row = $result->fetch(PDO::FETCH_ASSOC))
    						                {
    						                    if($row["ACTIVE"] == 1)
	    					                    {
		    				                        echo $row["dept_Name"].": <p style='color:lime;text-shadow: 1.5px 1.5px 0px rgba(0,0,0,1);'>Enabled</p><br>";
			    			                    }
				    		                    elseif($row["ACTIVE"] == 0)
					    	                    {
						                            echo $row["dept_Name"].": <p style='color:red;text-shadow: 1.5px 1.5px 0px rgba(0,0,0,1);'>Disabled</p><br>";
						                        }
						                    }
						                ?>
									</form>
									
								</td>
							</tr>
						</tbody>
					</div>
					    </td></tr>
					    
					    <tr><td>
					    <div id="showScheduleDataElementCreateCourse">
						<thead>
							<tr>
								<th>Create Course</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="ScheduleDataManager.php" method="POST">
										<select name = "add_course_dept_ID">
										    <option selected disabled>Select Department</option>
                						<?php
            						        $result = $pdo->query('SELECT * FROM department');
						                    while($row = $result->fetch(PDO::FETCH_ASSOC))
						                    {
						                        echo "<option value = ".$row["dept_ID"].">"."Department: ".$row["dept_ID"]." (".$row["dept_Name"].")"."</option>";
                    						}
                						?>
                						
                					
                						
            						</select>
						            <input type = "number" name = "add_course_ID" placeholder = "Course ID" min = "1000" max = "4999" style = "width: 75px"> *4 numbers required*<br>
            						<input type = "text" name = "add_course_Name" placeholder = "Course Name" minlength = "5" maxlength = "50"> *Between 5 to 50 characters required*<br>
    						        <textarea name = "add_course_Desc" placeholder = "Course Description" minlength = "50" maxlength = "500" style = "width: 250px; height: 100px"></textarea> *Between 50 to 500 characters required*<br>
            						<select name = "course_type">
						                <option>Undergraduate</option>
						                <option>Graduate</option>
						            </select><br>
						            <input type = "number" name = "add_Credits" min = "2" max = "4" value = "2"> *Amount of credits*<br>
            						<input type = "submit" name = "create_course_submit" value = "Create course">
						            <input type = "reset" name><br>
						            <?php
                						if(isset($_POST["create_course_submit"]))
						                {
						                    $course_ID = $_POST["add_course_dept_ID"].$_POST["add_course_ID"];
						                    $result = $pdo->query('SELECT count(course_ID) FROM course WHERE course_ID = "'.$course_ID.'"');
                    						while($row = $result->fetch(PDO::FETCH_ASSOC))
						                    {
						                        if($row["count(course_ID)"] == 0)
						                        {
						                            $result = $pdo->query('INSERT INTO course VALUES("'.$course_ID.'", "'.$_POST["add_course_dept_ID"].'", "'.$_POST["add_course_Name"].'", "'.$_POST["add_course_Desc"].'", "'.$_POST["course_type"].'", '.$_POST["add_Credits"].', 1)');
                        						}
						                        elseif($row["count(course_ID)"] == 1)
						                        {
						                            echo "This course already exists<br><br>";
						                        }
						                    }
						                }
						            ?>
									</form>
								</td>
							</tr>
						</tbody>
					</div>
					    </td></tr>
					    
					    <tr><td>
					    <div id="showScheduleDataElementUpdateCourse">
						<thead>
							<tr>
								<th>Update Course</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="ScheduleDataManager.php" method="POST">
									    
										<select name = "update_course_dept_select">
										    <option selected disabled>Select Department</option>
                						<?php
						                    $result = $pdo->query('SELECT * FROM department');
						                    while($row = $result->fetch(PDO::FETCH_ASSOC))
						                    {
						                        echo "<option value = ".$row["dept_ID"].">".$row["dept_ID"].": ".$row["dept_Name"]."</option>";
                    						}
						                ?>
						            </select>
						            <input type = "submit" name = "select_course_dept" value = "Select department"><br>
						            <select name = "update_course_ID_select">
						                <option selected disabled>Select Course</option>
						                <?php
						                    if(isset($_POST["select_course_dept"]))
                    						{
						                        $result = $pdo->query('SELECT * FROM course WHERE course_ID LIKE "%'.$_POST["update_course_dept_select"].'%"');
						                        while($row = $result->fetch(PDO::FETCH_ASSOC))
						                        {
						                            echo "<option value = ".$row["course_ID"].">".$row["course_ID"].": ".$row["course_Name"]."</option>";
						                        }
						                    }
						                ?>
						            </select>
						            <input type = "submit" name = "select_course_update" value = "Select course to update"><br>
						            <select name = "temp_course_present" style = "display: none;">
						                <?php
						                    if(isset($_POST["select_course_update"]))
						                    {
						                        echo "<option>".$_POST["update_course_ID_select"]."</option>";
						                    }
						                ?>
            						</select>
        						    <?php
						                if(isset($_POST["select_course_update"]))
						                {
						                    $result = $pdo->query('SELECT course_Desc FROM course WHERE course_ID = "'.$_POST["update_course_ID_select"].'"');
						                    while($row = $result->fetch(PDO::FETCH_ASSOC))
						                    {
						                        echo '<textarea name = "update_course_Desc" placeholder = "'.$row["course_Desc"].'" minlength = "50" maxlength = "500" style = "width: 250px; height: 100px"></textarea> *Between 50 to 500 characters required*<br>';
						                        echo '<input type = "submit" name = "update_desc" value = "Update description">';
						                    }
						                }
						            ?>
						            <?php
						                if(isset($_POST["update_desc"]))
						                {
						                    $result = $pdo->query('UPDATE course SET course_Desc = "'.$_POST["update_course_Desc"].'" WHERE course_ID = "'.$_POST["temp_course_present"].'"');
                						}
						            ?><br>
									</form>
									
								</td>
							</tr>
						</tbody>
					</div>
					    </td></tr>
					    
					    <tr><td>
					    <div id="showScheduleDataActivateCourse">
						<thead>
							<tr>
								<th>Course Activation</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="ScheduleDataManager.php" method="POST">
										
										<select name = "activation_course_dept_select">
										    <option selected disabled>Select Course</option>
                    						<?php
		    				                    $result = $pdo->query('SELECT * FROM department');
	    					                    while($row = $result->fetch(PDO::FETCH_ASSOC))
    						                    {
						                            echo "<option value = ".$row["dept_ID"].">".$row["dept_ID"].": ".$row["dept_Name"]."</option>";
						                        }
						                    ?>
						                </select>
				    		            <input type = "submit" name = "course_dept_method" value = "Select department"><br>
					    	            <select name = "activation_course_ID">
						                    <?php
						                        if(isset($_POST["course_dept_method"]))
						                        {
						                            $result = $pdo->query('SELECT * FROM course WHERE course_ID LIKE "%'.$_POST["activation_course_dept_select"].'%"');
						                            while($row = $result->fetch(PDO::FETCH_ASSOC))
						                            {
						                                echo "<option value = ".$row["course_ID"].">".$row["course_ID"].": ".$row["course_Name"]."</option>";
    						                        }
	    					                    }
		    				                ?>
			    			            </select>
				    		            <select name = "course_active">
					    	                <option value = "1">Enable</option>
						                    <option value = "0">Disable</option>
						                </select>
						                <input type = "submit" name = "select_course_active_update" value = "Course activation"><br><br>
						                <?php
    						                if(isset($_POST["select_course_active_update"]))
	    					                {
		    				                    $result = $pdo->query('UPDATE course SET ACTIVE = '.$_POST["course_active"].' WHERE course_ID = "'.$_POST["activation_course_ID"].'"');
			    			                }
				    		            ?>
									</form>
									
								</td>
							</tr>
						</tbody>
					</div>
					    </td></tr>
					    
					    <tr><td>
					    <div id="showScheduleDataCourseStatus">
						<thead>
							<tr>
								<th>Course Status Checker</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="ScheduleDataManager.php" method="POST">
										
										<input type = "text" name = "course_status" placeholder = "Course ID" minlength = "6" maxlength = "6">
            							<input type = "submit" name = "course_check" value = "Check course status">
							            <?php
							                if(isset($_POST["course_check"]))
							                {
							                    $result = $pdo->query('SELECT course_ID, course_Name, count(course_ID), ACTIVE FROM course WHERE course_ID = "'.$_POST["course_status"].'"');
							                    while($row = $result->fetch(PDO::FETCH_ASSOC))
							                    {
							                        if($row["count(course_ID)"] == 1)
							                        {
							                            if($row["ACTIVE"] == 1)
							                            {
							                                echo $row["course_ID"].": ".$row["course_Name"]." is currently Enabled.<br>";
							                            }
							                            elseif($row["ACTIVE"] == 0)
							                            {
							                                echo $row["course_ID"].": ".$row["course_Name"]." is currently Disabled.<br>";
							                            }
							                        }
							                        elseif($row["count(course_ID)"] == 0)
							                        {
							                            echo "This course isn't recognized";
							                        }
							                    }
							                }
							            ?>
									</form>
								</td>
							</tr>
						</tbody>
					</div>
					    </td></tr>
					    
					    <tr><td>
					    <div id="showScheduleDataStartSemester">
						<thead>
							<tr>
								<th>Start New Semester</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="ScheduleDataManager.php" method="POST">
										
										<h4>Start next semester</h4>
            					        Start date:
					                    <select name = "start_date">
					                        <?php
					                            $result = $pdo->query('SELECT * FROM semester GROUP BY AUTO DESC LIMIT 1');
					                            while($row = $result->fetch(PDO::FETCH_ASSOC))
					                            {
					                                if($row["semester_Name"][0] == "F")
					                                {
					                                    $semester_Year = $row["semester_Year"] + 1;
                    					                echo "<option>1/25</option>";
					                                    echo "<option>1/26</option>";
					                                    echo "<option>1/27</option>";
					                                    echo "<option>1/28</option>";
					                                    echo "<option>1/29</option>";
					                                    echo "<option>1/30</option>";
					                                    echo "<option>1/31</option>";
					                                }
					                                elseif($row["semester_Name"][0] == "S")
					                                {
                    					                $semester_Year = $row["semester_Year"];
					                                    echo "<option>8/25</option>";
					                                    echo "<option>8/26</option>";
					                                    echo "<option>8/27</option>";
                					                    echo "<option>8/28</option>";
					                                    echo "<option>8/29</option>";
					                                    echo "<option>8/30</option>";
					                                    echo "<option>8/31</option>";
					                                }
					                            }
					                        ?>
					                    </select>
					                    End date:
        					            <select name = "end_date">
					                        <?php
					                            $result = $pdo->query('SELECT * FROM semester GROUP BY AUTO DESC LIMIT 1');
					                            while($row = $result->fetch(PDO::FETCH_ASSOC))
                    					        {
					                                if($row["semester_Name"][0] == "F")
					                                {
					                                    $semester_Year = $row["semester_Year"] + 1;
                    					                echo "<option>5/17</option>";
					                                    echo "<option>5/18</option>";
                            					        echo "<option>5/19</option>";
                            					        echo "<option>5/20</option>";
                            					        echo "<option>5/21</option>";
                    	        				        echo "<option>5/22</option>";
                    			        		        echo "<option>5/23</option>";
					                                }
					                                elseif($row["semester_Name"][0] == "S")
					                                {
					                                    $semester_Year = $row["semester_Year"];
                    			        		        echo "<option>12/17</option>";
					                                    echo "<option>12/18</option>";
                    					                echo "<option>12/19</option>";
					                                    echo "<option>12/20</option>";
					                                    echo "<option>12/21</option>";
					                                    echo "<option>12/22</option>";
					                                    echo "<option>12/23</option>";
                    					            }
                        					    }
		        			                ?>
				        	            </select>
            			        		<input type = "submit" name = "next_schedule" value = "Start next master schedule"> <br>
        					            <?php
		        			                if(isset($_POST["next_schedule"]))
				        	                {
					                            $result = $pdo->query('SELECT * FROM semester GROUP BY AUTO DESC LIMIT 1');
                    			        		while($row = $result->fetch(PDO::FETCH_ASSOC))
					                            {
        					                        $AUTO = $row["AUTO"] + 1;
                            					    if($row["semester_Name"][0] == "F" && $row["Operation"] == "Closed")
				        	                        {
                    	        				        $semester_Year = $row["semester_Year"] + 1;
					                                    $semester_ID = $semester_Year."-S";
                    					                $semester_Name = "Spring ".$semester_Year;
					                                    $result = $pdo->query('INSERT INTO semester VALUES('.$AUTO.', "'.$semester_ID.'", "'.$semester_Name.'", "'.$semester_Year.'", "'.$_POST["start_date"].'", "'.$_POST["end_date"].'", "Open")');
					                                    header("Location: ScheduleDataManager.php");
                    					            }
        					                        elseif($row["semester_Name"][0] == "S" && $row["Operation"] == "Closed")
		        			                        {
                            					        $semester_Year = $row["semester_Year"];
					                                    $semester_ID = $semester_Year."-F";
                    			        		        $semester_Name = "Fall ".$semester_Year;
					                                    $result = $pdo->query('INSERT INTO semester VALUES('.$AUTO.', "'.$semester_ID.'", "'.$semester_Name.'", "'.$semester_Year.'", "'.$_POST["start_date"].'", "'.$_POST["end_date"].'", "Open")');
					                                    header("Location: ScheduleDataManager.php");
                    					            }
                    					            else echo "<br><div style = 'color:red;'>The current semester is opened and you are out of proper time window.</div><br>";
        					                    }
		        			                }
				        	            ?>
					                    <?php
        					                $result = $pdo->query('SELECT * FROM semester GROUP BY AUTO DESC LIMIT 1');
        					                while($row = $result->fetch(PDO::FETCH_ASSOC))
		        			                {
					                            $current_AUTO = $row["AUTO"];
					                            if($row["semester_Name"][0] == "F")
					                            {
					                                $semester_Year = $row["semester_Year"] + 1;
		        			                        echo "The next semester is Spring ".$semester_Year."<br>";
				        	                        echo "Next semester may be created after ".date("m/d", strtotime($row["start_Date"]."+14 day"))."/".$row["semester_Year"]."<br>";
				        	                        $time = ($row["semester_Year"] - date("Y")) * 365 + 14;
    			        		                    //echo date("m/d/Y", strtotime($row["start_Date"]."+$time day"));
					                                if(date("m/d/Y") == date("m/d/Y", strtotime($row["start_Date"]."+$time day")))
					                                {
        					                            $result = $pdo->query('UPDATE semester SET Operation = "Closed" WHERE AUTO = "'.$current_AUTO.'"');
                                					}
					                            }
					                            elseif($row["semester_Name"][0] == "S")
        					                    {
		        			                        echo "The next semester is Fall ".$row["semester_Year"]."<br>";
				        	                        echo "Next semester may be created after ".date("m/d", strtotime($row["start_Date"]."+14 day"))."/".$row["semester_Year"]."<br>";
				        	                        $time = ($row["semester_Year"] - date("Y")) * 365 + 14;
				        	                       // echo date("m/d/Y", strtotime($row["start_Date"]."+$time day"));
					                                if(date("m/d/Y") == date("m/d/Y", strtotime($row["start_Date"]."+$time day")))
					                                {
        					                            $result = $pdo->query('UPDATE semester SET Operation = "Closed" WHERE AUTO = "'.$current_AUTO.'"');
                                					}
        					                    }
		        			                }
				        	            ?>
									</form>
									
								</td>
							</tr>
						</tbody>
					</div>
					    </td></tr>
					    
					    <tr><td>
					    <div id="showScheduleDataManageSemester">
						<thead>
							<tr>
								<th>
								<?php 
                                    $result = $pdo->query('SELECT * FROM semester GROUP BY AUTO DESC LIMIT 1'); 
                                    while($row = $result->fetch(PDO::FETCH_ASSOC))
                                    {
                                        echo "Manage Semester: ";
                                        echo '<select name = "new"><option value = "'.$row["semester_ID"].'">'.$row['semester_Name'].'</option></select>';
                                    }
                                ?>
                                </th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form  method="POST">
									    <div id="Add Class" > Add Class:</div>
									    
										<select name= "check_department">
										    <option selected disabled>Select Department</option>
                							<?php
                							
							                    $result = $pdo->query('SELECT * FROM department');
							                    while($row = $result->fetch(PDO::FETCH_ASSOC))
							                    {
							                        echo "<option value = ".$row["dept_ID"].">".$row["dept_Name"]."</option>";
							                    }
							                ?>
							            </select>
							            <input type = "submit" name = "check_dept" value = "Select department"><br>
							            <select name = "add_course">
							                <?php
							                    if(isset($_POST["check_dept"]))
							                    {
							                        $result = $pdo->query('SELECT * FROM course WHERE dept_ID = "'.$_POST["check_department"].'"');
							                        echo '<option selected disabled>Select Course</option>';
							                        while($row = $result->fetch(PDO::FETCH_ASSOC))
							                        {
							                            
							                            echo "<option value = ".$row["course_ID"].">".$row["course_ID"]." - ".$row["course_Name"]."</option>";
							                        }
							                        
                    							}
							                ?>
							            </select>
							            <select name = "add_faculty">
							                <?php
							                    $result = $pdo->query('SELECT * FROM user, faculty, faculty_department WHERE user.user_ID = faculty_department.faculty_ID AND faculty_department.faculty_ID = faculty.faculty_ID AND dept_ID = "'.$_POST["check_department"].'"');
							                    echo '<option selected disabled>Select Faculty</option>';
							                    while($row = $result->fetch(PDO::FETCH_ASSOC))
                    							{
                    							    
							                        echo "<option value = ".$row["faculty_ID"].">".$row["first_Name"]." ".$row["last_Name"].": ".$row["faculty_Type"]."</option>";
							                    }
							                ?>
							            </select>
							            <select name = "add_day">
							                <?php
							                    if(isset($_POST["check_dept"]))
							                    {
							                        $result = $pdo->query('
							                        SELECT day_ID FROM schedule 
							                        where day_ID = "M/W" 
                                                    union
                                                    SELECT day_ID  FROM schedule where day_ID = "T/TH"
                                                    Union 
                                                    SELECT day_ID  FROM schedule where day_ID = "F"');
							                        echo '<option selected disabled>Select Day</option>';
							                        while($row = $result->fetch(PDO::FETCH_ASSOC))
							                        {
							                            
							                            echo "<option value = ".$row["day_ID"].">".$row["day_ID"]."</option>";
							                        }
							                    }
							                ?>
            							</select>
							            
							           
							            <select name = "add_time">
							                <?php
							                    if(isset($_POST["check_dept"]))
							                    {
							                       
							                        {
							                        $result = $pdo->query('SELECT start_Time, end_Time FROM `schedule` ORDER BY `AUTO` ASC limit 7');
							                        echo '<option selected disabled>Select Time Period</option>';
							                        while($row = $result->fetch(PDO::FETCH_ASSOC))
							                        {
							                            
							                            echo "<option value =   '".$row["start_Time"]."'  >      " . $row["start_Time"] . "   -    ".$row["end_Time"]."       </option>";
							                        } 
							                        }
							                    }
							                ?>
            							</select>
            							
            							
							            <select name = "add_room">
							                <?php
							                    if(isset($_POST["check_dept"]))
							                    {
							                        $result = $pdo->query('SELECT * FROM room WHERE room_ID LIKE "%NAB%" OR room_ID LIKE "%SAB%" OR room_ID LIKE "%EAB%" OR room_ID LIKE "%WAB%"');
							                        echo '<option selected disabled>Select Room</option>';
							                        while($row = $result->fetch(PDO::FETCH_ASSOC))
							                        {
							                            
							                            echo "<option>".$row["room_ID"]."</option>";
							                        }
							                    }
							                ?>
							            </select>
							            <select name = "add_seats">
							                <?php
							                    if(isset($_POST["check_dept"]))
							                    {
							                        echo '<option selected disabled>Select # of Seats Available</option>';
							                        echo "<option>5</option>";
							                        echo "<option>6</option>";
							                        echo "<option>7</option>";
							                        echo "<option>8</option>";
                        							echo "<option>9</option>";
							                        echo "<option>10</option>";
							                        echo "<option>11</option>";
							                        echo "<option>12</option>";
							                        echo "<option>13</option>";
							                        echo "<option>14</option>";
							                        echo "<option>15</option>";
							                    }
							                ?>
							            </select>
							            <input type = "submit" name = "add_class" value = "Add class to schedule"><br><br>
							            <?php
							                if(isset($_POST["add_class"]))
							                {
							                    
							                    $result = $pdo->query('SELECT time_Slot_ID FROM schedule WHERE start_Time = "'.$_POST["add_time"].'" AND day_ID = "'.$_POST["add_day"].'"');
							                    while($row = $result->fetch(PDO::FETCH_ASSOC))
							                    {
							                        $add_time_slot = $row["time_Slot_ID"];
							                       
							                    }
							                    
							                    
							                    
							                    $result = $pdo->query('SELECT * FROM temp_crn GROUP BY AUTO DESC LIMIT 1');
							                    while($row = $result->fetch(PDO::FETCH_ASSOC))
							                    {
							                        $CRN = $row["CRN"];
							                    }
							                    $result = $pdo->query('SELECT course_ID, count(course_ID), section_Num FROM class WHERE course_ID = "'.$_POST["add_course"].'" AND semester_ID = "'.$_POST["new"].'"');
                    							while($row = $result->fetch(PDO::FETCH_ASSOC))
							                    {
							                        if($row["count(course_ID)"] == 0)
							                        {
                        							    $section_Num = 1;
							                        }
							                        elseif($row["count(course_ID)"] > 0)
							                        {
							                            $section_Num = $row["section_Num"] + 1;
							                        }
							                    }
                    
                							    $result = $pdo->query('SELECT class.faculty_ID, faculty.faculty_Type, count(class.faculty_ID) FROM class, faculty WHERE class.faculty_ID = faculty.faculty_ID AND class.faculty_ID = '.$_POST["add_faculty"].' AND class.semester_ID = "'.$_POST["new"].'"');
                    							while($row = $result->fetch(PDO::FETCH_ASSOC))
							                    {
							                        if($row["count(class.faculty_ID)"] == 0)
							                        {
							                            $result = $pdo->query('SELECT class.time_Slot_ID,class.room_ID,semester_ID,count(class.time_Slot_ID), count(class.room_ID) FROM class WHERE class.time_Slot_ID = "'.$add_time_slot.'" AND class.room_ID = "'.$_POST["add_room"].'" AND semester_ID = "'.$_POST["new"].'"');
                            							while($row = $result->fetch(PDO::FETCH_ASSOC))
							                            {
							                                if($row["count(class.time_Slot_ID)"] == 1 && $row["count(class.room_ID)"] == 1)
                            							    {
							                                    echo "There is a schedule conflict!<br>";
                            							    }
							                                elseif($row["count(class.time_Slot_ID)"] == 0 && $row["count(class.room_ID)"] == 0)
                            							    {
                                    							//$result = $pdo->query('INSERT INTO class (CRN, course_ID, section_Num, faculty_ID, time_Slot_ID, room_ID, semester_ID, seat_Avail) VALUES (1010101, "'.$_POST["add_course"].'", '.$section_Num.', "'.$_POST["add_faculty"].'", "'.$add_time_slot.'", "'.$_POST["add_room"].'", "2023-S",  '.$_POST["add_seats"].')');
                                    							$result = $pdo->query('INSERT INTO class VALUES('.$CRN.', "'.$_POST["add_course"].'", '.$section_Num.', "'.$_POST["add_faculty"].'", "'.$add_time_slot.'", "'.$_POST["add_room"].'", "2023-S",  '.$_POST["add_seats"].')');
                                							    $result = $pdo->query('DELETE FROM temp_crn WHERE CRN = (SELECT CRN FROM temp_crn GROUP BY AUTO DESC LIMIT 1)');
                                							    
                                							    
                                							}
                            							}
                        							}
                        							elseif($row["faculty_Type"] == "Full Time")
                        							{
                            							if($row["count(class.faculty_ID)"] < 2)
                            							{
                                							$result = $pdo->query('SELECT class.time_Slot_ID,class.room_ID,semester_ID,count(class.time_Slot_ID), count(class.room_ID) FROM class WHERE class.time_Slot_ID = "'.$add_time_slot.'" AND class.room_ID = "'.$_POST["add_room"].'" AND semester_ID = "'.$_POST["new"].'"');
                                							while($row = $result->fetch(PDO::FETCH_ASSOC))
                                							{
                                    							if($row["count(class.time_Slot_ID)"] == 1 && $row["count(class.room_ID)"] == 1)
                                    							{
                                    							    echo "There is a schedule conflict!<br>";
                                    							}
                                    							elseif($row["count(class.time_Slot_ID)"] == 0 && $row["count(class.room_ID)"] == 0)
                                    							
                                    							{
                                    							    //$result = $pdo->query('INSERT INTO class (CRN,course_ID,section_Num,faculty_ID,time_Slot_ID,room_ID,semester_ID,seat_Avail) VALUES( 1010101, "'.$_POST["add_course"].'", '.$section_Num.', "'.$_POST["add_faculty"].'", "'.$add_time_slot.'", "'.$_POST["add_room"].'", "2023-S",  '.$_POST["add_seats"].')');
                                    							    $result = $pdo->query('INSERT INTO class VALUES('.$CRN.', "'.$_POST["add_course"].'", '.$section_Num.', "'.$_POST["add_faculty"].'", "'.$add_time_slot.'", "'.$_POST["add_room"].'", "2023-S",  '.$_POST["add_seats"].')');
							                                        $result = $pdo->query('DELETE FROM temp_crn WHERE CRN = (SELECT CRN FROM temp_crn GROUP BY AUTO DESC LIMIT 1)');
							                                        
                            							        }
                                							}
                            							}
                            							elseif($row["count(class.faculty_ID)"] == 2)
                            							{
                            							    echo "Faculty is full time and is already teaching two courses.<br>";
                            							}
                        							}
                        							elseif($row["faculty_Type"] == "Part Time")
                        							{
                            							if($row["count(class.faculty_ID)"] == 0)
                            							{
                                							$result = $pdo->query('SELECT count(class.time_Slot_ID), count(class.room_ID) FROM class WHERE class.time_Slot_ID = "'.$add_time_slot.'" AND class.room_ID = "'.$_POST["add_room"].'" AND semester_ID = "'.$_POST["new"].'"');
                                							while($row = $result->fetch(PDO::FETCH_ASSOC))
                                							{
                                    							if($row["count(class.time_Slot_ID)"] == 1 && $row["count(class.room_ID)"] == 1)
                                    							{
                                    							    echo "There is a schedule conflict!<br>";
                                    							}
                                    							elseif($row["count(class.time_Slot_ID)"] == 0 && $row["count(class.room_ID)"] == 0)
                                    							{
                                        							//$result = $pdo->query('INSERT INTO class (CRN,course_ID,section_Num,faculty_ID,time_Slot_ID,room_ID,semester_ID,seat_Avail) VALUES( 1010101, "'.$_POST["add_course"].'", '.$section_Num.', "'.$_POST["add_faculty"].'", "'.$add_time_slot.'", "'.$_POST["add_room"].'", "2023-S",  '.$_POST["add_seats"].')');
                                        							$result = $pdo->query('INSERT INTO class VALUES('.$CRN.', "'.$_POST["add_course"].'", '.$section_Num.', "'.$_POST["add_faculty"].'", "'.$add_time_slot.'", "'.$_POST["add_room"].'", "2023-S",  '.$_POST["add_seats"].')');
                                        							$result = $pdo->query('DELETE FROM temp_crn WHERE CRN = (SELECT CRN FROM temp_crn GROUP BY AUTO DESC LIMIT 1)');
                                        						
                                    							}
                                							}
                            							}
                            							elseif($row["count(class.faculty_ID)"] == 1)
                            							{
                            							    echo "Faculty is part time and is already teaching a course.<br>";
                            							}
                        							}
                    							}
                							}
            							?>
            							
            							
            							
            							
            							
            							<?php
            							echo '<div style="display:block id="updateClass"> Select Class to Update:</div>';
            							?>
            							
 
            							<input type = "text" name = "enter_CRN" placeholder = "Enter CRN" size = "6px">
            							<input type = "submit" name = "update_class" value = "Select class"><br>
							            <?php
							            
							          
							          
							                if(isset($_POST["update_class"]))
                							{
               
             
                							    
                							    echo '<select style="display:none"; name = "current_CRN"><option>'.$_POST["enter_CRN"].'</option></select>';
                							}
            							?>
            
            							<?php
                							if(isset($_POST["update_class"]))
                							{
                							     echo '<div id="updateSection" > Update Section Number:</div>';
                							    echo '<input type = "number" name = "new_section" value = "1" min = "1" max = "99">';
                							}
        							    ?>
        							    
            							<?php
                							if(isset($_POST["update_section"]))
                							{
                							    $result = $pdo->query('UPDATE class SET section_Num = '.$_POST["new_section"].' WHERE CRN = '.$_POST["current_CRN"]);
                							}
            							?>
            							
							            <input type = "submit" name = "update_section" value = "Update section"><br>
							            <?php
            							echo '<div style="display:block id="updateSeats"> Update # of Seats in Class:</div>';
            							?>
            
        							    <select name = "update_seats">
                							<?php
                							
                    							if(isset($_POST["update_class"]))
                    							{
                    							    echo "<option>5</option>";
                    							    echo "<option>6</option>";
                    							    echo "<option>7</option>";
                    							    echo "<option>8</option>";
                    							    echo "<option>9</option>";
                    							    echo "<option>10</option>";
                    							    echo "<option>11</option>";
                    							    echo "<option>12</option>";
                    							    echo "<option>13</option>";
                    							    echo "<option>14</option>";
                    							    echo "<option>15</option>";
                    							}
                							?>
            							</select>
            							<?php
                							if(isset($_POST["new_seats"]))
                							{
                							    $result = $pdo->query('UPDATE class SET seat_Avail = '.$_POST["update_seats"].' WHERE CRN = '.$_POST["current_CRN"]);
                							}
            							?>
            							<input type = "submit" name = "new_seats" value = "Add Seats to Class"><br>
                                        <?php
            							echo '<div style="display:block id="updateCourse"> Update Course:</div>';
            							?>
            							<select name = "update_course">
                							<?php
                    							if(isset($_POST["update_class"]))
                    							{
                        							$result = $pdo->query('SELECT course_ID FROM class WHERE CRN = '.$_POST["enter_CRN"]);
                        							while($row = $result->fetch(PDO::FETCH_ASSOC))
                        							{
                            							$dept = substr($row["course_ID"], 0, 2);
                            							$result = $pdo->query('SELECT course_ID, course_Name FROM course WHERE dept_ID LIKE "%'.$dept.'%"');
                            							while($row = $result->fetch(PDO::FETCH_ASSOC))
                            							{
                            							    echo "<option value = ".$row["course_ID"].">".$row["course_ID"].": ".$row["course_Name"]."</option>";
                            							}
                        							}
                    							}
                							?>
            							</select>
            							<select name = "update_faculty">
                							<?php
                    							if(isset($_POST["update_class"]))
                    							{
                        							$result = $pdo->query('SELECT * FROM user, faculty, faculty_department WHERE user.user_ID = faculty_department.faculty_ID AND faculty_department.faculty_ID = faculty.faculty_ID AND dept_ID = "'.$_POST["check_department"].'"');
                        							while($row = $result->fetch(PDO::FETCH_ASSOC))
                        							{
                            							echo "<option value = ".$row["faculty_ID"].">".$row["first_Name"]." ".$row["last_Name"].": ".$row["faculty_Type"]."</option>";
							                        }
                    							}
                							?>
            							</select>
            							<select name = "update_time_slot">
                							<?php
                    							if(isset($_POST["update_class"]))
                    							{
                        							$result = $pdo->query('SELECT * FROM schedule GROUP BY AUTO ASC');
                        							while($row = $result->fetch(PDO::FETCH_ASSOC))
                        							{
                        							    echo "<option value = ".$row["time_Slot_ID"].">".$row["day_ID"].": ".$row["start_Time"]." - ".$row["end_Time"]."</option>";
                        							}
                    							}
                							?>
            							</select>
            							<select name = "update_room">
                							<?php
                    							if(isset($_POST["update_class"]))
                    							{
                        							$result = $pdo->query('SELECT * FROM room WHERE room_ID LIKE "%NAB%" OR room_ID LIKE "%SAB%" OR room_ID LIKE "%EAB%" OR room_ID LIKE "%WAB%"');
                        							while($row = $result->fetch(PDO::FETCH_ASSOC))
                        							{
                            							echo "<option>".$row["room_ID"]."</option>";
                        							}
                    							}
                							?>
            							</select>
            							<?php
                							if(isset($_POST["new_class_essentials"]))
                							{
                    							$result = $pdo->query('SELECT class.faculty_ID, faculty.faculty_Type, count(class.faculty_ID) FROM class, faculty WHERE class.faculty_ID = faculty.faculty_ID AND class.faculty_ID = '.$_POST["update_faculty"].' AND class.semester_ID = "'.$_POST["new"].'"');
                    							while($row = $result->fetch(PDO::FETCH_ASSOC))
                    							{
                    							     if($row["count(class.faculty_ID)"] == 0)
                    							    {
                    							        $result = $pdo->query('SELECT count(class.time_Slot_ID), count(class.room_ID) FROM class WHERE class.time_Slot_ID = "'.$_POST["update_time_slot"].'" AND class.room_ID = "'.$_POST["update_room"].'" AND semester_ID = "'.$_POST["new"].'"');
                    							        while($row = $result->fetch(PDO::FETCH_ASSOC))
                    							        {
                            							    if($row["count(class.time_Slot_ID)"] == 1 && $row["count(class.room_ID)"] == 1)
                                							{
                                							    echo "There is a schedule conflict!<br>";
                                							}
                                							elseif($row["count(class.time_Slot_ID)"] == 0 && $row["count(class.room_ID)"] == 0)
                                							{
                                    							$result = $pdo->query('UPDATE class SET course_ID = "'.$_POST["update_course"].'" WHERE CRN = '.$_POST["current_CRN"]);
							                                    $result = $pdo->query('UPDATE class SET faculty_ID = '.$_POST["update_faculty"].' WHERE CRN = '.$_POST["current_CRN"]);
							                                    $result = $pdo->query('UPDATE class SET time_SlotID = '.$_POST["update_time_slot"].' WHERE CRN = '.$_POST["current_CRN"]);
							                                    $result = $pdo->query('UPDATE class SET room_ID = "'.$_POST["update_room"].'" WHERE CRN = '.$_POST["current_CRN"]);
                            							    }
                            							}
                        							}
                        							elseif($row["faculty_Type"] == "Full Time")
                        							{
                            							if($row["count(class.faculty_ID)"] < 2)
                            							{
                            							    $result = $pdo->query('SELECT count(class.time_Slot_ID), count(class.room_ID) FROM class WHERE class.time_Slot_ID = "'.$add_time_slot.'" AND class.room_ID = "'.$_POST["add_room"].'" AND semester_ID = "'.$_POST["new"].'"');
                            							    while($row = $result->fetch(PDO::FETCH_ASSOC))
                            							    {
                            							        if($row["count(class.time_Slot_ID)"] == 1 && $row["count(class.room_ID)"] == 1)
                            							        {
                            							            echo "There is a schedule conflict!<br>";
                            							        }
                            							        elseif($row["count(class.time_Slot_ID)"] == 0 && $row["count(class.room_ID)"] == 0)
                            							        {
                            							            $result = $pdo->query('UPDATE class SET course_ID = "'.$_POST["update_course"].'" WHERE CRN = '.$_POST["current_CRN"]);
                            							            $result = $pdo->query('UPDATE class SET faculty_ID = '.$_POST["update_faculty"].' WHERE CRN = '.$_POST["current_CRN"]);
                            							            $result = $pdo->query('UPDATE class SET time_SlotID = '.$_POST["update_time_slot"].' WHERE CRN = '.$_POST["current_CRN"]);
                            							            $result = $pdo->query('UPDATE class SET room_ID = "'.$_POST["update_room"].'" WHERE CRN = '.$_POST["current_CRN"]);
                            							        }
                            							    }
                            							}
                    							        elseif($row["count(class.faculty_ID)"] == 2)
                    							        {
                    							            echo "Faculty is full time and is already teaching two courses.<br>";
                    							        }
                    							    }
                    							    elseif($row["faculty_Type"] == "Part Time")
                    							    {
                    							        if($row["count(class.faculty_ID)"] == 0)
                    							        {
                    							            $result = $pdo->query('SELECT count(class.time_Slot_ID), count(class.room_ID) FROM class WHERE class.time_Slot_ID = "'.$add_time_slot.'" AND class.room_ID = "'.$_POST["add_room"].'" AND semester_ID = "'.$_POST["new"].'"');
                    							            while($row = $result->fetch(PDO::FETCH_ASSOC))
                    							            {
                    							                if($row["count(class.time_Slot_ID)"] == 1 && $row["count(class.room_ID)"] == 1)
                    							                {
                    							                    echo "There is a schedule conflict!<br>";
                    							                }
                    							                elseif($row["count(class.time_Slot_ID)"] == 0 && $row["count(class.room_ID)"] == 0)
                    							                {
                    							                    $result = $pdo->query('UPDATE class SET course_ID = "'.$_POST["update_course"].'" WHERE CRN = '.$_POST["current_CRN"]);
                    							                    $result = $pdo->query('UPDATE class SET faculty_ID = '.$_POST["update_faculty"].' WHERE CRN = '.$_POST["current_CRN"]);
                    							                    $result = $pdo->query('UPDATE class SET time_SlotID = '.$_POST["update_time_slot"].' WHERE CRN = '.$_POST["current_CRN"]);
                    							                    $result = $pdo->query('UPDATE class SET room_ID = "'.$_POST["update_room"].'" WHERE CRN = '.$_POST["current_CRN"]);                                         
                    							                }
                							                }
                							            }
                							            elseif($row["count(class.faculty_ID)"] == 1)
                							            {
                							                echo "Faculty is part time and is already teaching a course.<br>";
                							            }
                							        }
                							    }
            							    }
            							?>
            							<input type = "submit" name = "new_class_essentials" value = "Update course">
            
                                            
            
        							    <br><br>
        							    <?php
            							echo '<div style="display:block id="deleteClass"> Delete Class From Schedule:</div>';
            							?>
        							    <input type = "text" name = "delete-class" placeholder = "Enter CRN" size = "6px">
        							    
        							    <input type = "submit" name = "delete_class" value = "Delete class from schedule"><br>
        							    <?php
        							        if(isset($_POST["delete_class"]))
        							        {
        							            $result = $pdo->query('SELECT CRN, count(CRN) FROM class WHERE CRN = "'.$_POST["delete-class"].'"');
        							            while($row = $result->fetch(PDO::FETCH_ASSOC))
        							            {
        							                if($row["count(CRN)"] == 0)
        							                {
        							                    echo "CRN is not recognized.";
        							                }
        							                else $result = $pdo->query('DELETE FROM class WHERE CRN = "'.$_POST["delete-class"].'"');
        							            }
                							}
            							?>
            							<?php
                							$result = $pdo->query('SELECT * FROM semester GROUP BY AUTO DESC LIMIT 1');
                							while($row = $result->fetch(PDO::FETCH_ASSOC))
                							{
        							            $start_date = $row["start_Date"];
        							            $close_date = strtotime($start_date);
        							            $close_date = strtotime("+14 day", $close_date);
        							            $closing_date = $close_date;
        							            echo '<i style="color:RED;font-size:20px;font-family:calibri ;"><br>'.$row["semester_Name"].' closes on '.date("m/d", $closing_date).'/'.$row["semester_Year"].'</i>';
        							            
        							            
        							            
        							            
        							            if(date("m/d/Y") == $closing_date)
                    							{
                    							    $result = $pdo->query('UPDATE semester SET Operation = "Closed", Active = "FALSE" WHERE semester_ID = "'.$row["semester_ID"].'"');
                    							}
                							}
            							?>
									</form>
									
								</td>
							</tr>
						</tbody>
					</div>
					    </td></tr>
					    <tr><td>
					    <div id="showScheduleDataFilterSearch">
						<thead>
							<tr>
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
            							    <option selected disabled></option>
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
				</section>
				<br><br><br><br><br><br><br><br><br><br><br><br>
			</div>
		</div>
	</body>
	<footer><div></div></footer>
</html>