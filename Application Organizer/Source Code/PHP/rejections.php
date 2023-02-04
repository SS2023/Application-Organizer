<?php
    require('session.php');
    require('connDB.php');

    // If form data has been submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $companyName = $_POST['appSelect'];
        $un = $_SESSION["username"];

        // Gets the corresponding row the user would like to modify
        $sql = "SELECT * FROM `rejections` WHERE `rejections`.`company` = '$companyName' AND `rejections`.`username` = '" . $un . "'";
        $result2 = mysqli_query($conn, $sql);

        // If the same company name has multiple rows in completed
        if (mysqli_num_rows($result2) > 1) {
            $location = $_POST['locationSelect'];
            $date = $_POST['dateSelect'];
            if (empty($location) || empty($date)) {
                ?>
                <script>
                    function myFunction() {
                        alert("Multiple applications with this company name exist. Please enter the other fields.");
                    }
                    myFunction();
                </script>
                <?php
            } else {
                // Deletes the application from rejections
                $newquery = "DELETE FROM rejections WHERE `rejections`.`company` = '$companyName' AND `rejections`.`location` = '$location' AND `rejections`.`date` = '$date' AND `rejections`.`username` = '" . $un . "'";
                mysqli_query($conn, $newquery);
            }
        } else {
            // Deletes the rejection specified by the user
            $query = "DELETE FROM rejections WHERE `rejections`.`company` = '$companyName' AND `rejections`.`username` = '" . $un . "'";
            mysqli_query($conn, $query);
        }
    }
?>
<html>
    <head>
        <!--Meta tags-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../CSS/index.css">
        <link rel="stylesheet" type="text/css" href="completedStyle.php">
        <title>Rejections</title>   
    </head>
    <body>
    <div class="topnav">
        <a class="active" href="../HTML/index2.html">Home</a>
    </div>
    
    <!--Delete by ID option-->
    <form method="post">
        <h1>Rejections:<h1>
        <h4 style="text-align: center">Delete a Rejection:</h4>
        <div style="text-align: center">
            <label for="appSelect">Enter Company Name:</label>
            <input name="appSelect" type="text" placeholder="Company"><br>
            <label for="locationSelect">Enter Location:</label>
            <input name="locationSelect" type="text" placeholder="Location"><br>
            <label for="dateSelect">Select Date:</label>
            <input type="date" id="date" name="dateSelect"><br><br>
            <input type="submit" value="Delete"><br><br>
        </div>
    </form>

    <?php
        $un = $_SESSION["username"];
        $sql = "SELECT * FROM rejections WHERE username='" . $un . "'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<table><tr><th>Company</th><th>Location</th><th>Job Title</th><th>Date</th><th>Comments</th></tr>";
            while ($row = mysqli_fetch_assoc($result))
            {
                echo "<tr><td>" . $row["company"]. "</td><td>" . $row["location"] . "</td><td>" . $row["jobTitle"] . "</td><td>" . $row["date"] . "</td><td>" . $row["comments"] . "</td></tr>";
            }
        } else {
            echo "<h3 style='text-align:center'>You currently have 0 rejections.</h3>";
        }
    ?>
    
    </body>
</html>