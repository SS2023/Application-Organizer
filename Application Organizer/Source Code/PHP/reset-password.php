<?php
    session_start();
    $email = $_GET["email"];
    $reset_token = $_GET["reset_token"];

    require('connDB.php');
    
    $sql = "SELECT * FROM userList WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
    {
        // Makes sure we have the right token so we don't change another users password
        $user = mysqli_fetch_object($result);
        if ($user->reset_token == $reset_token)
        {
            // Simple form to enter a new password
            if ($user->reset_token == $reset_token)
            {
                ?>
                <form method="POST" action="new-password.php">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <input type="hidden" name="reset_token" value="<?php echo $reset_token; ?>">
                    
                    <input type="password" name="new_password" placeholder="Enter new password">
                    <input type="submit" value="Change password">
                </form>
                <?php
            }
            else
            {
                echo "Recovery email has been expired";
            }
        }
        else
        {
            echo "Recovery email has been expired";
        }
    }
    else
    {
        echo "Email does not exists";
    }
?>