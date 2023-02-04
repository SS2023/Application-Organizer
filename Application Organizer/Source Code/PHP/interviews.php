<?php
    require('session.php');
    require('connDB.php');

    // If form data has been submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $companyName = $_POST['appSelect'];
        $un = $_SESSION["username"];

        // Gets all applications with the same priority and username
        $getAll = "SELECT * FROM `interviews` WHERE `interviews`.`company` = '$companyName' AND `interviews`.`username` = '" . $un . "'";
        $result = mysqli_query($conn, $getAll);

        // If the same company name has multiple rows in completed
        if (mysqli_num_rows($result) > 1) {
            $location = $_POST['locationSelect'];
            $date = $_POST['dateSelect'];
            if (empty($location) || empty($date)) {
                ?>
                <script>
                    function myFunction() {
                        alert("Multiple interviews with this company name exist. Please enter the other fields.");
                    }
                    myFunction();
                </script>
                <?php
            } else {
                // Deletes the application from completed
                $newquery = "DELETE FROM interviews WHERE `interviews`.`company` = '$companyName' AND `interviews`.`location` = '$location' AND `interviews`.`date` = '$date' AND `interviews`.`username` = '" . $un . "'";
                mysqli_query($conn, $newquery);
            }
        } else {
            // Deletes the application from completed
            $query3 = "DELETE FROM interviews WHERE `interviews`.`company` = '$companyName' AND `interviews`.`username` = '" . $un . "'";
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
    <title>Interviews</title>
</head>
<body>
    
    <!--This is the topnav-->
    <div class="topnav">
        <a class="active" href="../HTML/index2.html">Home</a>
        <a href="newInterview.php">Add Interview</a>
    </div>

    <!--This is the application modifying option-->
    <form method="post">
        <h1>Here are your Upcoming Interviews:</h1>
        <h4 style="text-align: center">Delete an Interview:</h4>
        <div style="text-align: center">
            <label for="appSelect">Enter Company Name:</label>
            <input name="appSelect" type="text" placeholder="Company"><br>
            <label for="locationSelect">Enter Location:</label>
            <input name="locationSelect" type="text" placeholder="Location"><br>
            <label for="dateSelect">Select Date:</label>
            <input type="date" id="date" name="dateSelect"><br><br>
            <input type="submit" value="Remove Interview"><br><br>
        </div>
    </form>

</body>

</html>

<?php
    $un = $_SESSION["username"];
    $sql = "SELECT * FROM interviews WHERE username='" . $un . "'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Table headers
        echo "<table><tr><th>Company</th><th>Location</th><th>Job Title</th><th>Date</th><th>Comments</th></tr>";
        // Puts all results of the sql query into the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["company"] . "</td><td>" . $row["location"] . "</td><td>" . $row["jobTitle"] . "</td><td>" . $row["date"] . "</td><td>" . $row["comments"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3 style='text-align:center'>You currently have 0 upcoming interviews.</h3>";
    }
?>