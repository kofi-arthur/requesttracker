<?php

session_start();
include './connect.php';
include './functionuser.php';

$userData = checkLoginUser($conn);

$file = $userData['pp'];

if (isset($_POST['changePicture'])) {
    $picEmail = $_POST['email'];
    $pic = $_FILES['newPP'];
    $picName = pathinfo($pic['name'], PATHINFO_FILENAME);
    $picExt = pathinfo($pic['name'], PATHINFO_EXTENSION);
    $newPicName = uniqid() . "." . $picExt;

    // notifictions
    $success = "<div class='notify'><p>Display Profile updated successfully</p></div>";
    $errorDb = "<div class='notify red'><p>Could not connect to Database, please try again later.</p></div>";
    $error = "<div class='notify red'><p>There was an error, please try again later.</p></div>";
    $error = "<div class='notify red'><p>Please upload only .jpg | .jpeg | .png images only</p></div>";


    $targetDir = "../assets/profilePicture/";

    $filePathName = "$targetDir$file";

    $allowedTypes = ["image/jpeg", "image/png", "image/png"];

    if (in_array($pic['type'], $allowedTypes)) {
        // upload picture to server
        if (move_uploaded_file($pic['tmp_name'], $targetDir . $newPicName)) {

            if ($file !== 'default.png') {
                unlink($filePathName);
                $insertIntoDb = mysqli_query($conn, "UPDATE `users` SET `pp` = '$newPicName' WHERE `email` = '$picEmail'; ");
            } else {
                // insert the image name into the database
                $insertIntoDb = mysqli_query($conn, "UPDATE `users` SET `pp` = '$newPicName' WHERE `email` = '$picEmail'; ");
            }
            if ($insertIntoDb) {
                $_SESSION['notify'] = $success;
                header("Location: {$_SERVER['HTTP_REFERER']}");
            } else {
                $_SESSION['notify'] = $errorDb;
                header("Location: {$_SERVER['HTTP_REFERER']}");
            }
        } else {
            $_SESSION['notify'] = $error;
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
    } else {
        $_SESSION['notify'] = $errorPic;
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
}
