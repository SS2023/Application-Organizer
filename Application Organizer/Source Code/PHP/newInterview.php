<?php
    session_start();
    require('connDB.php');

    // If form data has been submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $company = $_POST['company'];
        $location = $_POST['location'];
        $date = $_POST['date'];
        $workLocation = $_POST['worklocation'];
        $title = $_POST['jobtitle'];
        $comments = $_POST['comments'];
        if (empty($company)) { // Requires company name
            echo "<h5>Company name is required.</h5>";
        } else {
            // Inserts application info into the database
            $un = $_SESSION["username"];
            $query = "INSERT INTO `interviews`(`company`, `location`, `jobTitle`, `date`, `comments`, `username`) VALUES ('$company', '$location', '$title', '$date', '$comments', '" . $un . "');";
            mysqli_query($conn, $query);
            // Returns to the completed page
            header('Location: interviews.php');
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Interview</title>
    <link rel="stylesheet" type="text/css" href="../CSS/login.css">
</head>


</html>

<div class="center">
      <h1>Add a New Interview</h1>
      <form method="post">
        <div class="txt_field">
    
            
          <input type="text" required name="company" required>
          <span></span>
          <label>Company Name</label>
        </div>
        <div class="txt_field">
          <input type="text" name="location" required>
          <span></span>
          <label>Location (State, City, etc.)</label>
        </div>
        <div class="txt_field">
    
            
          <input type="text" required name="jobtitle" required>
          <span></span>
          <label>Job Title</label>
        </div>

        <div class="txt_field">
    
            
          <input type="date" id="date" required name="date" required>
          <span></span>
          <label></label>
        </div>

        
        <div class="txt_field">
    
            
    <input type="text" required name="comments" required>
    <span></span>
    <label>Comments</label>
  </div>
        
        <input type="submit" value="Submit">
         
        <div class="signup_link">
          <p> Click here to <input type="reset" value="Reset"> <br><br>
          <a href="../HTML/index2.html">Return To Home Page</a>
        </div>
      </form>
    </div>