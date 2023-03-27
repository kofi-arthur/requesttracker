<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Tracker | Signup</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/notice.css">
    <link rel="stylesheet" href="css/notification.css">
</head>

<body>

    <?php
    if (isset($_SESSION['popUp'])) {
        echo $_SESSION['popUp'];
        unset($_SESSION['popUp']);
    } else if (isset($_SESSION['notify'])) {
        echo $_SESSION['notify'];
        unset($_SESSION['notify']);
    }
    ?>

    <form action="./php/signup.php" method="POST">
        <div class="logo">
            <img src="./assets/logo.png" alt="">
        </div>
        <div class="multi-field">
            <div class="field">
                <label for="firstName">First Name</label>
                <input type="text" name="fname" id="firstName" placeholder="Your first name" required />
            </div>
            <div class="field">
                <label for="lastName">Last Name</label>
                <input type="text" name="lname" id="lastName" placeholder="Your last name" required />
            </div>
        </div>
        <div class="field">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="eg. johndoe@wayoeltd.com" required />
        </div>
        </div>
        <div class="field">
            <label for="department" style="margin-bottom: 5px;">Department</label>
            <select name="department">
                <option value="" selected disabled hidden>Select your Department</option>
                <option value="HSE">HSE</option>
                <option value="Finance">Finance</option>
                <option value="Branding">Branding</option>
                <option value="Project">Project</option>
                <option value="Quality Control">Quality Control [QC]</option>
                <option value="Project">Project</option>
                <option value="Commercial">Commercial</option>
                <option value="Commercial">Procurement</option>
                <option value="Commercial">Engineering</option>
            </select>
        </div>
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
        <button type="submit" name="signup">Signup</button>

        <p class="create">Already have an account? <a href="./login.php">Login Here</a></p>

        <span class="footer">Wayoe Engineering and Constructions Limited</span>
    </form>
</body>

<!-- script -->
<script src="./js/toggleEye.js"></script>

</html>