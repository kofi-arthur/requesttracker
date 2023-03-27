<?php

session_start();

include './php/connect.php';
include './php/functionadmin.php';

$userData = checkLogin($conn);


$firstname = $userData['firstName'];
$lastName = $userData['lastName'];

$fullName = "$firstname $lastName";

// fetch all requests from the database
$allUsers = mysqli_query($conn, "SELECT * FROM `users` ORDER BY `firstName` ASC");

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
    <link rel="stylesheet" href="./css/empty.css">
    <link rel="stylesheet" href="./css/table.css">
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="./css/details.css">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/allUsers.css">
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

    <section class="sideNav">
        <a class="logo" href="./indexA.php">
            <img src="./assets/logo.png" alt="">
        </a>

        <nav>
            <a href="./indexA.php" class="navLink"><i class="fas fa-grid-2"></i>Dashboard</a>
            <a href="./pendingA.php" class="navLink"><i class="fas fa-file-chart-column"></i>Pending Requests</a>
            <a href="./completedA.php" class="navLink"><i class="fas fa-file-check"></i>Completed Requests</a>
            <a href="./unsuccessfulA.php" class="navLink"><i class="fas fa-file-xmark"></i>Unsuccessful Requests</a>
            <a href="#" class="navLink active"><i class="fas fa-users"></i>All Users</a>
        </nav>

        <nav>
            <a href="./logout.php" class="navLink"><i class="fas fa-sign-out"></i>Logout</a>
        </nav>
    </section>

    <section class="main">

        <header>
            <h3 class="headerTitle">Request Tracker Admin Center</h3>
            <div class="profile" onclick="toggle()">
                <div class="profilePic">
                    <img src="./assets/profilePicture/<?php echo $userData['pp']; ?>" alt="">
                </div>
                <h3><?php echo $userData['username'] ?></h3>
                <i class="fas fa-caret-down"></i>
            </div>
        </header>

        <div class="subSectionTitle">
            <h4>All Users</h4>
        </div>

        <div class="tableContainer">

            <table>

                <thead>
                    <tr>
                        <th class="name">Name</th>
                        <th class="department">Department</th>
                        <th class="description">Email</th>
                        <th class="time"></th>
                        <th class="status"></th>
                    </tr>
                </thead>
                <?php
                if ($allUsers && mysqli_num_rows($allUsers) > 0) {
                ?>
                    <tbody>
                        <?php
                        while ($result = mysqli_fetch_assoc($allUsers)) {
                            $fn = $result['firstName'];
                            $ln = $result['lastName'];
                            $name = $fn . ' ' . $ln;
                            $department = $result['department'];
                        ?>
                            <tr>
                                <td><?php echo $name ?></td>
                                <td><?php echo $department ?></td>
                                <td><?php echo $result['email'] ?></td>
                                <td><a onclick="toggleUser(name='<?php echo $name; ?>', email='<?php echo $result['email'] ?>', department='<?php echo $department; ?>', image='<?php echo $result['pp']; ?>')">View User</a></td>
                                <td><a onclick="toggleReset(name='<?php echo $name; ?>',email='<?php echo $result['email'] ?>')">Reset Password</a></td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                <?php
                } else {
                ?>
                    <div class="empty">
                        <div class="icon-cont">
                            <img src="./assets/iconS/empty_icon.png" alt="">
                        </div>
                        <p>There is nothing here yet</p>
                    </div>
                <?php
                }
                ?>
            </table>

        </div>

        <footer>
            <p>Wayoe Engineering and Constructions Limited - ICT</p>
        </footer <!-- dropdown -->

        <div class="profileDropdown">
            <div class="dProfilePicture">
                <img src="./assets/profilePicture/<?php echo $userData['pp'] ?>" alt="">
            </div>
            <div class="profileInfo">
                <p><?php echo $fullName ?></p>
                <span><?php echo $userData['email'] ?></span>
                <a href="./manageAccount.php">My Account</a>
            </div>
            <a href="./logout.php" class="logout">Logout</a>
        </div>

        <!-- reset Password -->

        <form class="reset" id="reset" action="./php/resetUserPass.php" method="POST">
            <i class="fal fa-times close" onclick="toggleReset()"></i>
            <h2 class="title">Reset Password</h2>
            <p style="margin-bottom: 5px;">You are about to reset the password for <br> <span id="nameSpan"></span></p>
            <p>On clicking <b>Reset</b> a link wil be sent via email to <span id="emailSpan"></span> <br> allowing
                the user to create a new password.
            </p>
            <input type="hidden" id="sendEmail" name="email">
            <button type="submit" name="send">Reset</button>
        </form>

    </section>

    <section class="allusers active" id="allUsers">

        <div class="flyout">

            <i class="fas fa-times" onclick="toggleUser()"></i>

            <div class="userProfile">
                <img src="" id="userProfile" alt="" />
            </div>

            <h1 class="userName" id="userName"></h1>


        </div>

    </section>


    <!-- scripts -->
    <script src="./js/toggle.js"></script>

</body>

</html>