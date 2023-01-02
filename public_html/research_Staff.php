<?php
    session_start();
    if($_SESSION["status"] != true)
    {
        header("Location: ./login.php");
    }
    if($_SESSION["status"] == true)
    {
        $_SESSION["research-staff"] = true;
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
		<title>Research Staff Portal</title>
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
					    <h1 style="font-size:30px;">Research Staff Portal</h1>
					    <?php 
					    if ($_SESSION["user_Type"] != "Research Staff"){
					        if ($_SESSION["user_Type"] == "Admin"){
					            header("Location: admin.php");
					        }
					        if ($_SESSION["user_Type"] == "Faculty"){
					            header("Location: faculty.php");
					        }
					        if ($_SESSION["user_Type"] == "Graduate"){
					            header("Location: graduate.php");
					        }
					        if ($_SESSION["user_Type"] == "Undergraduate"){
					            header("Location: undergraduate.php");
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
                    
                    <?php
                    echo '<table id="researchStaff" style="display:block;height:auto;">';
                    echo '<tr><td><div id="missingFunction"><thead><tr><th style="font-size:20px">&nbspNumber of Users&nbsp</th></tr></thead><tbody><tr><td style="font-size:20px">';
                    $result = $pdo->query('SELECT count(user_ID) FROM user');
    				while($row = $result->fetch(PDO::FETCH_ASSOC))
    			    {
    			        echo "&nbsp&nbspAmount: ";
    			        echo $row["count(user_ID)"];
    			    }
					echo '&nbsp</td></tr></tbody></div></td></tr></table>';
                    ?>
                    <?php
                    echo '<table id="researchStaff" style="display:block;height:auto;">';
                    echo '<tr><td><div id="missingFunction"><thead><tr><th style="font-size:20px">&nbspNumber of Undergraduates&nbsp</th></tr></thead><tbody><tr><td style="font-size:20px">';
                    $result = $pdo->query('SELECT count(user_ID) FROM login WHERE user_Type = "Undergraduate"');
    				while($row = $result->fetch(PDO::FETCH_ASSOC))
    			    {
    			        echo "&nbsp&nbspAmount of Undergraduates: ";
    			        echo $row["count(user_ID)"];
    			    }
					echo '&nbsp</td></tr></tbody></div></td></tr></table>';
                    ?>
                    <?php
                    echo '<table id="researchStaff" style="display:block;height:auto;">';
                    echo '<tr><td><div id="missingFunction"><thead><tr><th style="font-size:20px">&nbspNumber of Graduates&nbsp</th></tr></thead><tbody><tr><td style="font-size:20px">';
                    $result = $pdo->query('SELECT count(user_ID) FROM login WHERE user_Type = "Graduate"');
    				while($row = $result->fetch(PDO::FETCH_ASSOC))
    			    {
    			        echo "&nbsp&nbspAmount of Graduates: ";
    			        echo $row["count(user_ID)"];
    			    }
					echo '&nbsp</td></tr></tbody></div></td></tr></table>';
                    ?>
                    <?php
                    echo '<table id="researchStaff" style="display:block;height:auto;">';
                    echo '<tr><td><div id="missingFunction"><thead><tr><th style="font-size:20px">&nbspNumber of Faculty&nbsp</th></tr></thead><tbody><tr><td style="font-size:20px">';
                    $result = $pdo->query('SELECT count(user_ID) FROM login WHERE user_Type = "Faculty"');
    				while($row = $result->fetch(PDO::FETCH_ASSOC))
    			    {
    			        echo "&nbsp&nbspAmount of Faculty: ";
    			        echo $row["count(user_ID)"];
    			    }
					echo '&nbsp</td></tr></tbody></div></td></tr></table>';
                    ?>
                    <?php
                    echo '<table id="researchStaff" style="display:block;height:auto;">';
                    echo '<tr><td><div id="missingFunction"><thead><tr><th style="font-size:20px">&nbspNumber of Research Staff&nbsp</th></tr></thead><tbody><tr><td style="font-size:20px">';
                    $result = $pdo->query('SELECT count(user_ID) FROM login WHERE user_Type = "Research Staff"');
    				while($row = $result->fetch(PDO::FETCH_ASSOC))
    			    {
    			        echo "&nbsp&nbspAmount of Research Staff: ";
    			        echo $row["count(user_ID)"];
    			    }
					echo '&nbsp</td></tr></tbody></div></td></tr></table>';
                    ?>
                    <?php
                    echo '<table id="researchStaff" style="display:block;height:auto;">';
                    echo '<tr><td><div id="missingFunction"><thead><tr><th style="font-size:20px">&nbspNumber of Administrators&nbsp</th></tr></thead><tbody><tr><td style="font-size:20px">';
                    $result = $pdo->query('SELECT count(user_ID) FROM login WHERE user_Type = "Admin"');
    				while($row = $result->fetch(PDO::FETCH_ASSOC))
    			    {
    			        echo "&nbsp&nbspAmount of Administrators: ";
    			        echo $row["count(user_ID)"];
    			    }
					echo '&nbsp</td></tr></tbody></div></td></tr></table><br>';
                    ?>
                    
                    <?php
                    echo '<table id="researchStaff" style="display:block;height:auto;">';
                    echo '<tr><td><div id="missingFunction"><thead><tr><th style="font-size:20px">&nbspNumber of Students in Major&nbsp</th></tr></thead><tbody><tr><td style="font-size:20px">';
                    ?>
                    
                    
                    <form method = "POST">
                        <br>

                        <select name = "department" style="background-color: grey;color:white;margin-left:4%;width: 55%;height: 33px;font-size: 25px;">
                            <option selected disabled>Select Major</option>
                            <?php
                                $result = $pdo->query('SELECT * FROM `major`');
                                while($row = $result->fetch(PDO::FETCH_ASSOC))
                                {
                                    echo "<option value =".$row["major_ID"].">".$row["major_Name"]."</option>";
                                }
                            ?>
                        </select>
                        <input type = "submit" name = "schedule_search"  style="float:right;margin-right:6%;background-color: grey;color:white;width: 25%;height: 33px;font-size: 25px;border-color: white;">
                    </form>
                    <?php
                    if(isset($_POST["schedule_search"]))
                    {
                        $result = $pdo->query('SELECT count(student_ID) FROM student_major WHERE student_major.major_ID = "'.$_POST["department"].'"');
                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                        {   
                            echo "<br>&nbsp&nbspAmount of Student in ";
                            echo $_POST["department"];
                            echo ": ";
                            echo $row["count(student_ID)"];
                        }
                    }
					echo '&nbsp<br></td></tr></tbody></div></td></tr></table>';
                    ?>
                    
                    
            
                    
                    
                    <?php
                    echo '<table id="researchStaff" style="display:block;height:auto;">';
                    echo '<tr><td><div id="missingFunction"><thead><tr><th style="font-size:20px">&nbspNumber of Students in Minor&nbsp</th></tr></thead><tbody><tr><td style="font-size:20px">';
                    ?>
                    
                    
                    <form method = "POST">
                        <br>

                        <select name = "department" style="background-color: grey;color:white;margin-left:4%;width: 55%;height: 33px;font-size: 25px;">
                            <option selected disabled>Select Minor</option>
                            <?php
                                $result = $pdo->query('SELECT * FROM `minor`');
                                while($row = $result->fetch(PDO::FETCH_ASSOC))
                                {
                                    echo "<option value =".$row["minor_ID"].">".$row["minor_Name"]."</option>";
                                }
                            ?>
                        </select>
                        <input type = "submit" name = "schedule_search3"  style="float:right;margin-right:6%;background-color: grey;color:white;width: 25%;height: 33px;font-size: 25px;border-color: white;">
                    </form>
                    <?php
                    if(isset($_POST["schedule_search3"]))
                    {
                        $result = $pdo->query('SELECT count(student_ID) FROM student_minor WHERE student_minor.minor_ID = "'.$_POST["department"].'"');
                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                        {   
                            echo "<br>&nbsp&nbspAmount of Student in ";
                            echo $_POST["department"];
                            echo ": ";
                            echo $row["count(student_ID)"];
                        }
                    }
					echo '&nbsp<br></td></tr></tbody></div></td></tr></table>';
                    ?>
                    <table style="height:auto;width:400px;">
                        <tr><td>
                            <div>
                                <thead>
                                    <tr>
                                        <th style="font-size:20px">&nbspNumber of Faculty in Department&nbsp
                                        </th>
                                    </tr>
                                </thead>
                            <tbody>
                                <tr>
                                    <td style="font-size:20px">
                    
                                        <form method = "POST"><br>&nbsp&nbsp

                                            <select name = "department" style="background-color: grey;color:white;font-size: 25px;">
                                                <option selected disabled>Select Department</option>
                                                <?php
                                                    $result = $pdo->query('SELECT * FROM `department`');
                                                    while($row = $result->fetch(PDO::FETCH_ASSOC))
                                                    {
                                                        echo "<option value =".$row["dept_ID"].">".$row["dept_ID"]."</option>";
                                                    }
                                                ?>
                                            </select>
                                            <input type = "submit" name = "schedule_search2"  style="float:right;margin-right:6%;background-color: grey;color:white;width: 25%;height: 33px;font-size: 25px;border-color: white;">
                                        </form>
                                        <?php
                                            if(isset($_POST["schedule_search2"]))
                                            {
                                                $result = $pdo->query('SELECT count(faculty_ID) FROM faculty_department  WHERE faculty_department.dept_ID = "'.$_POST["department"].'"');
                                                while($row = $result->fetch(PDO::FETCH_ASSOC))
                                                {   
                                                    echo "<br>&nbsp&nbspAmount of Faculty in ";
                                                    echo $_POST["department"];
                                                    echo ": ";
                                                    echo $row["count(faculty_ID)"];
                                                }
                                            }
                        				
                                        ?>
                                        
                                    &nbsp</td>
                                </tr>
                            </tbody>
                        </div>
                    </td>
                </tr>
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

<?php
    if(isset($_POST["logout"]))
    {
        $_SESSION["logout"] = true;
        header("Location: logout.php");
    }
?>