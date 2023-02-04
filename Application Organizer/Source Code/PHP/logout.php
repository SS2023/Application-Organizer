<?php
    // Makes sure all session variables are destroyed
    session_start();
    $_SESSION = array();
    session_destroy();
    
?>

<!DOCTYPE html>
<html lang="en">

<body>
    <h1>You have successfully logged out.</h1>
    <?php
        header('Location: ../HTML/index.html');
        exit();

    ?>

</body>

</html>