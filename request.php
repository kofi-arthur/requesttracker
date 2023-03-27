<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Tracker - Place Request</title>
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/request.css">
</head>

<body>

    <section class="sideNav">
        <div class="logo">
            <img src="./assets/logo.png" alt="">
        </div>

        <nav>
            <a href="#" class="navLink"><i class="fas fa-home"></i>Home</a>
            <a href="./pendingA.php" class="navLink"><i class="fas fa-file-chart-column"></i>Pending Requests</a>
            <a href="./completedA.php" class="navLink"><i class="fas fa-file-check"></i>Completed Requests</a>
            <a href="./unsuccessfulA.php" class="navLink"><i class="fas fa-file-xmark"></i>Unsuccessful Requests</a>
        </nav>

        <nav>
            <a href="./php/logout.php" class="navLink"><i class="fas fa-sign-out"></i>Logout</a>
        </nav>
    </section>

    <section class="main">

        <header>
            <h3 class="headerTitle">Request Tracker</h3>
            <div class="profile" onclick="toggle()">
                <div class="profilePic">
                    <img src="./assets/user.jpg" alt="">
                </div>
                <h3>John</h3>
                <i class="fas fa-caret-down"></i>
            </div>
        </header>

        <div class="request-wrapper">

            <form action="#" method="post">

                <div class="field">
                    <label for="category">Category</label>
                    <select name="category" id="category">
                        <option value="Hardware">Hardware</option>
                        <option value="Network">Network</option>
                        <option value="Software">Software</option>
                    </select>
                </div>

                <div class="field">
                    <label for="description">Describe</label>
                    <textarea name="description" id="description" cols="30" rows="10"></textarea>
                </div>

            </form>

        </div>

        <footer>
            <p>Wayoe Engineering and Constructions Limited - IT</p>
        </footer>

        <!-- dropdown -->

        <div class="profileDropdown">
            <div class="dProfilePicture">
                <img src="./assets/user.jpg" alt="">
            </div>
            <div class="profileInfo">
                <p>John Doe</p>
                <span>johndoe@wayoeltd.com</span>
                <a href="./manageAccountC.php">My Account</a>
            </div>
            <a href="./php/logout.php" class="logout">Logout</a>
        </div>

    </section>


    <!-- scripts -->
    <script src="./js/toggle.js"></script>

</body>

</html>