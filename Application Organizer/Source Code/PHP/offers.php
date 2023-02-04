<?php
    require('session.php');
    require('connDB.php');

    // If form data has been submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Variables used in the first query
        $companyName = $_POST['appSelect'];
        $un = $_SESSION["username"];

        // Gets the corresponding row the user would like to modify
        $sql = "SELECT * FROM `offers` WHERE `offers`.`company` = '$companyName' AND `offers`.`username` = '" . $un . "'";
        $result2 = mysqli_query($conn, $sql);
        $row2 = mysqli_fetch_assoc($result2);

        // If the same company name has multiple rows in offers
        if (mysqli_num_rows($result2) > 1) {
            $location = $_POST['locationSelect'];
            $date = $_POST['dateSelect'];
            if (empty($location) || empty($date)) {
                ?>
                <script>
                    function myFunction() {
                        alert("Multiple applications with this company name exist. Please enter the location and date.");
                    }
                    myFunction();
                </script>
                <?php
            } else {
                $newsql = "SELECT * FROM `offers` WHERE `offers`.`company` = '$companyName' AND `offers`.`location` = '$location' AND `offers`.`date` = '$date' AND `offers`.`username` = '" . $un . "'";
                $newresult = mysqli_query($conn, $newsql);
                $newrow = mysqli_fetch_assoc($newresult);

                // Puts the information from that row into variables to be used in SQL queries
                $company = $newrow["company"];
                $jobTitle = $newrow["jobTitle"];
                $comments = $newrow["comments"];
                $username = $newrow["username"];

                // Deletes the application from offers
                $newquery = "DELETE FROM offers WHERE `offers`.`company` = '$companyName' AND `offers`.`location` = '$location' AND `offers`.`date` = '$date'";
                mysqli_query($conn, $newquery);
            }
        } 
        else { // If no more info is needed to idenfity the offer to delete
            $query2 = "DELETE FROM offers WHERE `offers`.`company` = '$companyName' AND `offers`.`username` = '" . $un . "'";
            mysqli_query($conn, $query2);
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
        <a href="newOffer.php">Add New Offer</a>
    </div>

    <!--This is the application modifying option-->
    <form method="post" style="text-align: center">
        <h1>Here are Your Current Offers</h1>
        <h3 style="text-align: center">Edit Your Offers Below:</h3>
        <div>
            <label for="appSelect">Enter Company Name:</label>
            <input name="appSelect" type="text" placeholder="Company"><br>
            <label for="locationSelect">Enter Location:</label>
            <input name="locationSelect" type="text" placeholder="Location"><br>
            <label for="dateSelect">Select Date:</label>
            <input type="date" id="date" name="dateSelect"><br><br>
        </div>
        <input type="submit" value="Delete Offer"><br><br>
    </form>

</body>
</html>

<?php
    $un = $_SESSION["username"];
    $sql = "SELECT * FROM offers WHERE username='" . $un . "'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Table headers
        echo "<table><tr><th>Company</th><th>Location</th><th>Job Title</th><th>Date</th><th>Work Style</th><th>Comments</th></tr>";
        // Puts all results of the sql query into the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["company"] . "</td><td>" . $row["location"] . "</td><td>" . $row["jobTitle"] . "</td><td>" . $row["date"] . "</td><td>" . $row["workLocation"] . "</td><td>" . $row["comments"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3 style='text-align:center'>You currently have 0 offers.</h3>";
    }
?>