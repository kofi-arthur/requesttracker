<?php

include "./connect.php";

session_start();

if (isset($_POST['verify'])) {
    $email = $_POST['email'];
    $codes = $_POST['codes'];
    $sql = "SELECT `verificationCode` FROM `users` WHERE `email` = '$email'; ";
    $ex = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($ex);

    if ($codes == $result['verificationCode']) {
        header("Location: ../resetPassword.php?email='$email'");
    } else {
        $_SESSION['notice'] = "<div class='notice'<p>Invalid Code</p></div>";
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
}
