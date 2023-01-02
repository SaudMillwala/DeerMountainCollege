

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
// ?>

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
			<div class="bg" style="padding-bottom:660px;">
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
									<button onclick="window.location.href = 'AcademicDataManagerFaculty.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Academic<br>Manager</button>
								</td>
								<td>
									<button onclick="window.location.href = 'StudentTranscriptFaculty.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Student<br>Transcripts</button>
								</td>
								<td>
									<button onclick="window.location.href = 'StudentDegreeAuditFaculty.php'" class=adminNav; style="background-color:#006a4e;font-size:80%;margin-top:0px;height:58px;">Student<br>Degree Audit</button>
								</td>
							</tr>
						</tbody>
					</table>
					<table>
                        <thead>
                            <tr>
                                <th>
                                    <form action = "StudentDegreeAuditFaculty.php" method = "POST">
                                        <input type = "number" name = "student_degree_search" placeholder = "Enter student ID">
                                        <input type = "submit" name = "degree_check" value = "Request Degree Audit">
                                    </form></th>
                            </tr>   
                        </thead>
                        </table>
                        
                         <style>
                    
                              .circle {
                                height: 80px;
                                width: 80px;
                                background-color: #bbb;
                                border-radius: 50%;
                                display: inline-block;
                                top:4px;
                                background: radial-gradient(
                                ellipse at center,
                                rgba(0, 128, 20, 1) 0%,
                                rgba(0, 128, 20, 1) 70%,
                                rgba(0, 128, 20, 0) 70.3%
                              );
                                position: relative;
                                
                              }
                              .circle2 {
                                height: 88px;
                                width: 88px;
                                background-color: #ffffff;
                                border-radius: 50%;
                                display: inline-block;
                                margin-left:42%;
                                background: radial-gradient(
                                ellipse at center
                              );
                               
                              }
                              
                              
                              /*h3 {*/
                              /*      text-align:center;*/
                              /*      position: relative;*/
                              /*  }*/

                    div1 {text-align:center;vertical-align:middle;
                        
                        
                    }
                    div2 {text-align:center;vertical-align:middle;
                   
                    }
                            </style>
                          </head>
                          <body>
                            <div1>
                                
                        <!--<h3 text-align: center;>Percentage Completion</h3>-->
                                         
                  <span class="circle2">                            
                <span class="circle"> 
                 
                
                
                <?php
                  
  echo '<i><p style="font-family:calibri;color:white;float:center;font-size:30px;position:relative; top:10px;">' .ceil($_SESSION["$percentComplete"])." %"."<br>" .'</i> </p>';
  echo '<i><p style="font-family:calibri;color:white;float:center;font-size:15px;position:relative; top:5px;">' ."Completed" ."<br>".'</i> </p>';
                
                ?>  
                
                
            
                </span>
                
                 
                              
                            </div1>
                          
                           
							    </div2>
                          </body>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                    <table>
                        <thead>
                            <tr>
                               <th>Worksheets</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><b>Current Major:</b>
								    <?php
								   
								 if (isset($_POST["degree_check"])) {
								   
								   
								   
								   //Credits Total
                                        $result = $pdo->query('SELECT * FROM major, student_major WHERE major.major_ID = student_major.major_ID AND student_major.student_ID = '.$_POST["student_degree_search"]);
                                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                                        {
                                            echo $row["major_Name"]."<br>";
                                            $creditsTotal = 96;
                                          
                                            
                                            
                                        }
                                        //Major Credits Checker
                                        
                                         $result = $pdo->query('SELECT SUM(course.course_Credit) as requiredsumcc FROM course, student_major,major where course.dept_ID = major.dept_ID AND major.major_ID = student_major.major_ID AND student_major.student_ID = '.$_POST["student_degree_search"]);
                                          while($row = $result->fetch(PDO::FETCH_ASSOC))
                                        { 
                                            $majorTotalCredits = $row['requiredsumcc'];
                                            
                                            if ($creditsTotal > $majorTotalCredits){
                                            $creditsTotal = $majorTotalCredits;
                                            }
                                            else if ($creditsTotal < $majorTotalCredits)
                                            {
                                             $result = $pdo->query('SELECT count(student_major.major_ID) as doublemajor FROM major, student_major WHERE major.major_ID = student_major.major_ID AND student_major.student_ID = '.$_POST["student_degree_search"]);
                                            while($row = $result->fetch(PDO::FETCH_ASSOC))
                                        { 
                                           if ('doublemajor' > 1)
                                            {
                                            
                                            $creditsTotal = $majorTotalCredits;
                                        }}
                                        
                                            }
                                        
                                            }
                                            
                                        //Credits Taken and Credits Left to take
                                        
                                        $result = $pdo->query('SELECT SUM(course_Credit) as takensumcc FROM course,student_history WHERE course.course_ID = student_history.course_ID AND student_history.student_ID = '.$_POST["student_degree_search"]);
                                        
                                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                                        {   
                                            $creditsTaken = $row['takensumcc'];
                                            $creditsLeft = ($creditsTotal - $creditsTaken);
                                            
                                            if ($creditsTaken == 0)
                                     {
                                         $creditsTaken = 0;
                                         
                                     }
                                     
                                     $courseCompletionPercentage =0;
                                     $_SESSION["$percentComplete"] = $courseCompletionPercentage;
                                     if ($creditsTaken != 0){
                                     $courseCompletionPercentage = (($creditsTaken * 100)/$creditsTotal);
                                     }
                                     echo "<b>Total Credits Needed: </b>".$creditsTotal."<br>";
                                     echo "<b>Credits Taken: </b>".$creditsTaken."<br>";
                                     echo "<b>Credits Left: </b>".$creditsLeft."<br>";
                                    //  echo "<b>Percentage Completion: </b>".$courseCompletionPercentage." %<br>";
                                     
                                   $_SESSION["$percentComplete"] = $courseCompletionPercentage;
                                     
                                        }
                                        
                                        
                                        // GPA Calculator
                                        $gpa = 0.0;
    					                    $gp = 0.0;
								   
								    $result = $pdo->query('SELECT Grade FROM course, student_history WHERE course.course_ID = student_history.course_ID AND student_history.student_ID = '.$_POST["student_degree_search"].' AND student_history.CRN NOT IN (SELECT enrollment.CRN FROM enrollment where student_ID = '.$_POST["student_degree_search"].' ) ORDER BY `student_history`.`Grade` ASC');
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
    					                $result = $pdo->query('SELECT count(Grade) as G FROM course, student_history WHERE course.course_ID = student_history.course_ID AND student_history.student_ID = '.$_POST["student_degree_search"].' AND student_history.CRN NOT IN (SELECT enrollment.CRN FROM enrollment where student_ID = '.$_POST["student_degree_search"].' ) ORDER BY `student_history`.`Grade` ASC');
    					                while($row = $result->fetch(PDO::FETCH_ASSOC))
    					                {
    					                    $G = $row['G'];
    					                }
    					                $GPA = ($GPA/ $G);
								         echo "<b>Current GPA: </b>".(round($GPA,1) . "<br>");
                                        
                                        
                                        
                                        
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
                                    
                                    
                                    if (isset($_POST["degree_check"])) {
                                    
                                        $result = $pdo->query('SELECT * FROM semester, course, class, enrollment WHERE semester.semester_ID = enrollment.semester_ID AND course.course_ID = class.course_ID AND class.CRN = enrollment.CRN AND enrollment.student_ID = '.$_POST["student_degree_search"].' ORDER BY course.course_ID ASC');
                                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                                        { 
                                            if ($row["course_ID"] ==null)
                                            {
                                                echo "No Courses Currently Registered";
                                                
                                            }
                                            $courseEnrolled = $row["course_ID"];
                                            $courseName = $row["course_Name"];
                                            $credits = $row["course_Credit"];
                                            $semesterName = $row["semester_Name"];
                                            
                                            echo "<b>Course: </b>".$row["course_ID"]." - ".$row["course_Name"]." | "."Credits: ".$row["course_Credit"]." | ".$row["semester_Name"]. " | ";
                                            echo '<i style="color:Blue;font-size:20px;font-family:calibri ;">(Currently Enrolled)<br><br></i>';
                                        }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
         <!--           <table>-->
					    <!--<thead>-->
         <!--                   <tr>-->
         <!--                       <th>Courses Taken</th>-->
         <!--                   </tr>-->
         <!--               </thead> -->
         <!--               <tbody>-->
         <!--                   <tr>-->
         <!--                       <td>-->
							  <!--     < ? php-->
          <!--                           $result = $pdo->query('SELECT * FROM course, student_history WHERE course.course_ID = student_history.course_ID AND student_history.student_ID = '.$_POST["student_degree_search"].' ORDER BY student_history.semester_ID DESC');-->
    				 	<!--                while($row = $result->fetch(PDO::FETCH_ASSOC))-->
    				 	<!--                {-->
    					                    
    				 	<!--                    echo "<b>Course: </b>".$row["course_ID"].": ".$row["course_Name"]." | "."Semester: ".$row["semester_ID"]." | "."Grade: ".$row["Grade"]."  <br><br>";-->
    			   <!--echo '<i style="color:GREEN;font-size:20px;font-family:calibri ;">(Course Taken)<br><br></i>'-->
    					                
    					                    
    				 	<!--                    }-->
    					                <!--// ?>
         <!--                       </td>-->
         <!--                   </tr>-->
         <!--               </tbody>-->
         <!--           </table>-->
					
					
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
                                    
    					                echo '<i style="color:Black;font-size:20px;font-family:calibri ;"><b><u>Major Courses Needed</u></b><br><br></i>';
    					                
    					                $result = $pdo->query('SELECT * FROM course, student_history WHERE course.course_ID = student_history.course_ID AND student_history.student_ID = '.$_POST["student_degree_search"].' AND student_history.CRN NOT IN (SELECT enrollment.CRN FROM enrollment where student_ID = '.$_POST["student_degree_search"].' ) ORDER BY `student_history`.`course_ID` ASC');
    					                while($row = $result->fetch(PDO::FETCH_ASSOC))
    					                {
    					                    echo "<b>Course: </b>".$row["course_ID"].": ".$row["course_Name"]." | "."Semester: ".$row["semester_ID"]." | "."Grade: ".$row["Grade"]." | ";
    					                     echo '<i style="color:GREEN;font-size:20px;font-family:calibri ;">(Course Taken)<br><br></i>';
    					                }
                                    
                                        $result = $pdo->query('SELECT * FROM course, student_major, major_requirements WHERE major_requirements.course_ID = course.course_ID AND student_major.major_ID = major_requirements.major_ID AND student_major.student_ID = "'.$_POST["student_degree_search"].'" AND major_requirements.course_ID NOT IN (SELECT course_ID FROM student_history WHERE student_ID = '.$_POST["student_degree_search"].')');
                                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                                        { 
                                           
                                            echo "<b>Course: </b>".$row["course_ID"]." - ".$row["course_Name"]." | "."Credits: ".$row["course_Credit"]." | ";
                                            echo '<i style="color:RED;font-size:20px;font-family:calibri ;">(Course Needed)<br><br></i>';
                                             
                                        } 
                                        
                                        $result = $pdo->query('SELECT * FROM course, student_minor, minor_requirements WHERE minor_requirements.course_ID = course.course_ID AND student_minor.minor_ID = minor_requirements.minor_ID AND student_minor.student_ID = "'.$_POST["student_degree_search"].'" AND minor_requirements.course_ID NOT IN (SELECT course_ID FROM student_history WHERE student_ID = "'.$_POST["student_degree_search"].'")');
                                        
                                       
                                        
                                        
                                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                                        {  if ($row["course_ID"] != null)
                                        {
                                            
                                             echo '<i style="color:Black;font-size:20px;font-family:calibri ;"><b><u>Minor Courses Needed</u></b><br><br></i>';
                                        }
                                       
                                            
                                            echo "Course: ".$row["course_ID"]." - ".$row["course_Name"]." | "."Credits: ".$row["course_Credit"]." | ";
                                            echo '<i style="color:RED;font-size:20px;font-family:calibri ;">(Course Needed)<br><br></i>';
                                        } 
                                        
                                        
                                        
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
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