<?php

include "./connect.php";

session_start();

$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

$newPassword = password_hash($password, PASSWORD_BCRYPT);

if ($password == $cpassword) {
    $sql = "UPDATE `users` SET `password` = '$newPassword' WHERE `email` = $email";
    $ex = mysqli_query($conn, $sql);

    if ($ex) {
        $_SESSION['notify'] = "<div class='notify'><p>Password Reset Successfully</p></div>";
        header("Location: ../login.php");
    } else {
        $_SESSION['notify'] = "<div class='notify red'><p>Can't reset password now, Please try again later</p></div>";
        header("Location: ../login.php");
    }
} else {
    $_SESSION['notify'] = "<div class='notify red'><p>Passwords must match</p></div>";
    header("Location: ../resetPassword.php?email=$email");
}
