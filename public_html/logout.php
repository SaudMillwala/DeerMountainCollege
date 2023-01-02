<?php
    session_start();
    if($_SESSION["logout"] != true)
    {
        header("Location: index.html");
    }
    elseif($_SESSION["logout"] == true)
    {
        session_unset();
        session_destroy();
        header("Location: logout.php");
        header("Location: index.html");
    }
?>