<?php
    // Starts the session and makes sure we're connected to the database
    session_start();
    require('connDB.php');

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        // Validates input: all fields filled and password is at least 7 characters
        if (empty($username) || empty($password) || empty($email)) {
            echo "<h5>Please fill out all fields.</h5>";
        } else if (strlen($password) < 7) {
            echo "<h5>Password must be more than 6 characters.</h6>";
        } else {
            // Checks for duplicates already in the user list database
            $checkDuplicate = "SELECT * FROM userList WHERE username='$username' AND email='$email' LIMIT 1";
            $result = mysqli_query($conn, $checkDuplicate);
            $user = mysqli_fetch_assoc($result);
            // If a user with the same info already exists
            if ($user) {
                // Case: same username
                if ($user['username'] === $username) {
                    echo "<h5>Username already exists!</h5>";
                }
                // Case: same email
                if ($user['email'] === $email) {
                    echo "<h5>Email already exists!</h5>";
                }
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                // Inserts account info into the database
                $query = "INSERT INTO userList VALUES('$username', '$hash', '$email', '')";
                mysqli_query($conn, $query);
                // I DONT KNOW WHAT THE POINT OF THIS IS BUT WE END UP AT LOGGEDIN.HTML (hopefully)
                if(isset($_SESSION['username'])) {
                    header('Location: ../HTML/index2.html');
                    exit();
                } else if (isset($_POST['username'])) {
                    $username = $_POST['username'];
                    $_SESSION['username'] = $username;
                    $url = "../HTML/index2.html";
                    header('Location: ../HTML/index2.html');
                    exit();
                }
            }
        }
    }
     
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../CSS/login.css">
    <title>Log In/Create Account</title>
</head>

<body>
<div class="center">
      <h1>Create an Account</h1>
      <form method="post">
        <div class="txt_field">
    
            
          <input type="text" required name="username" required>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="email" required name="email" required>
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input type="password" required name="password" required>
          <span></span>
          <label>Password</label>
        </div>
        <div class="pass">
    </div>
        <input type="submit" value="Create an Account">
        <div class="signup_link">
          <p> Already have an account? <a href="LogIn.php">Login</a> </p>
          <a href="../HTML/index.html">Return To Home Page</a>
        </div>
      </form>
    </div>
    
    
</body>

</html>