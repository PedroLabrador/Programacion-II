<?php
    session_start();
    include '../includes/config.php';

    if (isset($_SESSION['userID'])) {
        unset($_SESSION['userID']);
        unset($_SESSION['userName']);
        header ("Location: login.php");
    } else {
        header ("Location: ../index.php");
    }
