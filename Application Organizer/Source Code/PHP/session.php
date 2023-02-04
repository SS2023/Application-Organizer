<?php
    include('connDB.php');
    session_start();
    // Checks if the user is logged in, sends them to login page if not
    if(!isset($_SESSION['username'])) {
        header("Location: LogIn.php");
    }
?>