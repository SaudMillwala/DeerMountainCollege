


<?php
include "Database.php";

ini_set("display_errors", "1");

ini_set("display_startup_errors", "1");

error_reporting(E_ALL);
$working = true;
?>

<!doctype html>

<html lang="en">
	<head>
		<link rel='stylesheet' type='text/css' href='admin.css'>
		<script src="homepage.js"></script>
// 		<script>
// setTimeout("location.reload(true);", 1000);
// </script>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
		<title>student history maker</title>
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
					    <h1 style="font-size:30px;">student history Portal</h1>
						<h2 class="mt-2">make student history</h2>
						<form action="test.php" method="POST">
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
									<button onclick="window.location.href = 'test.php'" class=adminNav; style="background-color:#006a4e;font-size:80%;margin-top:0px;height:58px;">Student Degree<br>Audit</button>
								</td>
							
							</tr>
						</tbody>
					</table>
                    <table id="student_History" style="display:block;">
					    <tr><td>
					    <div id="studentdegreeaudit" style="margin-bottom:50px;display:none;">
						    <thead>
							    <tr>
								    <th>Student Degree Audit Maker</th>
							    </tr>
						    </thead>
						    <tbody>
							    <tr>
								    <td>
								        <form  method = "POST">
								           
								            <input type="submit" name="student_history_maker" value="Make Student History" >
								            <input action = "test.php" type="reset">
								        </form>
								        <?php
								        
					 if(isset($_POST["student_history_maker"]))
 { 
                                                
                                                
                                                for ($looper = 0;$looper < 2 ;$looper++)
                                                 while($working == true)
        {               
            
                                                    //echo 'looping from the top <br>';
                                                $duplicate = 0;
								                
						                $result = $pdo->query('SELECT * FROM (SELECT DISTINCT student_major.student_ID,course.course_ID FROM full_time_undergraduate, course, major_requirements, student_major, major WHERE full_time_undergraduate.student_ID = student_major.student_ID AND student_major.major_ID = major.major_ID AND major.dept_ID = course.dept_ID AND major.dept_ID = "AN") TL1 ORDER BY rand()');
						                
						                
            					        while($row = $result->fetch(PDO::FETCH_ASSOC))
            	                  {
            					            $student_ID = $row["student_ID"];
            					            $course_ID = $row["course_ID"];
            					             
            					             
            					            
            					        $result = $pdo->query('SELECT count(*) as scount FROM student_history where student_ID = "'.$student_ID.'"');
            					             while($row = $result->fetch(PDO::FETCH_ASSOC))
            					            $historyCount = $row["scount"];
            					            while ($historyCount > 0)
            			              {
            					             
            					             $result = $pdo->query('SELECT CRN,course_ID,semester_ID FROM class where course_ID like "%AN%"');
            					            while($row = $result->fetch(PDO::FETCH_ASSOC))
            			//error case 
            					           
            					            {
            					            $class_CRN = $row['CRN'];
            					             $semester_ID = $row["semester_ID"];
            					             $class_course_ID = $row["course_ID"];
            					             
            					             $result = $pdo->query('SELECT * FROM student_history WHERE student_ID = "'.$student_ID.'" ORDER BY `student_history`.`course_ID` ASC');
            					             while($row = $result->fetch(PDO::FETCH_ASSOC))
            	                        	{  $historyCount--;
        
            		
            					       
            					             
            					            if ($course_ID == $class_course_ID)
            					            {  
            					            
            					             
            	                        	
            					                     
            	                        	    
            	                        	    if ($course_ID == $row["course_ID"] && $student_ID == $row["student_ID"] && $class_CRN == $row["CRN"] && $semester_ID == $row["semester_ID"])
            					                 {
            					                   // echo $row["student_ID"]." ".$row["CRN"]." ".$row["course_ID"]." ".$row["semester_ID"]."<br>";
            					                    echo ''.$student_ID.' '.$class_CRN.' '.$course_ID.' '.$semester_ID.' C <br>';
            					                    echo "this is already in the database<br><br>";
            					                    $duplicate++;
            					                    
            					                    
            					                    if ($duplicate > 0)
            					                    {$historyCount= 0;
            					                    }
            					                 }
            					                 else if   ($duplicate == 0)     {   
            					   echo $row["student_ID"]." ".$row["CRN"]." ".$row["course_ID"]." ".$row["semester_ID"]."<br>";
            					    echo " inputted into database<br><br>";
            					     $result = $pdo->query('INSERT INTO student_history VALUES("'.$student_ID.'", "'.$class_CRN.'", "'.$course_ID.'", "'.$semester_ID.'","C")');   
            					     $historyCount= 0;
            					     $working = $result;
            					    $working == true;
            					     return true;
            					                    
            					     
            		        	          
            		        	           
            		        	             }
            		        	             
            			        	
            			        
            					            }
            					                   
            					                 }
            	                        	    
            	                	    
            	                        	}
            			              
            					            
            					        }
            					                
            					 
            					 
            	                  }
            	                  
            					        
            					        }
            					       
            					         
                                        }
                                        
                                        
                //         //student history checker
                //                         $result = $pdo->query('SELECT count(*) FROM student_history');
            				// 	             while($row = $result->fetch(PDO::FETCH_ASSOC))
            					             
            				// 	   {
            					            
            				// 	            $historyCount = $row["count(*)"];
            					            
            				// 	            while ($historyCount > 0)
            			 //             {
            				// 	             $result = $pdo->query('SELECT * FROM student_history ORDER BY `student_history`.`course_ID` ASC');
            				// 	             while($row = $result->fetch(PDO::FETCH_ASSOC))
            					                 
            	   //                     	{  
            	   //                     	    $historyCount--;
            	   //                     	    if ($class_course_ID == $row["course_ID"] && $student_ID == $row["student_ID"] && $class_CRN == $row["CRN"])
            				// 	                 {
            				// 	                   // echo $row["student_ID"]." ".$row["CRN"]." ".$row["course_ID"]." ".$row["semester_ID"]."<br>";
            				// 	                //    echo ''.$student_ID.' '.$class_CRN.' '.$class_course_ID.' '.$semester_ID.' "C" <br>';
            				// 	                    echo "this is already in the database<br><br>";
            				// 	                    $duplicate++;
            				// 	                 }
            	                        	    
            	                	    
            	   //                     	}
            			 //             }
            					            
            					            
            				// 	 }
            					 //insert statement
                                        
                                      
            			        	
            			        	
 
 
 
            					         
            					        
            				// 	        $result = $pdo->query('SELECT count(*) FROM student_history');
            				// 	             while($row = $result->fetch(PDO::FETCH_ASSOC))
            					             
            				// 	   {
            					            
            				// 	            $historyCount = $row["count(*)"];
            					            
            				// 	            while ($historyCount > 0)
            			 //             {
            				// 	             $result = $pdo->query('SELECT * FROM student_history ORDER BY `student_history`.`course_ID` ASC');
            				// 	             while($row = $result->fetch(PDO::FETCH_ASSOC))
            					                 
            	   //                     	{  
            	   //                     	    $historyCount--;
            	   //                     	    if ($class_course_ID == $row["course_ID"] && $student_ID == $row["student_ID"] && $class_CRN == $row["CRN"])
            				// 	                 {
            				// 	                    echo $row["student_ID"]." ".$row["CRN"]." ".$row["course_ID"]." ".$row["semester_ID"]."<br>";
            				// 	                    echo ''.$student_ID.' '.$class_CRN.' '.$class_course_ID.' '.$semester_ID.' "C" <br>';
            				// 	                    echo "this is already in the database<br><br>";
            				// 	                    $duplicate++;
            				// 	                 }
            	                        	    
            	                	    
            	   //                     	}
            			 //             }
            					            
            					            
            				// 	 }
            					        
            					     
            		        	     //if($duplicate > 0)
            		        	     //{
            		        	     //echo "There was a duplicate<br>";
            		        	     //    break;
            		        	     //}
            
            		        	            
            		        	            
            		        	            
            		        	 //           if ($duplicate == 0 && $course_ID == $class_course_ID)
            					       //     {           echo ''.$student_ID.' '.$class_CRN.' '.$class_course_ID.' '.$semester_ID.' C';
            					       //             echo"<br><br>inputted into database<br><br>";
            					       //             $result = $pdo->query('INSERT INTO student_history VALUES("'.$student_ID.'", "'.$class_CRN.'", "'.$course_ID.'", "'.$semester_ID.'","C")');
            					       //        $result = $pdo->query('SELECT count(*) FROM student_history');
            					       //      while($row = $result->fetch(PDO::FETCH_ASSOC))
            					             
            					       // {
            					            
            					       //     $historyCount = $row["count(*)"];
            					       // }
            					           
            					        
            					       //        while ($historyCount < 0)
            			         //{
            					       //      $result = $pdo->query('SELECT * FROM student_history ORDER BY `student_history`.`course_ID` ASC');
            					       //      while($row = $result->fetch(PDO::FETCH_ASSOC))
            					                 
            	           //     	{  
            	           //     	    echo $historyCount;
            	           //     	    $historyCount--;
            					       //    if ($class_course_ID == $row["course_ID"] && $student_ID == $row["student_ID"] && $class_CRN == $row["CRN"])
            					       //  {
            					       //     echo $row["student_ID"]." ".$row["CRN"]." ".$row["course_ID"]." ".$row["semester_ID"]."<br>";
            					       //     echo ''.$student_ID.' '.$class_CRN.' '.$class_course_ID.' '.$semester_ID.' "C" <br>';
            					       //         echo "this is already in the database<br><br>";
            					       //        $duplicate++;
            					               
            					           
            					       //  }
            					         
            					           
            					           
            			         //   }
            			            
            			 
            					            
            			        // }	
            			             //       	if ($duplicate == 0 && $course_ID == $class_course_ID)
            					           // {           echo ''.$student_ID.' '.$class_CRN.' '.$class_course_ID.' '.$semester_ID.' "C"';
            					           //         echo"<br><br>inputted into database<br><br>";
            					           //    $result = $pdo->query('INSERT INTO student_history VALUES("'.$student_ID.'", "'.$class_CRN.'", "'.$course_ID.'", "'.$semester_ID.'","C")'
            					           //    );
            					               
            					               
            				                 
            				                
            					            
    
            					            
     
     
     
     
     					            
            					  
            					            
            					       
            					        
            					          
            					           
            					            
            					               
            					            
            					            
            					               
            					               
            					                
            					            
            					  
            					  
            					        
            					          
            					          
                                            
	                                      
            					            
								       
            					        
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
</html>