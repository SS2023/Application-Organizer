<?php
    require('session.php');
     // If form data has been submitted
     if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Gathers ranking and username
        $appid = $_POST['appSelect'];
        $un = $_SESSION["username"];

        // Gets all applications with the same priority and username
        $getAll = "SELECT * FROM `saved` WHERE `saved`.`priority` = '$appid' AND `saved`.`username` = '" . $un . "'";
        $result = mysqli_query($conn, $getAll);

        // If the user has the same priority ranking for multiple applications
        if (mysqli_num_rows($result) > 1) {
            $companyName = $_POST['companySelect'];
            $location = $_POST['locationSelect'];
            if (empty($location) || empty($companyName)) {
                ?>
                <script>
                    function myFunction() {
                        alert("Multiple applications with this application ID exist. Please enter company name and location.");
                    }
                    myFunction();
                </script>
                <?php
            } else {
                $deleterow = "DELETE FROM saved WHERE `saved`.`priority` = '$appid' AND `saved`.`company` = '$companyName' AND `saved`.`location` = '$location' AND `saved`.`username` = '" . $un . "'";
                mysqli_query($conn, $deleterow);
            }
        } else {
            // Deletes the rejection specified by the user
            $deletequery = "DELETE FROM saved WHERE `saved`.`priority` = '$appid' AND `saved`.`username` = '" . $un . "'";
            mysqli_query($conn, $deletequery);
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
    <title>Saved</title>
</head>
<body>
    <div class="topnav">
        <a class="active" href="../HTML/index2.html">Home</a>
        <a href="newSaved.php">Save a New Application</a>
    </div>
    <form method="post">
        <h1>Here are your saved applications:<h1>
        <h4 style="text-align: center">If Priority Ranking Appears More Than Once:</h4>
        <div style="text-align: center">            
            <label for="appSelect">Enter Company Name:</label>
            <input name="companySelect" type="text" placeholder="Company"><br>
            <label for="locationSelect">Enter Location:</label>
            <input name="locationSelect" type="text" placeholder="Location"><br><br>
            <label for="appSelect">Select priority id to delete:</label>
            <input type="number" id="appSelect" name="appSelect" min="1" max="500">
            <input type="submit" value="Delete"><br><br>
        </div>
    </form>

</body>

</html>

<?php
    $un = $_SESSION["username"];
    $sql = "SELECT * FROM saved WHERE username='" . $un . "'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Table headers
        echo "<table style='font-size: 15px;'><tr><th>Priority Ranking</th><th>Company</th><th>Location</th><th>Job Title</th><th>Deadline</th><th>Work Style</th><th>Comments</th></tr>";
        // Puts all results of the sql query into the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["priority"]. "</td><td>" . $row["company"]. "</td><td>" . $row["location"] . "</td><td>" . $row["jobTitle"] . "</td><td>" . $row["date"] . "</td><td>" . $row["workLocation"] . "</td><td>" . $row["comments"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3 style='text-align:center'>You currently have 0 saved applications.</h3>";
    }
?>