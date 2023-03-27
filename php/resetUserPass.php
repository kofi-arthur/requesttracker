<?php

include "./connect.php";
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../plugins/PHPMailer/src/Exception.php';
require '../plugins/PHPMailer/src/PHPMailer.php';
require '../plugins/PHPMailer/src/SMTP.php';

// notoficiations 

$success = "<div class='notify'>Reset link sent successfully</div>";
$errorSend = "<div class='notify' red>Can't send mail now, please try again later</div>";
$errorConnect = "<div class='notify red'>Something went wrong. Please try again later</div>";

if (isset($_POST["send"])) {

    $email = $_POST['email'];

    $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `email` = '$email' LIMIT 1");

    if (mysqli_num_rows($query) > 0) {

        $result = mysqli_fetch_assoc($query);
        $firstName = $result['firstName'];

        //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Enableverbosedebug output
            $mail->SMTPDebug = 0; //SMTP::DEBUB_SERVER;

            //Send using SMTP
            $mail->isSMTP();

            //Set the SMTP server to send through
            $mail->Host = 'smtp.gmail.com';

            //Enable SMTP authentication
            $mail->SMTPAuth = true;

            //SMTP username
            $mail->Username = 'paularthurjnr611@gmail.com';

            //STMP password
            $mail->Password = 'wmchjqcdefjuexum';

            //Enable TLS encryption
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            //TCP port to connect to, use 468 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('paularthurjnr611@gmail.com', 'WEC Ltd Request Tracker');

            //Add a recipient
            $mail->addAddress($email, $firstName);

            //set email format to HTML
            $mail->isHTML(true);

            $link = "http://192.168.100.136:505/resetPassword.php?email=$email";
            $message = "<div><h1>Password Reset</h1><p>Use the link below to reset your password</p><br>$link<br><br><p>Admin<br>WEC Request Tracker</p></div>";

            $mail->Subject = 'Email verfication';
            $mail->Body = $message;

            $mail->send();

            $sql = "UPDATE `users` SET `verificationCode` = '$verificationCode' WHERE `email` = '$email'; ";
            mysqli_query($conn, $sql);

            $_SESSION['notify'] = $success;
            header("Location: {$_SERVER['HTTP_REFERER']}");

            exit();
        } catch (Exception $e) {
            $_SESSION['notify'] = $errorSend;
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
    } else {
        $_SESSION['notify'] = $errorConnect;
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
}
