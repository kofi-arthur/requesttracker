<?php

session_start();

include './php/connect.php';
include './php/functionuser.php';

$userData = checkLoginUser($conn);

$firstname = $userData['firstName'];
$lastName = $userData['lastName'];
$useremail = $userData['email'];

$fullname = "$firstname $lastName";

// fetch all requests from the database
$fetchAll = mysqli_query($conn, "SELECT * FROM `completedrequest` WHERE `email` = '$useremail'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Tracker - Completed Requests</title>
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/empty.css">
    <link rel="stylesheet" href="./css/table.css">
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="./css/deatils.css">
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
        <div class="logo">
            <img src="./assets/logo.png" alt="">
        </div>

        <nav>
            <a href="./index.php" class="navLink"><i class="fas fa-home"></i>Home</a>
            <a href="./pending.php" class="navLink"><i class="fas fa-file-chart-column"></i>Pending Requests</a>
            <a href="#" class="navLink active"><i class="fas fa-file-check"></i>Completed Requests</a>
            <a href="./unsuccessful.php" class="navLink"><i class="fas fa-file-xmark"></i>Unsuccessful Requests</a>
        </nav>

        <nav>
            <a href="logout.php" class="navLink"><i class="fas fa-sign-out"></i>Logout</a>
        </nav>
    </section>

    <section class="main">

        <header>
            <h3 class="headerTitle">Request Tracker</h3>
            <div class="profile" onclick="toggle()">
                <div class="profilePic">
                    <img src="./assets/profilePicture/<?php echo $userData['pp'] ?>" alt="">
                </div>
                <h3><?php echo $userData['firstName'] ?></h3>
                <i class="fas fa-caret-down"></i>
            </div>
        </header>

        <div class="subSectionTitle">
            <h4>Completed Requests</h4>
        </div>

        <div class="tableContainer">

            <table>

                <thead>
                    <tr>
                        <th class="name">Name</th>
                        <th class="department">Department</th>
                        <th class="category">Category</th>
                        <th class="description">Description</th>
                        <th class="time">Time</th>
                        <th class="status">Status</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                    if ($fetchAll && mysqli_num_rows($fetchAll) > 0) {
                        while ($result = mysqli_fetch_assoc($fetchAll)) {
                    ?>
                            <tr onclick="window.location.href='./php/CpopUpC.php?orderID=<?php echo $result['id'] ?>'">
                                <td><?php echo $result['name'] ?></td>
                                <td><?php echo $result['department'] ?></td>
                                <td><?php echo $result['category'] ?></td>
                                <td class="info"><?php echo $result['description'] ?></td>
                                <td><?php echo $result['time'] ?></td>
                                <td><?php echo $result['status'] ?></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <div class="empty">
                            <div class="icon-cont">
                                <img src="./assets/iconS/empty_icon.png" alt="">
                            </div>
                            <p>There is nothing here yet</p>
                        </div>
                    <?php
                    }
                    ?>
                </tbody>

            </table>

        </div>

        <footer>
            <p>Wayoe Engineering and Constructions Limited - IT</p>
        </footer>

        <!-- dropdown -->

        <div class="profileDropdown">
            <div class="dProfilePicture">
                <img src="./assets/profilePicture/<?php echo $userData['pp'] ?>" alt="">
            </div>
            <div class="profileInfo">
                <p><?php echo $fullname ?></p>
                <span><?php echo $userData['email'] ?></span>
                <a href="./manageAccountC.php">My Account</a>
            </div>
            <a href="./logout.php" class="logout">Logout</a>
        </div>

    </section>

    <!-- scripts -->

    <script src="./js/toggle.js"></script>
</body>

</html>