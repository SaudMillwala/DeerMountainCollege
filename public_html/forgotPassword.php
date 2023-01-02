<html>
<?php
    include 'Database.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel='stylesheet' type='text/css' href='login.css'>
        <script src="homepage.js"></script>
        <meta charset = "utf-8">
        <title>Forgot Password</title>
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
                    <div id="formBox" class='formBox' style="padding-bottom: 300px;color: green;"><br>Forgot Password
                        <br><br><br>
                        <form  action = "forgotPassword.php" method = "post">
                            <input type = "text" name = "user_Email" id = "exampleInputEmail1" placeholder = "User Email">
                            <br><br><br>
                            <input type = "password" name = "pass" placeholder = "Enter your new password" minlength = "8"><br><br>
                            <input type = "password" name = "confirm_pass" placeholder = "Confirm your new password" minlength = "8"><br>
                            <br><input type = "submit" style = "width:150px;" name = "enter" value = "Send request">
                        </form>
                        <?php
                            if(isset($_POST["enter"]))
                            {
                                $result = $pdo->query('SELECT *, count(user_Email) FROM login WHERE user_Email = "'.$_POST["user_Email"].'"');
                                while($row = $result->fetch(PDO::FETCH_ASSOC))
                                {
                                    if($row["count(user_Email)"] == 1)
                                    {
                                        if($_POST["pass"] == $_POST["confirm_pass"])
                                        {
                                            $result = $pdo->query('INSERT INTO reset_password VALUES('.$row["user_ID"].', "'.$_POST["user_Email"].'", "'.$_POST["confirm_pass"].'")');
                                        }
                                        elseif($_POST["pass"] != $_POST["confirm_pass"])
                                        {
                                            echo "Passwords do not match!";
                                        }
                                    }
                                    elseif($row["count(user_Email)"] == 0)
                                    {
                                        echo "Email is not recognized.";
                                    }
                                }
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
