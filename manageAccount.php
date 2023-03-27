<?php

session_start();

include './php/connect.php';
include './php/functionadmin.php';

$userData = checkLogin($conn);

$firstname = $userData['firstName'];
$lastName = $userData['lastName'];
$useremail = $userData['email'];
$pp = $userData['pp'];

$fullName = "$firstname $lastName";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Tracker - Dashboard</title>
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="./css/manage.css">
    <link rel="stylesheet" href="./css/changePP.css">
</head>

<body>

    <?php
    if (isset($_SESSION['notify'])) {
        echo $_SESSION['notify'];
        unset($_SESSION['notify']);
    }
    ?>

    <section class="sideNav">
        <div class="logo">
            <img src="./assets/logo.png" alt="">
        </div>

        <nav>
            <a href="./indexA.php" class="navLink"><i class="fas fa-grid-2"></i>Dashboard</a>
            <a href="./pendingA.php" class="navLink"><i class="fas fa-file-chart-column"></i>Pending Requests</a>
            <a href="./completedA.php" class="navLink"><i class="fas fa-file-check"></i>Completed Requests</a>
            <a href="./unsuccessfulA.php" class="navLink"><i class="fas fa-file-xmark"></i>Unsuccessful Requests</a>
            <a href="./allUsers.php" class="navLink active"><i class="fas fa-users"></i>All Users</a>
        </nav>

        <nav>
            <a href="logout.php" class="navLink"><i class="fas fa-sign-out"></i>Logout</a>
        </nav>
    </section>

    <section class="main">

        <header>
            <h3 class="headerTitle">Request Tracker Admin Center</h3>
            <div class="profile" onclick="toggle()">
                <div class="profilePic">
                    <img src="./assets/profilepicture/<?php echo $userData['pp'] ?>" alt="">
                </div>
                <h3><?php echo $userData['username'] ?></h3>
                <i class="fas fa-caret-down"></i>
            </div>
        </header>

        <div class="subSectionTitle">
            <h4>My Account</h4>
        </div>

        <div class="profileChange" onclick="showPP()">
            <i class="fal fa-camera"><span>Change</span></i>
            <img src="./assets/profilePicture/<?php echo $userData['pp'] ?>" alt="">
        </div>

        <h4>Personal</h4>
        <div class="type">
            <div class="descriptionCont">
                <span class="description">
                    These are the information you provided when signing up for this platform.
                    For security reasons, you are not allowed to change them. You and this platform's
                    Administrator are the only ones allowed to see this.
                </span>
            </div>
            <form action="#">
                <div class="multiField">
                    <div class="field">
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstName" id="firstName" readonly="readonly" value="<?php echo $userData['firstName'] ?>" required="required">
                    </div>
                    <div class="field">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastName" id="lastName" readonly="readonly" value="<?php echo $userData['lastName'] ?>" required="required">
                    </div>
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo $userData['email'] ?>" readonly="readonly" required="required">
                </div>
            </form>
        </div>

        <h4>Password</h4>
        <div class="type">
            <div class="descriptionCont">
                <span class="description">
                    Once you change your passsword, you'd be logged out and
                    required to sign back in using your newly created password.
                </span>
            </div>
            <form action="./php/changePassword.php" method="POST">
                <!-- hidden info -->

                <input type="hidden" name="email" value="<?php echo $userData['email'] ?>" readonly>

                <div class="passwordField">
                    <label for="oldPassword">Enter old password</label>
                    <div class="inputField">
                        <input type="password" name="oldPassword" id="oldPassword" required="required" />
                        <i class="fal fa-eye-slash" id="eye" onclick="toggleEye()"></i>
                    </div>
                </div>
                <div class="passwordField">
                    <label for="newPassword">Enter a new password</label>
                    <div class="inputField">
                        <input type="password" name="newPassword" id="newPassword" required="required" />
                        <i class="fal fa-eye-slash" id="eyee" onclick="toggleEyee()"></i>
                    </div>
                </div>
                <div class="passwordField">
                    <label for="confirmNewPassword">Confirm new password</label>
                    <div class="inputField">
                        <input type="password" name="confirmNewPassword" id="confirmNewPassword" required="required" />
                        <i class="fal fa-eye-slash" id="eyeee" onclick="toggleEyeee()"></i>
                    </div>
                </div>
                <button type="submit">Done <i class="fal fa-check"></i></button>
            </form>
        </div>


        <footer>
            <p>Wayoe Engineering and Constructions Limited - ICT</p>
        </footer>

        <!-- dropdown -->

        <div class="profileDropdown">
            <div class="dProfilePicture">
                <img src="./assets/profilePicture/<?php echo $userData['pp'] ?>" alt="">
            </div>
            <div class="profileInfo">
                <p><?php echo $fullName; ?></p>
                <span><?php echo $userData['email'] ?></span>
                <a href="./manageAccount.php">My Account</a>
            </div>
            <a href="#" class="logout">Logout</a>
        </div>

    </section>

    <!-- change pp -->

    <form class="ppContainer hidden" action="./php/changepp.php" method="POST" enctype="multipart/form-data" id="closePP">
        <div class="wrapper">
            <!-- hidden inputs -->
            <input type="hidden" name="email" value="<?php echo $userData['email']; ?>" readonly>

            <i class="fal fa-times closePP" onclick="closePP()"></i>
            <h3>Change Your Display Profile</h3>
            <div class="dpContainer">
                <img src="./assets/profilePicture/<?php echo $userData["pp"] ?>" id="previewImage" alt="">
            </div>
            <label for="newPP" class="">Upload Picture <i class="fal fa-file-arrow-up"></i></label>
            <input type="file" name="newPP" id="newPP" class="hidden" accept=".jpeg,.jpg,.png" />
            <button type="submit" name="changePicture">Save <i class="fal fa-check"></i></button>
        </div>
    </form>


    <!-- scripts -->
    <script src="./js/toggle.js"></script>

    <script>
        const menuPP = document.getElementById('closePP');

        function closePP() {
            menuPP.classList.add('hidden')
        }

        function showPP() {
            menuPP.classList.remove('hidden')
        }

        const inputFile = document.getElementById('newPP');
        inputFile.addEventListener("change", function() {
            const file = inputFile.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function() {
                const imageUrl = reader.result;
                const previewImage = document.getElementById("previewImage");
                previewImage.src = imageUrl;
            };

        });
    </script>

</body>

</html>