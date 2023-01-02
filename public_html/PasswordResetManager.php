

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
									<button onclick="window.location.href = 'AcademicDataManager.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Academic<br>Manager</button>
								</td>
								<td>
									<button onclick="window.location.href = 'StudentTranscript.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Student<br>Transcripts</button>
								</td>
								<td>
									<button onclick="window.location.href = 'StudentDegreeAudit.php'" class=adminNav; style="font-size:100%;margin-top:0px;height:58px;">Student<br>Degree Audit</button>
								</td>
								<td>
									<button onclick="window.location.href = 'PasswordResetManager.php'" class=adminNav; style="background-color:#006a4e;font-size:80%;margin-top:0px;height:58px;">Password Reset<br>Manager</button>
								</td>
							</tr>
						</tbody>
					</table>
					<table id="studentTranscript" style="display:block;">
					    <tr><td>
					    <div id="showStudentTranscript" style="margin-bottom:50px;display:none;">
						    <thead>
							    <tr>
								    <th>Requests for resetting password</th>
							    </tr>
						    </thead>
						    <tbody>
							    <tr>
								    <td>
								        <form action = "PasswordResetManager.php" method = "POST">
								            <select name = "requests">
								                <?php
								                    $result = $pdo->query('SELECT * FROM user, login, reset_password WHERE user.user_ID = login.user_ID AND login.user_ID = reset_password.user_ID');
								                    while($row = $result->fetch(PDO::FETCH_ASSOC))
								                    {
								                        echo '<option value = '.$row["user_ID"].'>'.$row["first_Name"].' '.$row["last_Name"].'</option>';
								                    }
								                ?>
								            </select>
								            <input type = "submit" name = "Approve" value = "Approve request">
								            <input type = "submit" name = "Reject" value = "Reject request">
								        </form>
								        <?php
								            if(isset($_POST["Approve"]))
								            {
								                $result = $pdo->query('SELECT login.user_Email, reset_password.user_Password FROM user, login, reset_password WHERE user.user_ID = login.user_ID AND login.user_ID = reset_password.user_ID AND login.user_ID = '.$_POST["requests"]);
							                    while($row = $result->fetch(PDO::FETCH_ASSOC))
							                    {
							                        $user_Email = $row["user_Email"];
							                        $user_Password = $row["user_Password"];
							                        $result = $pdo->query('UPDATE login SET user_Password = "'.$user_Password.'" WHERE user_Email = "'.$user_Email.'"');
							                        $result = $pdo->query('DELETE FROM failed_logins WHERE user_Email = "'.$user_Email.'"');
							                        $result = $pdo->query('DELETE FROM reset_password WHERE user_Email = "'.$user_Email.'"');
							                        $result = $pdo->query('UPDATE login SET Operation = 1 WHERE user_Email = "'.$user_Email.'"');
							                    }
								            }
								        ?>
								        <?php
								            if(isset($_POST["Approve"]))
								            {
								                $result = $pdo->query('SELECT login.user_Email, reset_password.user_Password FROM user, login, reset_password WHERE user.user_ID = login.user_ID AND login.user_ID = reset_password.user_ID AND login.user_ID = '.$_POST["requests"]);
							                    while($row = $result->fetch(PDO::FETCH_ASSOC))
							                    {
							                        $user_Email = $row["user_Email"];
							                        $result = $pdo->query('DELETE FROM reset_password WHERE user_Email = "'.$user_Email.'"');
							                        echo "Request rejected";
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
	</body>
	<footer><div></div></footer>
</html>