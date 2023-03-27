<?php

function checkLogin($conn)
{

    if (isset($_SESSION['userEmail'])) {

        $email = $_SESSION['userEmail'];
        $query = "SELECT * FROM `admin` WHERE `email` = '$email' LIMIT 1";
        
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $userData = mysqli_fetch_assoc($result);
            return $userData;
        }
    }

    //redirect to login page if user isn't logged in
    header("Location:login.php");
    die;
}
