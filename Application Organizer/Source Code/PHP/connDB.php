<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "applicationOrganizer";
    try {
        $conn = new mysqli($servername, $username, $password, $dbname);
    } catch (PDOException $e) {
        $error=$e->getMessage();
        echo '<p> Unable to connect to database: ' .$error;
        exit();
    }
?>