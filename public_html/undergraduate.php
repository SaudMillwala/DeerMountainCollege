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
								    <button onclick="window.location.href = 'UserDataUndergrad.php'" class=adminNav; style="font-size:16px;margin-top:0px;height:58px;">Student Information</button>
								</td>
							    <td>
								    <button onclick="window.location.href = 'ScheduleDataUndergrad.php'" class=adminNav; style="font-size:16px;margin-top:0px;height:58px;">My Schedule</button>
							    </td>
							    <td>
								    <button onclick="window.location.href = 'AcademicDataUndergrad.php'" class=adminNav; style="font-size:16px;margin-top:0px;height:58px;">Academic Information</button>
							    </td>
							    <td>
								    <button onclick="window.location.href = 'StudentTranscriptUndergrad.php'" class=adminNav; style="font-size:16px;margin-top:0px;height:58px;">Unofficial Transcript</button>
							    </td>
							    <td>
								    <button onclick="window.location.href = 'StudentDegreeAuditUndergrad.php'" class=adminNav; style="font-size:16px;margin-top:0px;height:58px;">Degree Audit</button>
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