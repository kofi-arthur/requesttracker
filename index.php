<?php

session_start();

include './php/connect.php';
include './php/functionuser.php';

$userData = checkLoginUser($conn);

$firstname = $userData['firstName'];
$lastname = $userData['lastName'];
$useremail = $userData['email'];

$fullname = "$firstname $lastname";

$fetchpendingData = mysqli_query($conn, "SELECT * FROM pendingrequest WHERE `email` = '$useremail' ORDER BY `time` DESC LIMIT 4;");

$fetchpending = mysqli_query($conn, "SELECT COUNT(*) from `pendingrequest` WHERE `email` = '$useremail';");
$pResult = mysqli_fetch_assoc($fetchpending);

$fetchcompleted = mysqli_query($conn, "SELECT COUNT(*) from `completedrequest` WHERE `email` = '$useremail';");
$cResult = mysqli_fetch_assoc($fetchcompleted);

$fetchunsuccessful = mysqli_query($conn, "SELECT COUNT(*) from `unsuccessfulrequest` WHERE `email` = '$useremail';");
$uResult = mysqli_fetch_assoc($fetchunsuccessful);

$noP = $pResult['COUNT(*)'];
$noC = $cResult['COUNT(*)'];
$noU = $uResult['COUNT(*)'];
$noTr = $noP + $noC + $noU;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Tracker - Home</title>
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="./css/empty.css">
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
            <a href="#" class="navLink active"><i class="fas fa-home"></i>Home</a>
            <a href="./pending.php" class="navLink"><i class="fas fa-file-chart-column"></i>Pending Requests</a>
            <a href="./completed.php" class="navLink"><i class="fas fa-file-check"></i>Completed Requests</a>
            <a href="./unsuccessful.php" class="navLink"><i class="fas fa-file-xmark"></i>Unsuccessful Requests</a>
        </nav>

        <nav>
            <a href="./logout.php" class="navLink"><i class="fas fa-sign-out"></i>Logout</a>
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

        <div class="cardContainer">
            <div class="cards">
                <div class="top">
                    <i class="fal fa-files"></i>
                    <span>Total Requests</span>
                </div>
                <span class="number" id="c1"></span>
            </div>
            <a href="./pending.php" class="cards">
                <div class="top">
                    <i class="fal fa-file-chart-column"></i>
                    <span>Pending Requests</span>
                </div>
                <span class="number" id="c2"></span>
            </a>
            <a href="./completed.php" class="cards">
                <div class="top">
                    <i class="fal fa-file-check"></i>
                    <span>Completed Requests</span>
                </div>
                <span class="number" id="c3"></span>
            </a>
            <a href="./unsuccessful.php" class="cards">
                <div class="top">
                    <i class="fal fa-file-xmark"></i>
                    <span>Unsuccessful Requests</span>
                </div>
                <span class="number" id="c4"></span>
            </a>
        </div>

        <div class="request">
            <a href="./request.php" class="requestButton">
                <i class="fas fa-plus"></i>
                <p>Place Request</p>
            </a>
        </div>

        <div class="subSectionTitle">
            <h4>Recent Pending Requests</h4>
            <a href="./pending.php">See All</a>
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
                    if ($fetchpendingData && mysqli_num_rows($fetchpendingData) > 0) {
                        while ($pendingResult = mysqli_fetch_assoc($fetchpendingData)) {
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'pie',
            data: {
                // labels: ['Total Requests', 'Pending Request', 'Completed Requests', 'Unsucessful Requests'],
                datasets: [{
                    data: [0, <?php echo $pendingRequest; ?>, <?php echo $completedRequest; ?>, <?php echo $unsuccessfulRequest; ?>],
                    backgroundColor: ['#0077ff', '#ff9900', 'limegreen', 'crimson'],
                    cutout: '60%',
                }]
            },
            options: {
                responsive: true,
            }
        });
    </script>

    <script>
        let counts = setInterval(updated);
        let countss = setInterval(updatedd);
        let countsss = setInterval(updateddd);
        let countssss = setInterval(updatedddd);
        let upto = -1;
        let uptoo = -1;
        let uptooo = -1;
        let uptoooo = -1;

        function updated() {
            var count = document.getElementById("c1");
            count.innerHTML = ++upto;
            if (upto === <?php echo $noTr ?>) {
                clearInterval(counts);
            }
        }

        function updatedd() {
            var countt = document.getElementById("c2");
            countt.innerHTML = ++uptoo;
            if (uptoo === <?php echo $noP; ?>) {
                clearInterval(countss);
            }
        }

        function updateddd() {
            var counttt = document.getElementById("c3");
            counttt.innerHTML = ++uptooo;
            if (uptooo === <?php echo $noC; ?>) {
                clearInterval(countsss);
            }
        }

        function updatedddd() {
            var countttt = document.getElementById("c4");
            countttt.innerHTML = ++uptoooo;
            if (uptoooo === <?php echo $noU; ?>) {
                clearInterval(countssss);
            }
        }
    </script>

</body>

</html>