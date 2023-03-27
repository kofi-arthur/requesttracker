<?php

session_start();

if (isset($_SESSION['userEmail'])) {
    sleep(1);
    unset($_SESSION['userEmail']);
    header("Location: ../index.php");
}

header("Location: ../index.php");
