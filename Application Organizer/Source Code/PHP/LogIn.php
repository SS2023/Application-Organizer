<?php    
    // Starts the session and makes sure we're connected to the database
    session_start();
    require('connDB.php');

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $emptyUP = false;
        // Makes sure all fields are filled out
        if (empty($username) || empty($password)) {
            echo "<div class=echo><h6>Please fill out all fields.</h6></div>";
        } else {
            // Gets the login info from the database
            $sql = "SELECT * FROM userList WHERE username='$username'";
            $result = mysqli_query($conn, $sql);
            $users = mysqli_fetch_assoc($result);
        }

        if (!$users) {
            echo "<h5>Username or password is incorrect.</h5>";         
        } else {
            // If user successfully signs in we redirect to a welcome page
            // again I DONT KNOW HOW THIS WORKS lol but it does
            
            $verfiy = password_verify($password, $users["password"]);
            if ($verfiy){
                if(isset($_SESSION['username'])) {
                    header('Location: ../HTML/index2.html');
                    exit();
                } else if (isset($_POST['username'])) {
                    $username = $_POST['username'];
                    $_SESSION["username"] = $username;
                    $url = "../HTML/index2.html";

                    header('Location: ../HTML/index2.html');
                    exit();
                }
            } else {
                echo "<h5>Username or password is incorrect.</h5>";    
            }
        
        
        }
    }
?>

<!--HTML page layout-->
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Log In </title>
    <link rel="stylesheet" type="text/css" href="../CSS/login.css">
</head>

<body>


<div class="center">
      <h1>Login</h1>
      <form method="post">
        <div class="txt_field">
    
            
          <input type="text" required name="username" required>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" required>
          <span></span>
          <label>Password</label>
        </div>
        <div class="pass">
        <a href="forgotPassword.php">Forgot Password?</a> 
    </div>
        <input type="submit" value="Login">
        <div class="signup_link">
          <p> New to the site? <a href="createAccount.php">Signup</a> </p>
          <a href="../HTML/index.html">Return To Home Page</a>
        </div>
      </form>
    </div>
    
    
</body>
</html>