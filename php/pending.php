<?php

session_start();

include './connect.php';

$getID = $_GET['orderID'];

$prevHeader = $_SERVER['HTTP_REFERER'];
$check = "completedA.php";
$check = strpos($prevHeader, $check);

// notifications
$success = "<div class='notify'><p>Marked as Unsuccessful Successfully.</p></div>";
$error = "<div class='notify red'><p>There was an error, please try again later.</p></div>";

if ($check == true) {
    // insert into pendingtable from completedTable
    $sql = "INSERT INTO `pendingrequest` (`id`, `name`, `email`, `department`, `category`, `description`, `time`) SELECT `id`, `name`, `email`, `department`, `category`, `description`, `time` FROM `completedrequest` WHERE id = '$getID';";
    $executeP = mysqli_query($conn, $sql);

    if ($executeP) {
        $deleteInfoP = mysqli_query($conn, "DELETE FROM `completedrequest` WHERE `id` = '$getID';");
        if ($deleteInfoP) {
            header("Location:../pendingA.php");
            $_SESSION['notify'] = $success;
        } else {
            header("Location: {$_SERVER['HTTP_REFERER']}");
            $_SESSION['notify'] = $error;
        }
    } else {
        header("Location: {$_SERVER['HTTP_REFERER']}");
        $_SESSION['notify'] = $error;
    }
} else {
    // insert into pendingtable from unsuccessfulTable
    $sql = "INSERT INTO `pendingrequest` (`id`, `name`, `email`, `department`, `category`, `description`, `time`) SELECT `id`, `name`, `email`, `department`, `category`, `description`, `time` FROM `unsuccessfulrequest` WHERE id = '$getID';";
    $executeC = mysqli_query($conn, $sql);

    if ($executeC) {
        $deleteInfoC = mysqli_query($conn, "DELETE FROM `unsuccessfulrequest` WHERE `id` = '$getID';");
        if ($deleteInfoC) {
            header("Location:../pendingA.php");
            $_SESSION['notify'] = $success;
        } else {
            header("Location: {$_SERVER['HTTP_REFERER']}");
            $_SESSION['notify'] = $error;
        }
    } else {
        header("Location: {$_SERVER['HTTP_REFERER']}");
        $_SESSION['notify'] = $error;
    }
}
