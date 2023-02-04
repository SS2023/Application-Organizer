<!--HTML page layout-->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../CSS/login.css">
    <title>Forgot Password</title>
</head>



<div class="center">
      <h1>Forgot Password</h1>
      <br><p> Please enter the email associated with your account below:</p>

      <form method="post" action="send-recovery-mail.php">
        <div class="txt_field">
    
        <input type="email" required name="email" required>
          <span></span>
          <label>Email</label>
        </div>
        
        
        <input type="submit" value="Send Recovery Email">
        <div class="signup_link">
          <a href="../PHP/LogIn.php">Return To The Login Page</a>
        </div>
      </form>
    </div>
    
    
</body>
</html>