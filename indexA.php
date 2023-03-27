<?php

session_start();

include './php/connect.php';
include './php/functionadmin.php';

$userData = checkLogin($conn);


$firstname = $userData['firstName'];
$lastName = $userData['lastName'];

$fullName = "$firstname $lastName";

// fetch all requests from the database
$pendingRequest = mysqli_query($conn, "SELECT * FROM `pendingrequest` ORDER BY `time` DESC LIMIT 4");
$prCount = mysqli_query($conn, "SELECT COUNT(*) FROM pendingrequest;");
$prResult = mysqli_fetch_assoc($prCount);

$crCount = mysqli_query($conn, "SELECT COUNT(*) FROM completedrequest;");
$crResult = mysqli_fetch_assoc($crCount);

$urCount = mysqli_query($conn, "SELECT COUNT(*) FROM unsuccessfulrequest;");
$urResult = mysqli_fetch_assoc($urCount);

$noPr = $prResult['COUNT(*)'];
$noCr = $crResult['COUNT(*)'];
$noUr = $urResult['COUNT(*)'];
$noTr = $noPr + $noCr + $noUr;

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
    <link rel="stylesheet" href="./css/empty.css">
</head>

<body>

    <section class="sideNav">
        <a class="logo" href="#">
            <img src="./assets/logo.png" alt="">
        </a>

        <nav>
            <a href="#" class="navLink active"><i class="fas fa-grid-2"></i>Dashboard</a>
            <a href="./pendingA.php" class="navLink"><i class="fas fa-file-chart-column"></i>Pending Requests</a>
            <a href="./completedA.php" class="navLink"><i class="fas fa-file-check"></i>Completed Requests</a>
            <a href="./unsuccessfulA.php" class="navLink"><i class="fas fa-file-xmark"></i>Unsuccessful Requests</a>
            <a href="./allUsers.php" class="navLink"><i class="fas fa-users"></i>All Users</a>
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
                    <img src="./assets/profilePicture/<?php echo $userData['pp'] ?>" alt="">
                </div>
                <h3>Admin</h3>
                <i class="fas fa-caret-down"></i>
            </div>
        </header>

        <div class="dashboard">

            <div class="piechart">
                <h3 class="title">Overall Statistics</h3>
                <div class="chartContainer">
                    <div class="keys">
                        <div class="key">
                            <div class="diagram">
                                <!-- <i class="fas fa-square blue"></i> -->
                                <p>Total Requests</p>
                            </div>
                            <span><?php echo $noTr; ?></span>
                        </div>
                        <div class="key">
                            <div class="diagram">
                                <i class="fas fa-square yellow"></i>
                                <p>Pending Requests</p>
                            </div>
                            <span><?php echo $noPr; ?></span>
                        </div>
                        <div class="key">
                            <div class="diagram">
                                <i class="fas fa-square green"></i>
                                <p>Completed Requests</p>
                            </div>
                            <span><?php echo $noCr; ?></span>
                        </div>
                        <div class="key">
                            <div class="diagram">
                                <i class="fas fa-square red"></i>
                                <p>Unsuccessful Requests</p>
                            </div>
                            <span><?php echo $noUr; ?></span>
                        </div>
                    </div>
                    <div class="charti">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="grids">
                <div class="grid">
                    <div class="grid-top">
                        <i class="fal fa-files"></i>
                        <h4>Total Requests</h4>
                    </div>
                    <h1><?php echo $noTr; ?></h1>
                </div>
                <a href="./pendingA.php" class="grid">
                    <div class="grid-top">
                        <i class="fal fa-file-chart-column"></i>
                        <h4>Pending Requests</h4>
                    </div>
                    <h1><?php echo $noPr; ?></h1>
                </a>
                <a href="./completedA.php" class="grid">
                    <div class="grid-top">
                        <i class="fal fa-file-check"></i>
                        <h4>Completed Requests</h4>
                    </div>
                    <h1><?php echo $noCr; ?></h1>
                </a>
                <a href="./unsuccessfulA.php" class="grid">
                    <div class="grid-top">
                        <i class="fal fa-file-xmark"></i>
                        <h4>Unsuccessful Requests</h4>
                    </div>
                    <h1><?php echo $noUr; ?></h1>
                </a>
            </div>

        </div>

        <div class="subSectionTitle">
            <h4>Recent Requests</h4>
            <a href="./pendingA.php">See All</a>
        </div>

        <div class="tableContainerSub">

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
                    if ($pendingRequest && mysqli_num_rows($pendingRequest) > 0) {
                        while ($pendingResult = mysqli_fetch_assoc($pendingRequest)) {
                    ?>
                            <tr>
                                <td><?php echo $pendingResult['name'] ?></td>
                                <td><?php echo $pendingResult['department'] ?></td>
                                <td><?php echo $pendingResult['category'] ?></td>
                                <td class="info"><?php echo $pendingResult['description'] ?></td>
                                <td><?php echo $pendingResult['time'] ?></td>
                                <td><?php echo $pendingResult['status'] ?></td>
                            </tr>
                        <?php
                        }
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
                <p><?php echo $fullName ?></p>
                <span><?php echo $userData['email'] ?></span>
                <a href="./manageAccount.php">My Account</a>
            </div>
            <a href="./logout.php" class="logout">Logout</a>
        </div>

    </section>


    <!-- scripts -->
    <script src="./js/toggle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <?php
    if ($noTr > 0) {
    ?>
        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'pie',
                data: {
                    // labels: ['Total Requests', 'Pending Request', 'Completed Requests', 'Unsucessful Requests'],
                    datasets: [{
                        data: [0, <?php echo $noPr; ?>, <?php echo $noCr; ?>, <?php echo $noUr; ?>],
                        backgroundColor: ['#0077ff', '#ff9900', 'limegreen', 'crimson'],
                        cutout: '60%',
                    }]
                },
                options: {
                    responsive: true,
                }
            });
        </script>
    <?php
    } else {
    ?>
        <script>
            const pct = document.getElementById('myChart');

            new Chart(pct, {
                type: 'pie',
                data: {
                    // labels: ['Total Requests', 'Pending Request', 'Completed Requests', 'Unsucessful Requests'],
                    datasets: [{
                        data: [0, 25, 25, 25],
                        backgroundColor: ['#aaa', '#aaa', '#bbb', '#ddd'],
                        cutout: '60%',
                    }]
                },
                options: {
                    tooltips: {
                        display: false,
                    },
                    responsive: true,
                }
            });
        </script>
    <?php
    }
    ?>

</body>

</html>