<?php
    session_start();
    if($_SESSION["status"] != true)
    {
        header("Location: login.php");
    }
    if($_SESSION["status"] == true)
    {
        $_SESSION["undergraduate"] = true;
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
		<title>Undergraduate Portal</title>
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
					    <h1 style="font-size:30px;">Undergraduate Student Portal</h1>
					    <?php 
					    if ($_SESSION["user_Type"] != "Undergraduate"){
					        if ($_SESSION["user_Type"] == "Admin"){
					            header("Location: admin.php");
					        }
					        if ($_SESSION["user_Type"] == "Faculty"){
					            header("Location: faculty.php");
					        }
					        if ($_SESSION["user_Type"] == "Graduate"){
					            header("Location: graduate.php");
					        }
					        if ($_SESSION["user_Type"] == "Research Staff"){
					            header("Location: research_Staff.php");
					        }
					    }
					    ?>
						<h2 class="mt-2">Logged in as: <?php echo $_SESSION["user_Email"]; ?></h2>


                        <form action="undergraduate.php" method="POST">
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
								    <button onclick="window.location.href = 'UserDataUndergrad.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Student<br>Information</button>
								</td>
							    <td>
								    <button onclick="window.location.href = 'ScheduleDataUndergrad.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">My Schedule</button>
							    </td>
							    <td>
								    <button onclick="window.location.href = 'AcademicDataUndergrad.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Academic<br>Information</button>
							    </td>
							    <td>
								    <button onclick="window.location.href = 'StudentTranscriptUndergrad.php'" class=adminNav; style="background-color:#006a4e;font-size:80%;margin-top:0px;height:58px;">Unofficial<br>Transcript</button>
							    </td>
							    <td>
								    <button onclick="window.location.href = 'StudentDegreeAuditUndergrad.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Degree<br>Audit</button>
							    </td>
								
						    </tr>
					    </tbody>
				    </table>
                    <form action = "StudentTranscriptUndergrad.php" method = "POST">
                    <table id="Missing" style="display:block;">
					    <tr><td>
					    <div id="Missing">
						<thead>
							<tr> <?php 
							    
							    $result = $pdo->query('SELECT * FROM hold, student_hold WHERE hold.hold_ID = student_hold.hold_ID AND student_ID = '.$_SESSION["user_ID"]);
							    $count = 1;
        					                while($row = $result->fetch(PDO::FETCH_ASSOC))
        					                {
        					                    
        					                    echo '<i style="color:RED;font-size:20px;font-family:calibri;x;"><br>* '.$row["hold_Type"]. ' Hold On Account*</i>';
        					                    
        					                    
        					                    $count++;
        					                }
        					                if ($count > 1)
        					                    {
        					                        echo '<i style="color:RED;font-size:20px;font-family:calibri;"><br> *You May Not Register For Classes*<br></i>';
        					                        echo '<i style="color:RED;font-size:20px;font-family:calibri ;"> *Please Contact An Administrator To Remove The Hold On Your Account*<br></i>';
        					                         
        					                    }
        					                
							    ?>
								<th>Transcript</th>
							</tr>
						</thead>
						<tbody>
						    
							<tr>
							    
								<td>
								    
								    <?php
								    
								     //Student Info
							        
							         $result = $pdo->query('SELECT * FROM student,user, login WHERE student.student_ID = user.user_ID AND user.user_ID = login.user_ID AND user.user_ID = '.$_SESSION["user_ID"]);
    					                    while($row = $result->fetch(PDO::FETCH_ASSOC))
    					                    {
    					                        
    					                        echo "<b>School: </b> Deer Mountain College<br>";
    					                        
    					                        echo "<b>Name: </b>" .$row["first_Name"] ." " .$row["last_Name"] ."<br>" .
        					                    "<b>Gender: </b>" .$row["Gender"] ."<br>" .
        					                    "<b>Date of birth: </b>" .$row["DOB"] ."<br> <b>Address: </b><br>" .
        					                    "<b>City: </b>" .$row["City"] ."" .
        					                    "<b> Street: </b>" .$row["Street"]  .
        					                    "<b> State: </b>" .$row["State"]  . 
        					                    "<b> Zip code: </b>".$row["zip_Code"];
        					                    
    					                    }
								    
								    ?>
								    
							        <?php
							       
        					                    
        					                     
        					                
							        
							        
							        
							        
							        
							        
							        
							        // GPA Calculator
                                        $gpa = 0;
    					                    $gp = 0;
								   
								    $result = $pdo->query('SELECT Grade FROM course, student_history WHERE course.course_ID = student_history.course_ID AND student_history.student_ID = '.$_SESSION["user_ID"].' AND student_history.CRN NOT IN (SELECT enrollment.CRN FROM enrollment where student_ID = '.$_SESSION["user_ID"].' ) ORDER BY `student_history`.`Grade` ASC');
    					                while($row = $result->fetch(PDO::FETCH_ASSOC))
    					                {
    					                        
    					                   $Grade = $row["Grade"];
    					                  
    					                      if ($Grade == "A+")
    					                      {
    					                          $gp = 4.0;
    					                      }
    					                      if ($Grade == "A")
    					                      {
    					                          $gp = 4.0;
    					                      }
    					                      if ($Grade == "A-")
    					                      {
    					                          $gp = 3.7;
    					                      }
    					                      if ($Grade == "B+")
    					                      {
    					                          $gp = 3.3;
    					                      }
    					                      if ($Grade == "B")
    					                      {
    					                          $gp = 3.0;
    					                      }
    					                      if ($Grade == "B-")
    					                      {
    					                          $gp = 2.7;
    					                      }
    					                      if ($Grade == "C+")
    					                      {
    					                          $gp = 2.3;
    					                      }
    					                      if ($Grade == "C")
    					                      {
    					                          $gp = 2.0;
    					                      }
    					                      if ($Grade == "C-")
    					                      {
    					                          $gp = 1.7;
    					                      }
    					                     
    					                      $gpa = $gpa + $gp;
    					                       
    					                  
    					                   // echo "<b>Course: </b>".$row["course_ID"].": ".$row["course_Name"]." | "."Semester: ".$row["semester_ID"]." | "."Grade: ".$row["Grade"]." | ";
    					                   //  echo '<i style="color:GREEN;font-size:20px;font-family:calibri ;">(Course Taken)<br><br></i>';
    					                   $GPA = $gpa ;
    					                 
    					                } 
    					                $result = $pdo->query('SELECT count(Grade) as G FROM course, student_history WHERE course.course_ID = student_history.course_ID AND student_history.student_ID = '.$_SESSION["user_ID"].' AND student_history.CRN NOT IN (SELECT enrollment.CRN FROM enrollment where student_ID = '.$_SESSION["user_ID"].' ) ORDER BY `student_history`.`Grade` ASC');
    					                while($row = $result->fetch(PDO::FETCH_ASSOC))
    					                {
    					                    $G = $row['G'];
    					                }
    					                $GPA = ($GPA/ $G);
								         echo "<br><br><b>Current GPA: </b>".(round($GPA,1) . "<br>");
								         
								         
								         
								         //Credits Taken
								         
								         
								         $result = $pdo->query('SELECT SUM(course_Credit) as takensumcc FROM course,student_history WHERE course.course_ID = student_history.course_ID AND student_history.student_ID = '.$_SESSION["user_ID"]);
                                        
                                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                                        {   
                                            $creditsTaken = $row['takensumcc'];
                                            
                                            
                                            if ($creditsTaken == 0)
                                     {
                                         $creditsTaken = 0;
                                         
                                     }
							        echo "<b>Credits Taken: </b>".$creditsTaken."<br><br>";
                                        }
							        
							        
							        
							        
							        
							        
							        
							        
							        
							        
							        
							        
							        // Prints Courses 
							        $result = $pdo->query('SELECT *, count(*) FROM student_history WHERE student_ID = '.$_SESSION["user_ID"]);
    					                while($row = $result->fetch(PDO::FETCH_ASSOC))
    					                {
    					                    $count = $row["count(*)"];
    					                }
							        
							        if ($count > 0)
							        {
                                  
                                    
                                           $result = $pdo->query('SELECT * FROM course, student_history WHERE course.course_ID = student_history.course_ID AND student_history.student_ID = '.$_SESSION["user_ID"].' AND student_history.CRN NOT IN (SELECT enrollment.CRN FROM enrollment where student_ID = '.$_SESSION["user_ID"].') ORDER BY `student_history`.`course_ID` ASC');
                                           
                                             while($row = $result->fetch(PDO::FETCH_ASSOC))
                                             
                                        {  
                                            
                                            
                                           echo "<b>Semester: </b>".$row["semester_ID"]." | "."<b>Course: </b>".$row["course_ID"]." - ".$row["course_Name"]." | "."<b>Credits: </b>".$row["course_Credit"]." | "."<b>Grade: </b>".$row["Grade"];
                                            echo "<br><br>";
                                          
                                        } 
                                            
                                            
                                           
                                      
                                       
                                        
                                        
                                        
                                        
                                        
                                         
                                        
							            
							        }
                                        
                                    
    					                    elseif($count == 0)
    					                    {
    					                        
    					       echo '<i style="color:RED;font-size:20px;font-family:calibri ;">No courses completed yet<br><br></i>';
    					                        
    					                    }
    					                
            					   ?>
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