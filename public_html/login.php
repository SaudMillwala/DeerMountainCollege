<?php
    session_start();
    error_reporting(0);
    $_SESSION["logout"] = false;
    if($_SESSION["undergraduate"] == true)
    {
        header("Location: undergraduate.php");
    }
    if($_SESSION["graduate"] == true)
    {
        header("Location: graduate.php");
    }
    if($_SESSION["faculty"] == true)
    {
        header("Location: faculty.php");
    }
    if($_SESSION["admin"] == true)
    {
        header("Location: admin.php");
    }
    if($_SESSION["research-staff"] == true)
    {
        header("Location: research_Staff.php");
    }
    if($_SESSION["forgot"] == true)
    {
        header("Location: forgotPassword.php");
    }
?>

<?php
    include "Database.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel='stylesheet' type='text/css' href='login.css'>
        <script src="homepage.js"></script>
        <meta charset = "utf-8">
        <title>Login</title>
    </head>    
    <body>
        <div id="blur" class="blurContainer" >
            <aside class="panelContainer" style="display:none" id="myPanel">
                <div>
                    <button onclick="panelClose()" class="panelHeader">Close X</button>
                </div>
                <div>
                    <button onclick = "window.location.href = 'course-catalog.php'" class='sidePanelButton'>Course<br>Catalog</button>
                </div>
                <div>
                    <button onclick = "window.location.href = 'degree-programs.php'" class='sidePanelButton'>Degree<br>Programs</button>
                </div>
                <div>
                    <button onclick = "window.location.href = 'master_schedule.php'" class='sidePanelButton'>Master<br>Schedule</button>
                </div>
                <div>
                    <button onclick = "window.location.href = 'academic_calendar.php'" class='sidePanelButton'>Academic<br>Calender</button>
                </div>
                <div>
                    <button onclick = "window.location.href = 'departments-courses.php'" class='sidePanelButton'>Departments<br>& Courses</button>
                </div>
                <div>
                    <button onclick = "window.location.href = 'about.html'" class='sidePanelButton'>About Us</button>
                </div>
            </aside>
            <aside class = "rightColumnContainer" id="rightColumnContainer">
                <div>
                </div>
            </aside>
            <div class="bg" id="bg">
                
                <header id="header">
                    <div class = logoContainer>
                        <button onclick="panelOpen()" class='panelButton' id='panelButton'>☰</button>
                        <img src="https://i.imgur.com/ZSJeGdX.png" id="logo" alt="logo" onclick = "window.location.href = 'index.html'">
                        <img src="https://i.imgur.com/4WU9EeP.png" alt="titleImg" class=' logoContainer titleImg' height="150px" onclick = "window.location.href = 'index.html'">
                    </div>
                    
                    <div class = loginContainer>
                        <button class = logButton onclick = "window.location.href = 'index.html'">HOMEPAGE</button>
                    </div>
                </header>
                <section>
                    <div id="formBox" class='formBox' style="padding-bottom: 300px;color: green;"><br>Portal Login
                        <br><br><br>
                        <form  action = "login.php" method = "post">
                            <input type = "text" name = "user_Email" id = "exampleInputEmail1" placeholder = "User Email">
                            <br><br>
                            <input type = "password" name = "user_Password" id = "exampleInputPassword1" placeholder = "Password">
                            <br><br><br>
                            <input type = "submit" name = "enter" value = "Enter">
                            <input type = "submit" name = "password" value = "Reset password">
                            <br><br>
                        </form>
                        <?php
                            if(isset($_POST["enter"]))
                            {
                                $_SESSION["status"] = false;
                                $result = $pdo->query('SELECT *, count(user_Email) FROM login WHERE user_Email = "'.$_POST["user_Email"].'"');
                                while($row = $result->fetch(PDO::FETCH_ASSOC))
                                {
                                    if($_POST["user_Email"] == $row["user_Email"] && $_POST["user_Password"] == $row["user_Password"] && $row["user_Type"] == "Undergraduate" && $row["Operation"] == 1)
                                    {
                                        $_SESSION["user_Email"] = $_POST["user_Email"];
                                        $_SESSION["user_ID"] = $row["user_ID"];
                                        $_SESSION["user_Type"] = $row["user_Type"];
                                        $_SESSION["status"] = true;
                                        $_SESSION['start'] = time();
                                        $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
                                        header("Location: undergraduate.php");
                                        $result = $pdo->query('DELETE FROM failed_logins WHERE user_Email = "'.$row["user_Email"].'"');
                                    }
                                    elseif($_POST["user_Email"] == $row["user_Email"] && $_POST["user_Password"] == $row["user_Password"] && $row["user_Type"] == "Graduate" && $row["Operation"] == 1)
                                    {
                                        $_SESSION["user_Email"] = $_POST["user_Email"];
                                        $_SESSION["user_ID"] = $row["user_ID"];
                                        $_SESSION["user_Type"] = $row["user_Type"];
                                        $_SESSION["status"] = true;
                                        $_SESSION['start'] = time();
                                        $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
                                        header("Location: graduate.php");
                                        $result = $pdo->query('DELETE FROM failed_logins WHERE user_Email = "'.$row["user_Email"].'"');
                                    }
                                    elseif($_POST["user_Email"] == $row["user_Email"] && $_POST["user_Password"] == $row["user_Password"] && $row["user_Type"] == "Faculty" && $row["Operation"] == 1)
                                    {
                                        $_SESSION["user_Email"] = $_POST["user_Email"];
                                        $_SESSION["user_ID"] = $row["user_ID"];
                                        $_SESSION["user_Type"] = $row["user_Type"];
                                        $_SESSION["status"] = true;
                                        $_SESSION['start'] = time();
                                        $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
                                        header("Location: faculty.php");
                                        $result = $pdo->query('DELETE FROM failed_logins WHERE user_Email = "'.$row["user_Email"].'"');
                                    }
                                    elseif($_POST["user_Email"] == $row["user_Email"] && $_POST["user_Password"] == $row["user_Password"] && $row["user_Type"] == "Admin" && $row["Operation"] == 1)
                                    {
                                        $_SESSION["user_Email"] = $_POST["user_Email"];
                                        $_SESSION["user_ID"] = $row["user_ID"];
                                        $_SESSION["user_Type"] = $row["user_Type"];
                                        $_SESSION["status"] = true;
                                        $_SESSION['start'] = time();
                                        $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
                                        header("Location: admin.php");
                                        $result = $pdo->query('DELETE FROM failed_logins WHERE user_Email = "'.$row["user_Email"].'"');
                                    }
                                    elseif($_POST["user_Email"] == $row["user_Email"] && $_POST["user_Password"] == $row["user_Password"] && $row["user_Type"] == "Research Staff" && $row["Operation"] == 1)
                                    {
                                        $_SESSION["user_Email"] = $_POST["user_Email"];
                                        $_SESSION["user_ID"] = $row["user_ID"];
                                        $_SESSION["user_Type"] = $row["user_Type"];
                                        $_SESSION["status"] = true;
                                        $_SESSION['start'] = time();
                                        $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
                                        header("Location: research_Staff.php");
                                        $result = $pdo->query('DELETE FROM failed_logins WHERE user_Email = "'.$row["user_Email"].'"');
                                    }
                                    elseif($_POST["user_Email"] == $row["user_Email"] && $row["Operation"] == 0)
                                    {
                                        echo "You reached 3 failed attempts at logging in. Please reset your password.";
                                    }
                                    elseif($row["count(user_Email)"] == 1 && $_POST["user_Password"] != $row["user_Password"])
                                    {
                                        $user_Email = $row["user_Email"];
                                        $result = $pdo->query('INSERT INTO failed_logins VALUES("'.$row["user_Email"].'", 1)');
                                        $result = $pdo->query('SELECT user_Email, count(Fails) FROM failed_logins WHERE user_Email = "'.$row["user_Email"].'"');
                                        while($row = $result->fetch(PDO::FETCH_ASSOC))
                                        {
                                            if($row["count(Fails)"] >= 3)
                                            {
                                                $result = $pdo->query('UPDATE login SET Operation = 0 WHERE user_Email = "'.$user_Email.'"');
                                                echo "You reached 3 failed attempts at logging in. Please reset your password.";
                                            }
                                            elseif($row["count(Fails)"] < 3)
                                            {
                                                echo "Incorrect password! Please try again.";
                                            }
                                        }
                                    }
                                    elseif($_POST["user_Email"] != $row["user_Email"] || $_POST["user_Password"] != $row["user_Password"])
                                    {
                                        echo "Email is not recognized, please try again!";
                                    }
                                    elseif(empty($_POST["user_Email"]) && empty($_POST["user_Password"]))
                                    {
                                        echo "Please enter your credentials";
                                    }
                                }
                            }
                        ?>
                        <?php
                            if(isset($_POST["password"]))
                            {
                                header("Location: forgotPassword.php");
                            }
                        ?>
                    </div>
                </section>
            </div>
        </div>
        <footer>
            <div></div>
        </footer>
    </body>
</html>
