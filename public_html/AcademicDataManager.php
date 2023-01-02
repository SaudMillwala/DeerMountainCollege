

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
			<div class="bg" style="padding-bottom:660px">
				<header id="header">
					<div class=logoContainer>
						<button onclick="panelOpen()" class='panelButton' id='panelButton'>☰</button>
						<img src="https://i.imgur.com/ZSJeGdX.png" id="logo" alt="logo" onclick = "window.location.href = 'index.html'">
						<img src="https://i.imgur.com/4WU9EeP.png" id="titleImg" alt="titleImg" class=' logoContainer titleImg' height="150px" onclick = "window.location.href = 'index.html'">
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
									<button onclick="window.location.href = 'ScheduleDataManager.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Schedule<br>Manager</button>
								</td>
								<td>
									<button onclick="window.location.href = 'AcademicDataManager.php'" class=adminNav; style="background-color:#006a4e;font-size:80%;margin-top:0px;height:58px;">Academic<br>Manager</button>
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
					<table id="academicManager" style="display:block;">
					    <tr><td>
					    <div id="showAcademicDataElementPlaceHold" style="margin-bottom:50px;display:none;">
						<thead>
							<tr>
								<th>Place a Hold</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="AcademicDataManager.php" method="POST">
										<input type="text" name="student_ID" placeholder="Enter a valid student ID"><br>
										<select name="hold_Type">
											<option selected disabled>Select Hold Type</option>
											<option>Academic</option>
											<option>Disciplinary</option>
											<option>Financial</option>
											<option>Health</option>
										</select><br>
										<input type="submit" name="place_Hold_submit">
										<input type="reset" name="place_Hold_reset">
									</form>

									<?php 
									if (isset($_POST["place_Hold_submit"]))
									{
									    
									     echo '<i style="color:RED;font-size:20px;font-family:calibri ;">
                                                        Current Holds On Student: </i> <br>';
									    
									    if (!empty($_POST["student_ID"]) && !empty($_POST["hold_Type"]))
									    {
									        if (!empty($_POST["hold_Type"]))
									        {
									            if ($_POST["hold_Type"] == "Academic") {
									                $hold_ID = "AC";
									            } elseif ($_POST["hold_Type"] == "Disciplinary") {
									                $hold_ID = "DS";
									            } elseif ($_POST["hold_Type"] == "Financial") {
									                $hold_ID = "FI";
									            } elseif ($_POST["hold_Type"] == "Health") {
									                $hold_ID = "HL";
									               
									            } 
									            
									            $result = $pdo->query('SELECT student_hold.student_ID, student_hold.hold_ID, hold.hold_ID FROM student_hold, hold WHERE student_hold.hold_ID = hold.hold_ID AND student_hold.student_ID = '.$_POST["student_ID"]);
    								        while($row = $result->fetch(PDO::FETCH_ASSOC))
    								        {
    								            if($row["student_ID"] == $_POST["student_ID"] && $row["hold_ID"] == $hold_ID )
    								            {
    								                
    								                echo '<i style="color:RED;font-size:20px;font-family:calibri ;">
                                                        Cannot add any more of this hold type: </i>';
    								                
    								                echo $row["hold_ID"]." to ".$row["student_ID"]."<br><br>";
    								            }
    								        }
									            
									        } else
									        {
									            echo "Enter a hold type";
									        }
									        if (!empty($_POST["student_ID"]))
									        {
									           
									            $result = $pdo->query("SELECT student.student_ID FROM student");
									            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
									                $studentid = $row["student_ID"];
									                if ($studentid == $_POST["student_ID"]) {
									                    date_default_timezone_set("America/New_York");
									                    $date = date("m/d/Y");
									                    $result = $pdo->query("INSERT INTO student_hold (student_ID, hold_ID, hold_Date) VALUES (".$studentid.', "'.$hold_ID.'", "'.$date.'")');
									                    $result = $pdo->query("SELECT * FROM student_hold WHERE student_ID = ".$studentid);
									                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
									                        echo "Student ID: " .$row["student_ID"] ."<br>" ."Hold ID: " .$row["hold_ID"] ."<br>" ."Date: " .$row["hold_Date"] ."<br><br>";
									                        
									                    }
									                    
									                }
									            }
									             
									        } else
									        {
									            echo "Enter a student ID";
									        }
									    } else
									    {
									        echo "Enter a student ID and a hold type";
									    }
    								    
									}
									?>
									<?php
									    //if(isset($_POST["place_Hold_submit"]))
									   // { 
									       // $result = $pdo->query('SELECT student_hold.student_ID, student_hold.hold_ID, hold.hold_ID FROM student_hold, hold WHERE student_hold.hold_ID = hold.hold_ID AND student_hold.student_ID = '.$_POST["student_ID"]);
									       // while($row = $result->fetch(PDO::FETCH_ASSOC))
									       // {
									       //     if($row["student_ID"] == $_POST["student_ID"] && $row["hold_ID"] == $_POST["hold_Type"])
									       //     {
									       //         echo "This student already has that hold type";
									       //     }
									       // }
									  //  }
									?>
									<?php
									   // if(isset($_POST["place_Hold_submit"]))
									   // {
									   //     $result = $pdo->query('SELECT count(student_ID) FROM student_hold WHERE student_ID = '.$_POST["student_ID"].' AND hold_ID = "'.$_POST["hold_Type"].'"');
									   //     while($row = $result->fetch(PDO::FETCH_ASSOC))
									   //     {
									   //         if($row["count(student_ID)"] == 1)
									   //         {
									   //             echo "This student already has that hold type";
									   //         }
									   //     }
									   // }
									?>
								</td>
							</tr>
						</tbody>
					</div>
					    </td></tr>
                        <tr><td>
					    <div id="showAcademicDataElementUpdateHold" style="display:block;">
						<thead>
							<tr>
								<th>Update Student Hold</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="AcademicDataManager.php" method="POST">
										<input type="text" name="update_student_Hold" placeholder="Enter a valid student ID"><br>
										<select name="hold_Type_update">
											<option selected disabled>Select Hold Type</option>
											<option>Academic</option>
											<option>Disciplinary</option>
											<option>Financial</option>
											<option>Health</option>
										</select><br>
										<input type="submit" name="update_Hold_submit">
										<input type="reset" name="update_Hold_reset">
									</form>
									<?php
									if (isset($_POST["update_Hold_submit"])) {
									    if (!empty($_POST["update_student_Hold"]) &&!empty($_POST["hold_Type_update"])) {
									        if ($_POST["hold_Type_update"] == "Academic") {$hold_ID = "AC";
									        } elseif ($_POST["hold_Type_update"] == "Disciplinary") {
									            $hold_ID = "DS";
									        } elseif ($_POST["hold_Type_update"] == "Financial") {
									            $hold_ID = "FI";
									        } elseif ($_POST["hold_Type_update"] == "Health") {
									            $hold_ID = "HL";
									        }
									        $result = $pdo->query("SELECT student_ID FROM student_Hold");
									        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
									            $studentid = $row["student_ID"];
									            if ($studentid == $_POST["update_student_Hold"]) {
									                date_default_timezone_set("America/New_York");
									                $date = date("m/d/Y");
									                if ($_POST["update_student_Hold"] == $studentid) {
									                    $result = $pdo->query('UPDATE student_Hold SET hold_ID = "' .$hold_ID .'", hold_Date = "' .$date .'" WHERE student_ID = ' .$studentid);
									                }
									                $result = $pdo->query("SELECT * FROM student_Hold WHERE student_ID = " .$studentid);
									                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
									                    echo "Student ID: " .$row["student_ID"] ."<br>" ."Hold ID: " .$row["hold_ID"] ."<br>" ."Date: " .$row["hold_Date"] ."<br>";
									                }
									            }
									        }
									    } else {
									        echo "Enter a valid student ID and hold";
									    }
									}?>
								</td>
							</tr>
						</tbody>
					</div>
					    </td></tr>
                        <tr><td>
					    <div id="showAcademicDataElementDeleteHold" style="display:block;">
						<thead>
							<tr>
								<th>Delete a Student Hold</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="AcademicDataManager.php" method="POST">
										<input type="text" name="student_Hold_Delete" placeholder="Enter student ID"><br>
											<select name="hold_Type_delete">
											<option selected disabled>Select Hold Type</option>
											<option value = "AC">Academic</option>
											<option value = "DS">Disciplinary</option>
											<option value = "FI">Financial</option>
											<option value = "HL">Health</option>
										</select><br>
										<input type="submit" name="student_Hold_Delete_submit">
										<input type="reset" name="student_Hold_Delete_reset">
									</form>
									<?php 
									 if (isset($_POST["student_Hold_Delete_submit"])) {
									   
									    if (!empty($_POST["student_Hold_Delete"])) {
									       // $studentid = $_POST["student_Hold_Delete"];
									        $result = $pdo->query('DELETE FROM student_hold WHERE hold_ID = "'.$_POST["hold_Type_delete"].'" AND student_ID = '.$_POST["student_Hold_Delete"] );
									        
									    } 
									    
									    else {
									        echo "Hold Not Removed. Please Try Again";
									    }
									}
									?>
								</td>
							</tr>
						</tbody>
					</div>
					    </td></tr>
                        <tr><td>
					    <div id="showAcademicDataElementDeleteHold" style="display:block;">
						<thead>
							<tr>
								<th>Select student for academic declaration</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<form action="AcademicDataManager.php" method="POST">
										<input type="text" name="select_student" placeholder="Enter student ID">
										<input type="submit" name="select_student_submit">
										<input type="reset">
									</form>
									<?php
									    if(isset($_POST["select_student_submit"]))
									    {
									        $result = $pdo->query('SELECT student.student_ID,user.user_ID,user.first_Name,user.last_Name,count(student_ID) FROM student,user WHERE user.user_ID = student.student_ID AND student_ID = '.$_POST["select_student"]);
									        while($row = $result->fetch(PDO::FETCH_ASSOC))
									        {
									            if($row["count(student_ID)"] == 1)
									            {
									                $_SESSION["student"] = $row["student_ID"];
									                echo $row["first_Name"]." ".$row["last_Name"]."<br>";
									                echo "Student ID: ".$row["student_ID"];
									            }
									            elseif($row["count(student_ID)"] == 0)
									            {
									                echo "Student not recognized";
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
					    <div id="declareMajorUndergrad" style="display:block;">
						<thead>
							<tr>
								<th>Declare a Major</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
								    <form action="AcademicDataManager.php" method="POST">
    							        <select name = "declare_student_major">
    							            <option selected disabled></option>
        							    <?php
        							        $result = $pdo->query('SELECT * FROM major WHERE major_ID NOT IN (SELECT major_ID FROM student_major WHERE student_ID = '.$_SESSION["student"].')');
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
    							                $result = $pdo->query('SELECT count(*) FROM student_major WHERE student_ID = '.$_SESSION["student"]);
    							                while($row = $result->fetch(PDO::FETCH_ASSOC))
    							                {
    							                    if($row["count(*)"] == 2)
    							                    {
    							                        echo "You have already declared 2 majors.";
    							                    }
    							                    elseif($row["count(*)"] == 1)
    							                    {
        							                    $result = $pdo->query('SELECT count(*) FROM student_minor WHERE student_ID = '.$_SESSION["student"]);
        							                    while($row = $result->fetch(PDO::FETCH_ASSOC))
        							                    {
        							                        if($row["count(*)"] == 1)
        							                        {
        							                            echo "You already have declared a minor, so you can't declare another major.";
        							                        }
        							                        elseif($row["count(*)"] == 0)
        							                        {
        							                            $result = $pdo->query('INSERT INTO student_major VALUES('.$_SESSION["student"].', "'.$_POST["declare_student_major"].'", "'.date("m/d/Y").'")');
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
								    <form action="AcademicDataManager.php" method="POST">
								        <select name = "select_student_major">
								            
						                <?php
						                    $result = $pdo->query('SELECT * FROM major, student_major WHERE major.major_ID = student_major.major_ID AND student_major.student_ID = '.$_SESSION["student"]);
            						        while($row = $result->fetch(PDO::FETCH_ASSOC))
            						        {
            						            echo "<option value = ".$row["major_ID"].">".$row["major_Name"]."</option>";
            						        }
        						        ?>
    						            </select> 
    						            <select name = "change_student_major">
    						                <option selected disabled></option>
        					            <?php
					                        $result = $pdo->query('SELECT * FROM major WHERE major_ID NOT IN (SELECT major_ID FROM student_major WHERE student_ID = '.$_SESSION["student"].')');
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
            					                $result = $pdo->query('UPDATE student_major SET major_ID = "'.$_POST["change_student_major"].'" WHERE major_ID = "'.$_POST["select_student_major"].'" AND student_ID = '.$_SESSION["student"]);
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
								    <form action="AcademicDataManager.php" method="POST">
								        <select name = "drop_student_major">
        						        <?php
						                    $result = $pdo->query('SELECT count(*) FROM student_major WHERE student_ID = '.$_SESSION["student"]);
            						        while($row = $result->fetch(PDO::FETCH_ASSOC))
            						        {
						                        if($row["count(*)"] == 2)
						                        {
						                            $result = $pdo->query('SELECT * FROM major, student_major WHERE major.major_ID = student_major.major_ID AND student_major.student_ID = '.$_SESSION["student"]);
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
        						                $result = $pdo->query('DELETE FROM student_major WHERE major_ID = "'.$_POST["drop_student_major"].'" AND student_ID = '.$_SESSION["student"]);
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
								    <form action="AcademicDataManager.php" method="POST">
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
    						                    $result = $pdo->query('SELECT count(*) FROM student_major WHERE student_ID = '.$_SESSION["student"]);
                						        while($row = $result->fetch(PDO::FETCH_ASSOC))
            						            {
                						            if($row["count(*)"] == 2)
                						            {
                						                echo "You already have two majors declared, so you can't declare a minor.";
                						            }
                						            elseif($row["count(*)"] == 1)
                						            {
						                                $result = $pdo->query('SELECT count(*) FROM student_minor WHERE student_ID = '.$_SESSION["student"]);
    						                            while($row = $result->fetch(PDO::FETCH_ASSOC))
    						                            {
						                                    if($row["count(*)"] == 1)
						                                    {
						                                        echo "A minor is already declared.";
						                                    }
						                                    elseif($row["count(*)"] == 0)
    						                                {
    						                                    $result = $pdo->query('INSERT INTO student_minor VALUES('.$_SESSION["student"].', "'.$_POST["declare_student_minor"].'", "'.date("m/d/Y").'")');
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
								    <form action="AcademicDataManager.php" method="POST">
								        <select name = "select_student_minor">
								            
        						            <?php
						                        $result = $pdo->query('SELECT * FROM minor, student_minor WHERE minor.minor_ID = student_minor.minor_ID AND student_minor.student_ID = '.$_SESSION["student"]);
            						            while($row = $result->fetch(PDO::FETCH_ASSOC))
            						            {
            						                echo "<option value = ".$row["minor_ID"].">".$row["minor_Name"]."</option>";
            						            }
        						            ?>
        						        </select>
    						            <select name = "change_student_minor">
    						                <option selected disabled></option>
        						            <?php
            					                $result = $pdo->query('SELECT * FROM minor WHERE minor_ID NOT IN (SELECT minor_ID FROM student_minor WHERE student_ID = '.$_SESSION["student"].')');
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
					                            $result = $pdo->query('UPDATE student_minor SET minor_ID = "'.$_POST["change_student_minor"].'" WHERE minor_ID = "'.$_POST["select_student_minor"].'" AND student_ID = '.$_SESSION["student"]);
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
								    <form action="AcademicDataManager.php" method="POST">
								        <select name = "drop_student_minor">
        						            <?php
						                        $result = $pdo->query('SELECT * FROM minor, student_minor WHERE minor.minor_ID = student_minor.minor_ID AND student_minor.student_ID = '.$_SESSION["student"]);
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
    						                    $result = $pdo->query('DELETE FROM student_minor WHERE minor_ID = "'.$_POST["drop_student_minor"].'" AND student_ID = '.$_SESSION["student"]);
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
		<footer>
            <div></div>
					</table>
				</section>
				<br><br><br><br><br><br><br><br><br><br><br><br>
			</div>
		</div>
	</body>
	<footer><div></div></footer>
</html>