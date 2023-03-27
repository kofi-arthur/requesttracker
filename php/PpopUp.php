<?php

session_start();
include './connect.php';

$id = $_GET['orderID'];

$errorUser = "<div class='notify red'>This user no longer exists</div>";

$errorConnect = "<div class='notify red'>Can't connect to the database now. Please try again later</div>";

$fetchInfo = mysqli_query($conn, "SELECT * FROM `pendingrequest` WHERE `id` = '$id' LIMIT 1");

if ($fetchInfo && mysqli_num_rows($fetchInfo)) {
    $infoResult = mysqli_fetch_assoc($fetchInfo);

    $userEmail = $infoResult['email'];

    $fetchUser = mysqli_query($conn, "SELECT * FROM `users` WHERE `email` = '$userEmail' LIMIT 1;");

    if ($fetchUser && mysqli_num_rows($fetchUser) > 0) {
        $userResult = mysqli_fetch_assoc($fetchUser);

        $details = '<section class="detail-pop-up" id="pop-up">
        <div class="wrapper">
            <i class="fal fa-times close" onclick="closePopup()"></i>
            <div class="header">
                <div class="profilePicture">
                    <img src="./assets/profilePicture/' . $userResult['pp'] . '" alt="User Profile Picture">
                </div>
                <div class="info">
                    <h3>' . $userResult['firstName'] . ' ' . $userResult['lastName'] . '</h3>
                    <span>' . $userResult['email'] . '</span>
                </div>
            </div>
            <span>Request ID</span>
            <h3>' . $id . '</h3>
        
            <span class="little-tile">Category</span>
            <h3>' . $infoResult['category'] . '</h3>
        
            <span class="little-title">Description</span>
            <p>' . $infoResult['description'] . '</p>
        
            <div class="action-buttons">
                <a href="./php/completed.php?orderID=' . $id . '" class="complete">Mark as Completed <i class="fal fa-check "></i></a>
                <a href="./php/unsuccessful.php?orderID=' . $id . '" class="unsuccessful">Mark as Unsuccessful <i class="fal fa-times"> </i></a>
            </div>
        </div>
        </section>';


        $_SESSION['popUp'] = $details;
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } else {
        // echo "Can't connect to the database now. Please try again later";
        $_SESSION['popUp'] = $errorUser;
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
} else {

    $_SESSION['popUp'] = $errorConnect;
    header("Location: {$_SERVER['HTTP_REFERER']}");
}
