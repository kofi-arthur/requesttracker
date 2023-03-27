<?php

session_start();

include './php/connect.php';
include './php/functionadmin.php';

$userData = checkLogin($conn);


$firstname = $userData['firstName'];
$lastName = $userData['lastName'];

$fullName = "$firstname $lastName";

$fetchAll = mysqli_query($conn, "SELECT * FROM `unsuccessfulrequest` ORDER BY `time` DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Tracker - Unsuccessful Requests</title>
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/table.css">
    <link rel="stylesheet" href="./css/empty.css">
    <link rel="stylesheet" href="./css/details.css">
    <link rel="stylesheet" href="./css/notification.css">
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
            <a href="#" class="navLink active"><i class="fas fa-file-xmark"></i>Unsuccessful Requests</a>
            <a href="./allUsers.php" class="navLink"><i class="fas fa-users"></i>All Users</a>
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
                    <img src="./assets/profilePicture/<?php echo $userData['pp'] ?>" alt="">
                </div>
                <h3><?php echo $userData['username'] ?></h3>
                <i class="fas fa-caret-down"></i>
            </div>
        </header>

        <div class="subSectionTitle">
            <h4>Unsuccessful Requests</h4>
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
                            <tr onclick="window.location.href='./php/UpopUp.php?orderID=<?php echo $result['id'] ?>'">
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
                    <?php } ?>
                </tbody>

            </table>

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
            <a href="./logout.php" class="logout">Logout</a>
        </div>

    </section>

    <!-- scripts -->

    <script src="./js/disable-request.js"></script>
    <script src="./js/toggle.js"></script>
</body>

</html>