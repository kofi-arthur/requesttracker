<?php

session_start();

include "./connect.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../plugins/PHPMailer/src/Exception.php';
require '../plugins/PHPMailer/src/PHPMailer.php';
require '../plugins/PHPMailer/src/SMTP.php';

if (isset($_POST['signup'])) {

    $firstname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    // notification
    $error = "<div class='notify red'><p>Can't reach the databse right now, please try again later</p></div>";
    $errorEmpty = "<div class='notify red'><p>Input fields can't be empty</p></div>";
    $errorExist = "<div class='notify red'><p>User already exists</p></div>";
    $errorMismatch = "<div class='notify red'><p>Please make sure your passwords are the same.</p></div>";

    // query database to check if the account already exists
    $query = "SELECT * FROM `users` WHERE `email` = '$email' LIMIT 1;";
    $execute = mysqli_query($conn, $query);

    if (empty($email) || empty($password) || empty($firstname) || empty($lastname) || empty($department) || empty($cpassword)) {
        $_SESSION['notify'] = "<div class='notice'><p>Input fields can't be empty</p></div>";
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } else if (mysqli_num_rows($execute) > 0) {
        $_SESSION['notify'] = $errorExist;
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } else if ($password !== $cpassword) {
        $_SESSION['notify'] = $errorMismatch;
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } else {

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

            // encrypt password
            $newPassword = password_hash($password, PASSWORD_BCRYPT);

            // add information to databse
            $add = "INSERT INTO `users` (`firstName`, `lastName`, `email`, `department`, `password`, `pp`, `verificationCode`, `verified`) VALUES ('$firstname', '$lastname', '$email', '$department', '$newPassword', 'default.png', '$verificationCode', 'not verified');";
            $queryUsers = mysqli_query($conn, $add);

            // check if the above command was successful
            // if it was redirect user to login page
            // if it's not, take user back to signup page ask the user to try again later.
            if ($queryUsers && mysqli_affected_rows($conn) > 0) {
                $_SESSION['notify'] = $success;
                header("Location:../verifyNew.php?email=$email");
            } else {
                $_SESSION['notify'] = $error;
                header("Location: {$_SERVER['HTTP_REFERER']}");
            }
        } catch (Exception $e) {
            $mailError = "<div class='notice'><p>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</p></div>";

            $_SESSION['notice'] = $mailError;
            echo $mailError;
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
    }
}
