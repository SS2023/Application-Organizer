<?php
  require('session.php');
  require('connDB.php');

  $sql = "SELECT * FROM userlist WHERE username = '".$_SESSION["username"]."'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0){

    $row = mysqli_fetch_assoc($result);
    if (isset($_POST["old"])){
      $old = $_POST["old"];
      $verify = password_verify($old,$row["password"]);
      if($verify){
          
          if($_POST["Password"] == $_POST["confirmPassword"])
          {
              $hash = password_hash($_POST["Password"],PASSWORD_DEFAULT);
              $sqlQ = "UPDATE userlist SET password = '".$hash."' WHERE username = '".$_SESSION["username"]."'";
              mysqli_query($conn, $sqlQ);
              $_SESSION["message"] = "Password Updated";
              //header('Location: profile.php');
          } 
          else {
              $_SESSION["message2"] = "Password does not match Please try again";
              //header('Location: profile.php');
          }
    
      } else {
          $_SESSION["message2"] = "Old Password is not correct";
          //header('Location: profile.php');
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/profile.css">
    <title>Profile</title>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <h1 class = "navbar-h1"><a class="navbar-brand" href="#">Reset Password</a></h1>
    <button class="mybutton navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../HTML/index2.html">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="../PHP/logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div id="form" >
  <div class="iform" >
    <form method="post">
      <div class="form-group" >
        <label for="exampleInputEmail1">Old Password</label>
        <input type="password" class="form-control" id="exampleInputPassword" name = "old" placeholder="Enter Old Password" required>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name = "Password" placeholder="Password" required>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Confirm Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name = "confirmPassword" placeholder="Confirm Password" required>
      </div>
      <button type="submit" class="btn btn-primary">Update Password</button>
    </form>
    <div class="mess">
      <?php
        if (isset($_SESSION["message"]))
        {
          
          echo '<h2 class = "success">'.$_SESSION["message"].'</h2>';
          unset($_SESSION["message"]);
        } else if(isset($_SESSION["message2"]))
        {
          echo '<h2 class = "fail">'.$_SESSION["message2"].'</h2>';
          unset($_SESSION["message2"]);
        }
      ?>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>