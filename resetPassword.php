<?php

include "./php/connect.php";

session_start();

$email = $_GET['email'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Tracker | Reset Password</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/notice.css">
    <link rel="stylesheet" href="css/notification.css">
</head>

<body>

    <form action="./php/resetPassword.php" method="POST">
        <div class="logo">
            <img src="./assets/logo.png" alt="">
        </div>

        <h3>Reset your Password</h3>

        <p>Create a new password for your acocunt.</p>

        <!-- hidden -->

        <input type="hidden" name="email" value="<?php echo $email; ?>" readonly />

        <div class="field">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Create a new password" required />
            <i class="fal fa-eye" id="view" onclick="toggleEye()"></i>
        </div>

        <div class="field">
            <label for="password">Confirm Password</label>
            <input type="password" name="cpassword" id="confirmPassword" placeholder="Confirm your new password" required />
            <i class="fal fa-eye" id="vieww" onclick="toggleEyee()"></i>
        </div>

        <button type="submit" name="reset">Verify</button>

    </form>

    <!-- script -->

    <script src="./js/toggleEye.js"></script>

</body>

</html>