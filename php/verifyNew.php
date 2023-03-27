<?php

include "./connect.php";

session_start();

if (isset($_POST['verify'])) {
    $email = $_POST['email'];
    $codes = $_POST['codes'];
    $sql = "SELECT `verificationCode` FROM `users` WHERE `email` = '$email'; ";
    $ex = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($ex);

    // notification
    $success = "<div class='notify'>Account created successfully<br> You can login now</div>";


    if ($codes == $result['verificationCode']) {
        mysqli_query($conn, "UPDATE `users` set verified = 'verified' WHERE `email` = '$email' ");
        $_SESSION['notify'] = $success;
        header("Location: ../login.php");
    } else {
        $_SESSION['notice'] = "<div class='notice'<p>Invalid Code</p></div>";
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
}
