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

    <?php
    if (isset($_SESSION['notice'])) {
        echo $_SESSION['notice'];
        unset($_SESSION['notice']);
    }
    ?>

    <form action="./php/forgot.php" method="POST">
        <div class="logo">
            <img src="./assets/logo.png" alt="">
        </div>

        <h3>Forgot Password</h3>

        <p>
            Enter the email you use when signing into your account on this platform then click on <b>Next</b> when you're done. <br>
            You will recieve an email with a verification code needed to reset your password.
        </p>

        <!-- hidden -->


        <div class="field">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="eg. john.doe@wayoeltd.com" required />
        </div>

        <button type="submit" name="send">Next</button>
    </form>

</body>



</body>

</html>