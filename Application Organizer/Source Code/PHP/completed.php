<?php
    require('session.php');
    require('connDB.php');

    // If form data has been submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $move = $_POST['move'];   
        $companyName = $_POST['appSelect'];
        $un = $_SESSION["username"];

        // Gets the corresponding row the user would like to modify
        $sql = "SELECT * FROM `completed` WHERE `completed`.`company` = '$companyName' AND `completed`.`username` = '" . $un . "'";
        $result2 = mysqli_query($conn, $sql);
        $row2 = mysqli_fetch_assoc($result2);

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
                $newsql = "SELECT * FROM `completed` WHERE `completed`.`company` = '$companyName' AND `completed`.`location` = '$location' AND `completed`.`date` = '$date' AND `completed`.`username` = '" . $un . "'";
                $newresult = mysqli_query($conn, $newsql);
                $newrow = mysqli_fetch_assoc($newresult);
                if ($_POST['move'] == 'offers') {
                    // Puts the information from that row into variables to be used in SQL queries
                    $company = $newrow["company"];
                    $jobTitle = $newrow["jobTitle"];
                    $wl = $newrow["workLocation"];
                    $comments = $newrow["comments"];
                    $username = $newrow["username"];
    
                    // Moves the application to offers
                    $toOffers = "INSERT INTO `offers` (`company`, `location`, `jobTitle`, `date`, `workLocation`, `comments`, `username`) VALUES ('$company', '$location', '$jobTitle', '$date', '$wl', '$comments', '$username')";
                    mysqli_query($conn, $toOffers);
    
                } else if ($_POST['move'] == 'rejections') {
                    // Puts the information from that row into variables to be used in SQL queries
                    $company = $newrow["company"];
                    $jobTitle = $newrow["jobTitle"];
                    $comments = $newrow["comments"];
                    $username = $newrow["username"];
    
                    // Moves the application to rejections
                    $toRejections = "INSERT INTO `Rejections` (`company`, `location`, `jobTitle`, `date`, `comments`, `username`) VALUES ('$company', '$location', '$jobTitle', '$date', '$comments', '$username')";
                    mysqli_query($conn, $toRejections);
                }
    
                // Deletes the application from completed
                $newquery = "DELETE FROM completed WHERE `completed`.`company` = '$companyName' AND `completed`.`location` = '$location' AND `completed`.`date` = '$date' AND `completed`.`username` = '" . $un . "'";
                mysqli_query($conn, $newquery);
            }
        } else { // If we don't have to prompt the user for the other application information
            $sql2 = "SELECT * FROM `completed` WHERE `completed`.`company` = '$companyName' AND `completed`.`username` = '" . $un . "'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            if ($_POST['move'] == 'offers') {
                // Puts the information from that row into variables to be used in SQL queries
                $company = $row2["company"];
                $location = $row2["location"];
                $jobTitle = $row2["jobTitle"];
                $date = $row2["date"];
                $wl = $row2["workLocation"];
                $comments = $row2["comments"];
                $username = $row2["username"];

                // Moves the application to offers
                $toOffers = "INSERT INTO `offers` (`company`, `location`, `jobTitle`, `date`, `workLocation`, `comments`, `username`) VALUES ('$company', '$location', '$jobTitle', '$date', '$wl', '$comments', '$username')";
                mysqli_query($conn, $toOffers);

            } else if ($_POST['move'] == 'rejections') {
                // Puts the information from that row into variables to be used in SQL queries
                $company = $row2["company"];
                $location = $row2["location"];
                $jobTitle = $row2["jobTitle"];
                $date = $row2["date"];
                $comments = $row2["comments"];
                $username = $row2["username"];

                // Moves the application to rejections
                $query2 = "INSERT INTO `Rejections` (`company`, `location`, `jobTitle`, `date`, `comments`, `username`) VALUES ('$company', '$location', '$jobTitle', '$date', '$comments', '$username')";
                mysqli_query($conn, $query2);

            }

            // Deletes the application from completed
            $query3 = "DELETE FROM completed WHERE `completed`.`company` = '$companyName' AND `completed`.`username` = '" . $un . "'";
            mysqli_query($conn, $query3);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--Meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../CSS/index.css">
    <link rel="stylesheet" type="text/css" href="completedStyle.php">
    <title>Completed</title>
</head>
<body>
    
    <!--This is the topnav-->
    <div class="topnav">
        <a class="active" href="../HTML/index2.html">Home</a>
        <a href="newApplication.php">Add a New Application</a>
        <a href="offers.php">Offers</a>
        <a href="rejections.php">Rejections</a>
    </div>

    <!--This is the application modifying option-->
    <form method="post" style="text-align: center">
        <h1>Here are Your Completed Applications</h1>
        <h3 style="text-align: center">Edit Your Applications Below:</h3>
        <div>
            <label for="appSelect">Enter Company Name:</label>
            <input name="appSelect" type="text" placeholder="Company"><br>
            <label for="locationSelect">Enter Location:</label>
            <input name="locationSelect" type="text" placeholder="Location"><br>
            <label for="dateSelect">Select Date:</label>
            <input type="date" id="date" name="dateSelect"><br><br>
        </div>
        <select name="move">
            <option value="delete">Delete</option>
            <option value="offers">Move to Offers</option>
            <option value="rejections">Move to Rejections</option>
        </select>
        <input type="submit" value="Submit Changes"><br><br>
    </form>

</body>

</html>

<?php
    $un = $_SESSION["username"];
    $sql = "SELECT * FROM completed WHERE username='" . $un . "'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Table headers
        echo "<table><tr><th>Company</th><th>Location</th><th>Job Title</th><th>Date</th><th>Work Style</th><th>Comments</th></tr>";
        // Puts all results of the sql query into the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["company"]. "</td><td>" . $row["location"] . "</td><td>" . $row["jobTitle"] . "</td><td>" . $row["date"] . "</td><td>" . $row["workLocation"] . "</td><td>" . $row["comments"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3 style='text-align:center'>You currently have 0 completed applications.</h3>";
    }
?>