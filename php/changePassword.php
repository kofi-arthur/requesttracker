<?php

session_start();

include "./connect.php";

// create variables
$email = $_POST['email'];
$oldPassword = $_POST['oldPassword'];
$newPassword = $_POST['newPassword'];
$confirmNewPassword = $_POST['confirmNewPassword'];

// notifications 
$success = "<div class='notify'><p>Password changed successfully.</p></div>";
$error = "<div class='notify red'><p>There was an error, please try again later.</p></div>";
$errorMatch = "<div class='notify red'><p>Password incorrect</p></div>";

// get the info realted to the user from the database
$fecthInfo = mysqli_query($conn, "SELECT * FROM `admin` WHERE `email` = '$email' LIMIT 1;" );

if($fecthInfo && mysqli_num_rows($fecthInfo)) {
    $result = mysqli_fetch_assoc($fecthInfo);

    // check if the old password coresponds with the one in the database
    if (password_verify($oldPassword, $result['password']) == 1) {
        
        // encrypt the new password
        $encryptedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        
        // replace the old password with the new one
        $updatePassword = mysqli_query($conn, "UPDATE `admin` SET `password` = '$encryptedPassword' WHERE `email` = '$email';");

        if($updatePassword && mysqli_affected_rows($conn) > 0) {
            header("Location: ../logout.php");
            $_SESSION['notify'] = $success;
        } else {
            header("Location: ../manageAccount.php");
            $_SESSION['notify'] = $error;
        }
    } else {
        header("Location: ../manageAccount.php");
            $_SESSION['notify'] = $errorMatch;
    }
}
?>