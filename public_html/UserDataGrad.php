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
								    <button onclick="window.location.href = 'UserDataGrad.php'" class=adminNav; style="background-color:#006a4e;font-size:80%;margin-top:0px;height:58px;">Student<br>Information</button>
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
								    <button onclick="window.location.href = 'StudentDegreeAuditGrad.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Degree<br>Audit</button>
							    </td>
								
						    </tr>
					    </tbody>
				    </table>
                    <form action = "UserDataGrad.php" method = "POST">
                    <table id="userDataManager" style="display:block;">
					    <tr><td>
					    <div id="showUserDataUndergrad" style="margin-bottom:50px;display:none;">
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
								<th>Student Information</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
								    <form action="UserDataUndergrad.php" method="POST">
								        <?php
					                        $result = $pdo->query('SELECT * FROM user, login WHERE user.user_ID = login.user_ID AND user.user_ID = '.$_SESSION["user_ID"]);
    					                    while($row = $result->fetch(PDO::FETCH_ASSOC))
    					                    {
    					                        echo "User ID: " .$row["user_ID"] ."<br>" .
    					                        "Name: " .$row["first_Name"] ." " .$row["last_Name"] ."<br>" .
        					                    "Gender: " .$row["Gender"] ."<br>" .
        					                    "Date of birth: " .$row["DOB"] ."<br>" .
        					                    "City: " .$row["City"] ."<br>" ."Street: " .$row["Street"] ."<br>" ."State: " .$row["State"] ."<br>" . "Zip code: ".$row["zip_Code"]."<br>".
        					                    "User type: " .$row["user_Type"] ."<br>" .
        					                    "Email: " .$row["user_Email"] ."<br>";
        					                }
        					                $result = $pdo->query('SELECT * FROM hold, student_hold WHERE hold.hold_ID = student_hold.hold_ID AND student_ID = '.$_SESSION["user_ID"]);
        					                while($row = $result->fetch(PDO::FETCH_ASSOC))
        					                {
        					                    if($row["hold_ID"] == "NA")
        					                    {
        					                        echo "No holds<br>";
        					                    }
        					                    else echo $row["hold_Type"]." hold<br>";
        					                }
        					                $result = $pdo->query('SELECT * FROM advisor, user WHERE user.user_ID = advisor.faculty_ID AND advisor.student_ID = '.$_SESSION["user_ID"]);
        					                while($row = $result->fetch(PDO::FETCH_ASSOC))
        					                {
        					                    echo "Advisor: ".$row["first_Name"]." ".$row["last_Name"]."<br>";
        					                }
        					            ?>
								    </form>
								</td>
							</tr>
						</tbody>
						</div>
					    </td></tr>
					    
                        <tr><td>
					    <div id="searchScheduleUndergrad" style="display:block;">
						<thead>
							<tr>
								<th>Schedule Search</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
								    <form action="UserDataUndergrad.php" method="POST">
								        <select name = "semester">
                                            <option>2023-S</option>
                                            <option>2022-F</option>
                                        </select>
                                        <select name = "department">
                                            <option selected disabled></option>
                                            <?php
                                                $result = $pdo->query('SELECT dept_ID, dept_Name FROM department ORDER BY dept_ID');
                                                while($row = $result->fetch(PDO::FETCH_ASSOC))
                                                {
                                                    echo '<option value = '.$row["dept_ID"].'>' . $row["dept_Name"] . '</option>';
                                                }
                                            ?>
                                        </select>
                                        <input type = "submit" name = "schedule_search" value = "Search master schedule"><br>
                                        <?php
                                            if(isset($_POST["schedule_search"]))
                                            {
                                                $result = $pdo->query('SELECT class.CRN, class.course_ID, class.section_Num, user.first_Name, user.last_Name, schedule.day_ID, schedule.start_Time, schedule.end_Time, class.room_ID, class.semester_ID, class.seat_Avail FROM class, user, schedule WHERE class.faculty_ID = user.user_ID AND class.time_Slot_ID = schedule.time_Slot_ID AND class.semester_ID = "'.$_POST["semester"].'" AND class.course_ID LIKE "%'.$_POST["department"].'%"');
                                                while($row = $result->fetch(PDO::FETCH_ASSOC))
                                                {
                                                    echo "<tr style='font-size:15px'>";
                                                    echo "<td>". $row["CRN"] ."<br>"."</td>";
                                                    echo "<td>". $row["course_ID"]."<br>" ."</td>";
                                                    echo "<td>"."Section: ". $row["section_Num"]."<br>" ."</td>";
                                                    echo "<td>". $row["first_Name"] . ' ' . $row["last_Name"]."<br>" ."</td>";
                                                    echo "<td>". $row["day_ID"]."<br>" ."</td>";
                                                    echo "<td>". $row["start_Time"] . ' ' . $row["end_Time"]."<br>" ."</td>";
                                                    echo "<td>". $row["room_ID"]."<br>" ."</td>";
                                                    echo "<td>". $row["semester_ID"]."<br>" ."</td>";
                                                    echo "<td>". $row["seat_Avail"]."<br><br>" ."</td>";
                                                    echo "</tr>";
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
					    <div id="showScheduleUndergrad" style="display:block;">
						<thead>
							<tr>
								<th>My Schedule</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
								    <form action="UserDataUndergrad.php" method="POST">
								        <select name = "student_semester">
                                            <option>2023-S</option>
                                            <option>2022-F</option>
                                        </select>
                                        <input type = "submit" name = "student_schedule" value = "View Schedule"><br>
                                        <?php
                                            if(isset($_POST["student_schedule"]))
                                            {
                                                $result = $pdo->query('SELECT * FROM class, enrollment, user WHERE class.CRN = enrollment.CRN AND user.user_ID = class.faculty_ID AND enrollment.semester_ID = "'.$_POST["student_semester"].'" AND enrollment.student_ID = '.$_SESSION["user_ID"]);
                                                while($row = $result->fetch(PDO::FETCH_ASSOC))
                                                {
                                                    echo "Course: ".$row["course_ID"]."<br>"
                                                    . "Faculty: ".$row["first_Name"]." ".$row["last_Name"]."<br>"
                                                    . "Grade assigned: ".$row["Grade"]."<br><br>";
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
					    <div id="updateUndergrad" style="display:block;">
						<thead>
							<tr>
								<th>Update My Information</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
								    <form action="UserDataUndergrad.php" method="POST">
								        <input type = "text" name = "update_first_Name" placeholder = "First name"><br>
        						        <input type = "text" name = "update_last_Name" placeholder = "Last name"><br>
						                <input type = "text" name = "update_Gender" placeholder = "Gender"><br>
						                <input type = "text" name = "update_City" placeholder = "City"><br>
						                <input type = "text" name = "update_Street" placeholder = "Street"><br>
						                <input type = "text" name = "update_State" placeholder = "State"><br>
						                <input type = "text" name = "update_zip_Code" placeholder = "Zip code"><br>
						                <input type = "submit" name = "update_info_submit" value = "Update">
						                <input type = "reset">
						                <?php
						                    if(isset($_POST["update_info_submit"]))
						                    {
						                        $first_Name = $_POST["update_first_Name"];
						                        $last_Name = $_POST["update_last_Name"];
						                        $Gender = $_POST["update_Gender"];
						                        $City = $_POST["update_City"];
						                        $Street = $_POST["update_Street"];
						                        $State = $_POST["update_State"];
						                        $zip_Code = $_POST["update_zip_Code"];
						                        if ($first_Name != "") {
						                            $result = $pdo->query('UPDATE user SET first_Name = "' .$first_Name .'" WHERE user_ID = ' .$_SESSION["user_ID"]);
                						            header("Location: undergraduate.php");
                						        }
						                        elseif ($last_Name != "") {
						                            $result = $pdo->query('UPDATE user SET last_Name = "' .$last_Name .'" WHERE user_ID = ' .$_SESSION["user_ID"]);
                						            header("Location: undergraduate.php");
                						        }
                						        elseif ($Gender != "") {
                						            $result = $pdo->query('UPDATE user SET Gender = "' .$Gender .'" WHERE user_ID = ' .$_SESSION["user_ID"]);
                						            header("Location: undergraduate.php");
                						        }
                						        elseif ($DOB != "") {
                						            $result = $pdo->query('UPDATE user SET DOB = "' .$DOB .'" WHERE user_ID = ' .$_SESSION["user_ID"]);
                						            header("Location: undergraduate.php");
                						        }
                						        elseif ($City != "") {
                						            $result = $pdo->query('UPDATE user SET City = "' .$City .'" WHERE user_ID = ' .$_SESSION["user_ID"]);
                						            header("Location: undergraduate.php");
                						        }
						                        elseif ($Street != "") {
						                            $result = $pdo->query('UPDATE user SET Street = "' .$Street .'" WHERE user_ID = ' .$_SESSION["user_ID"]);
                						            header("Location: undergraduate.php");
                						        }
						                        elseif ($State != "") {
						                            $result = $pdo->query('UPDATE user SET State = "' .$State .'" WHERE user_ID = ' .$_SESSION["user_ID"]);
                						            header("Location: undergraduate.php");
                						        }
						                        elseif ($zip_Code != "") {
						                            $result = $pdo->query("UPDATE user SET zip_Code = " .$zip_Code ." WHERE user_ID = " .$_SESSION["user_ID"]);
                						            header("Location: undergraduate.php");
                						        }
                						        elseif ($user_Type != "") {
                						            $result = $pdo->query('UPDATE user SET user_Type = "' .$user_Type .'" WHERE user_ID = ' .$_SESSION["user_ID"]);
                						            header("Location: undergraduate.php");
                						        }
						                        elseif ($user_Email != "") {
						                            $result = $pdo->query('UPDATE login SET user_Email = "' .$user_Email .'" WHERE user_ID = ' .$_SESSION["user_ID"]);
                						            header("Location: undergraduate.php");
                						        }
						                        else echo "<br>Enter information to update";
						                    }
						                ?><br>
								    </form>
								</td>
							</tr>
						</tbody>
						</div>
					    </td></tr>
					    
					    <tr><td>
					    <div id="declareMajorUndergrad" style="display:block;">
						<thead>
							<tr>
								<th>Declare a Major</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
								    <form action="UserDataUndergrad.php" method="POST">
    							        <select name = "declare_student_major">
    							            <option selected disabled></option>
        							    <?php
        							        $result = $pdo->query('SELECT * FROM major WHERE major_ID NOT IN (SELECT major_ID FROM student_major WHERE student_ID = '.$_SESSION["user_ID"].')');
        							        while($row = $result->fetch(PDO::FETCH_ASSOC))
        							        {
        							            echo "<option value = ".$row["major_ID"].">".$row["major_Name"]."</option>";
        							        }
        							    ?>
    							        </select>
    							        <input type = "submit" name = "declare_major" value = "Declare major">
        							    <?php
    							            if(isset($_POST["declare_major"]))
    							            {
    							                $result = $pdo->query('SELECT count(*) FROM student_major WHERE student_ID = '.$_SESSION["user_ID"]);
    							                while($row = $result->fetch(PDO::FETCH_ASSOC))
    							                {
    							                    if($row["count(*)"] == 2)
    							                    {
    							                        echo "You have already declared 2 majors.";
    							                    }
    							                    elseif($row["count(*)"] == 1)
    							                    {
        							                    $result = $pdo->query('SELECT count(*) FROM student_minor WHERE student_ID = '.$_SESSION["user_ID"]);
        							                    while($row = $result->fetch(PDO::FETCH_ASSOC))
        							                    {
        							                        if($row["count(*)"] == 1)
        							                        {
        							                            echo "You already have declared a minor, so you can't declare another major.";
        							                        }
        							                        elseif($row["count(*)"] == 0)
        							                        {
        							                            $result = $pdo->query('INSERT INTO student_major VALUES('.$_SESSION["user_ID"].', "'.$_POST["declare_student_major"].'", "'.date("m/d/Y").'")');
        							                        }
        							                    }
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
					    <div id="changeMajorUndergrad" style="display:block;">
						<thead>
							<tr>
								<th>Change Major</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
								    <form action="UserDataUndergrad.php" method="POST">
								        <select name = "select_student_major">
						                <?php
						                    $result = $pdo->query('SELECT * FROM major, student_major WHERE major.major_ID = student_major.major_ID AND student_major.student_ID = '.$_SESSION["user_ID"]);
            						        while($row = $result->fetch(PDO::FETCH_ASSOC))
            						        {
            						            echo "<option value = ".$row["major_ID"].">".$row["major_Name"]."</option>";
            						        }
        						        ?>
    						            </select> 
    						            <select name = "change_student_major">
    						                <option selected disabled></option>
        					            <?php
					                        $result = $pdo->query('SELECT * FROM major WHERE major_ID NOT IN (SELECT major_ID FROM student_major WHERE student_ID = '.$_SESSION["user_ID"].')');
            					            while($row = $result->fetch(PDO::FETCH_ASSOC))
            					            {
            					                echo "<option value = ".$row["major_ID"].">".$row["major_Name"]."</option>";
            					            }
    					                ?>
    					                </select> 
    					                <input type = "submit" name = "change_major" value = "Change major">
        					            <?php
            					            if(isset($_POST["change_major"]))
            					            {
            					                $result = $pdo->query('UPDATE student_major SET major_ID = "'.$_POST["change_student_major"].'" WHERE major_ID = "'.$_POST["select_student_major"].'" AND student_ID = '.$_SESSION["user_ID"]);
            					            }
    					                ?>
								    </form>
								</td>
							</tr>
						</tbody>
						</div>
					    </td></tr>
					    
					    <tr><td>
					    <div id="dropMajorUndergrad" style="display:block;">
						<thead>
							<tr>
								<th>Drop Major</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
								    <form action="UserDataUndergrad.php" method="POST">
								        <select name = "drop_student_major">
        						        <?php
						                    $result = $pdo->query('SELECT count(*) FROM student_major WHERE student_ID = '.$_SESSION["user_ID"]);
            						        while($row = $result->fetch(PDO::FETCH_ASSOC))
            						        {
						                        if($row["count(*)"] == 2)
						                        {
						                            $result = $pdo->query('SELECT * FROM major, student_major WHERE major.major_ID = student_major.major_ID AND student_major.student_ID = '.$_SESSION["user_ID"]);
                    						        while($row = $result->fetch(PDO::FETCH_ASSOC))
                    						        {
                    						            echo "<option value = ".$row["major_ID"].">".$row["major_Name"]."</option>";
                    						        }
                						        }
            						        }
        						        ?>
    						            </select>
    						            <input type = "submit" name = "drop_major" value = "Drop major">
    						            <?php
        						            if(isset($_POST["drop_student_major"]))
        						            {
        						                $result = $pdo->query('DELETE FROM student_major WHERE major_ID = "'.$_POST["drop_student_major"].'" AND student_ID = '.$_SESSION["user_ID"]);
        						            }
    						            ?>
								    </form>
								</td>
							</tr>
						</tbody>
						</div>
					    </td></tr>
					    
					    
					    
					    <tr><td>
					    <div id="declareMajorUndergrad" style="display:block;">
						<thead>
							<tr>
								<th>Declare a Minor</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
								    <form action="UserDataUndergrad.php" method="POST">
								        <select name = "declare_student_minor">
								            <option selected disabled></option>
            						        <?php
    						                    $result = $pdo->query('SELECT * FROM minor');
						                        while($row = $result->fetch(PDO::FETCH_ASSOC))
						                        {
						                            echo "<option value = ".$row["minor_ID"].">".$row["minor_Name"]."</option>";
            						        }
        						            ?>
    						            </select>
    						            <input type = "submit" name = "declare_minor" value = "Declare minor">
        						        <?php
						                    if(isset($_POST["declare_minor"]))
        						            {
    						                    $result = $pdo->query('SELECT count(*) FROM student_major WHERE student_ID = '.$_SESSION["user_ID"]);
                						        while($row = $result->fetch(PDO::FETCH_ASSOC))
            						            {
                						            if($row["count(*)"] == 2)
                						            {
                						                echo "You already have two majors declared, so you can't declare a minor.";
                						            }
                						            elseif($row["count(*)"] == 1)
                						            {
						                                $result = $pdo->query('SELECT count(*) FROM student_minor WHERE student_ID = '.$_SESSION["user_ID"]);
    						                            while($row = $result->fetch(PDO::FETCH_ASSOC))
    						                            {
						                                    if($row["count(*)"] == 1)
						                                    {
						                                        echo "A minor is already declared.";
						                                    }
						                                    elseif($row["count(*)"] == 0)
    						                                {
    						                                    $result = $pdo->query('INSERT INTO student_minor VALUES('.$_SESSION["user_ID"].', "'.$_POST["declare_student_minor"].'", "'.date("m/d/Y").'")');
                        			    			        }
                    					    	        }
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
					    <div id="updateMinorUndergrad" style="display:block;">
						<thead>
							<tr>
								<th>Update Minor</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
								    <form action="UserDataUndergrad.php" method="POST">
								        <select name = "select_student_minor">
        						            <?php
						                        $result = $pdo->query('SELECT * FROM minor, student_minor WHERE minor.minor_ID = student_minor.minor_ID AND student_minor.student_ID = '.$_SESSION["user_ID"]);
            						            while($row = $result->fetch(PDO::FETCH_ASSOC))
            						            {
            						                echo "<option value = ".$row["minor_ID"].">".$row["minor_Name"]."</option>";
            						            }
        						            ?>
        						        </select>
    						            <select name = "change_student_minor">
    						                <option selected disabled></option>
        						            <?php
            					                $result = $pdo->query('SELECT * FROM minor WHERE minor_ID NOT IN (SELECT minor_ID FROM student_minor WHERE student_ID = '.$_SESSION["user_ID"].')');
            					                while($row = $result->fetch(PDO::FETCH_ASSOC))
            					                {
            					                    echo "<option value = ".$row["minor_ID"].">".$row["minor_Name"]."</option>";
            					                }
        					                ?>
    					                </select>
					                    <input type = "submit" name = "change_minor" value = "Change minor">
					                    <?php
					                        if(isset($_POST["change_minor"]))
					                        {
					                            $result = $pdo->query('UPDATE student_minor SET minor_ID = "'.$_POST["change_student_minor"].'" WHERE minor_ID = "'.$_POST["select_student_minor"].'" AND student_ID = '.$_SESSION["user_ID"]);
        					                }
    					                ?>
								    </form>
								</td>
							</tr>
						</tbody>
						</div>
					    </td></tr>
					    
					    <tr><td>
					    <div id="dropMinorUndergrad" style="display:block;">
						<thead>
							<tr>
								<th>Drop Minor</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
								    <form action="UserDataUndergrad.php" method="POST">
								        <select name = "drop_student_minor">
        						            <?php
						                        $result = $pdo->query('SELECT * FROM minor, student_minor WHERE minor.minor_ID = student_minor.minor_ID AND student_minor.student_ID = '.$_SESSION["user_ID"]);
            						            while($row = $result->fetch(PDO::FETCH_ASSOC))
            						            {
            						                echo "<option value = ".$row["minor_ID"].">".$row["minor_Name"]."</option>";
            						            }
        						            ?>
        						        </select>
        						        <input type = "submit" name = "drop_minor" value = "Drop minor">
        						        <?php
    						                if(isset($_POST["drop_student_minor"]))
    						                {
    						                    $result = $pdo->query('DELETE FROM student_minor WHERE minor_ID = "'.$_POST["drop_student_minor"].'" AND student_ID = '.$_SESSION["user_ID"]);
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