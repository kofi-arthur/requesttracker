<?php

include "./connect.php";
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../plugins/PHPMailer/src/Exception.php';
require '../plugins/PHPMailer/src/PHPMailer.php';
require '../plugins/PHPMailer/src/SMTP.php';

// notoficiations 

$errorMail = "<div class='notice'><p>Couldn't complete request. Please trya again later.</p></div>";
$error = "<div class='notice'><p>This email doesn't exist in our records</p></div>";

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

            $verificationCode = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

            $mail->Subject = 'Email verfication';
            $mail->Body = '<p>Your verification code is: <b style="font-size: 30px;">' . $verificationCode . '</b>';

            $mail->send();

            $sql = "UPDATE `users` SET `verificationCode` = '$verificationCode' WHERE `email` = '$email'; ";
            mysqli_query($conn, $sql);

            header("Location: ../verify.php?email=" . $email);
            exit();
        } catch (Exception $e) {
            $mailError = "<div class='notice'><p>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</p></div>";
            $_SESSION['notice'] = $mailError;
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
    } else {
        $_SESSION['notice'] = $error;
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
}
