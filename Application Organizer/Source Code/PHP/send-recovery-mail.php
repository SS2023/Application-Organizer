<?php
    require('connDB.php');
    session_start();
    // Includes the library
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '../vendor/autoload.php';

    // Makes sure that a user with the email entered exists
    $email = $_POST["email"];
 
    $sql = "SELECT * FROM userList WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
    {
        // Generates a token which is sent in the email
        $reset_token = time() . md5($email);
        // Saves the token in the user's database record
        $sql = "UPDATE userList SET reset_token='$reset_token' WHERE email='$email'";
        mysqli_query($conn, $sql);
        $message = "<p>Please click the link below to reset your password</p>";
        $message .= "<a href='http://localhost/Group5_FinalProject/PHP/reset-password.php?email=$email&reset_token=$reset_token'>";
        $message .= "Reset password";
        $message .= "</a>";
        // Calls the function to send the email
        send_mail($email, "Reset password", $message);
    }
    else
    {
        echo "Email does not exists";
    }

    // Sends the email via phpmailer
    function send_mail($to, $subject, $message)
    {
        $mail = new PHPMailer(true);
    
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'application.organizer1@gmail.com';                     // SMTP username
            $mail->Password   = 'engekqexvfjsdaqs';                               // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to
        
            $mail->setFrom('application.organizer1@gmail.com', 'Application Organizer');
            //Recipients
            $mail->addAddress($to);
        
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
        
            $mail->send();
            echo '<h1 style="text-align:center;">A link to reset password has been sent to your email<h1>';
            echo '<a style="text-align:center;" href="../HTML/index.html">Return To Home Page</a>';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Log In </title>
    <link rel="stylesheet" type="text/css" href="../CSS/login.css">
</head>
<style>
h1 {text-align: center;}
p {text-align: center;}
div {text-align: center;}
</style>