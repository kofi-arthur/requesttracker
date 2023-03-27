<?php

session_start();
include './php/connect.php';
include './php/functionadmin.php';
include './php/functionuser.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Tracker</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/notice.css">
    <link rel="stylesheet" href="css/notification.css">
</head>

<body>

    <?php if (isset($_POST['login'])) {

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if (empty($email) || empty($password)) {
            sleep(1);
            echo "<div class='notice'><p>Input fields can't be empty</p></div>";
        } else {
            // comapre with info in database
            $queryAdmin = mysqli_query($conn, "SELECT * FROM `admin` where email = '$email'; ");
            $queryUsers = mysqli_query($conn, "SELECT * FROM `users` where email = '$email'; ");

            if ($queryAdmin && mysqli_num_rows($queryAdmin) > 0) {
                $resultAdmin = mysqli_fetch_assoc($queryAdmin);

                $adminVerify = password_verify($password, $resultAdmin['password']);

                if ($email == $resultAdmin['email'] && $adminVerify == 1) {
                    header("Location:./indexA.php");
                    $_SESSION['userEmail'] = $email;
                    sleep(1);
                } else {
                    echo "<div class='notice'><p>Incorrect email or password</p></div>";
                }
            } else if ($queryUsers && mysqli_num_rows($queryUsers) > 0) {
                $resultUsers = mysqli_fetch_assoc($queryUsers);

                $userVerify = password_verify($password, $resultUsers['password']);

                if ($email == $resultUsers['email'] && $userVerify == 1) {
                    header("Location:./index.php");
                    $_SESSION['userEmail'] = $email;
                    sleep(1);
                } else {
                    echo "<div class='notice'><p>Incorrect email or password</p></div>";
                }
            } else {
                echo "<div class='notice'><p>User doesn't exist</p></div>";
            }
        }
    }

    ?>

    <?php

    if (isset($_SESSION['notify'])) {
        echo $_SESSION['notify'];
        unset($_SESSION['notify']);
    }

    ?>

    <form action="./login.php" method="POST">
        <div class="logo">
            <img src="./assets/logo.png" alt="">
        </div>
        <div class="field">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="eg. john.doe@wayoeltd.com" required />
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required />
        </div>
        <button type="submit" name="login">Login</button>

        <a href="./forgot.php" class="forgot">Forgot Password?</a>

    </form>
    <form action="#" class="create-form">
        <p class="create">Don't have an account? <a href="./signup.php">Create one here</a></p>

    </form>
    <span class="powered">Powered by Wayoe Engineering and Constructions Limited</span>
    <!-- script -->

</body>

</html>