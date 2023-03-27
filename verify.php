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
    <title>Request Tracker | Forgot Password</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/notice.css">
    <link rel="stylesheet" href="css/notification.css">
</head>

<body>

    <form action="./php/verify.php" method="POST">
        <div class="logo">
            <img src="./assets/logo.png" alt="">
        </div>

        <h3>Verify your Email</h3>

        <p>Enter the password that was sent to <span class="email"><?php echo $email; ?></span></p>

        <!-- hidden -->

        <input type="hidden" name="email" value="<?php echo $email; ?>" readonly />

        <div class="field">
            <label for="codes">Verification Code</label>
            <input type="text" name="codes" id="codes" placeholder="Enter the verification code here" required />
        </div>

        <button type="submit" name="verify">Verify</button>
    </form>

</body>

</html>