<?php

if (isset($_POST["submit"])) {
    $uid = $_POST["uid"]; // Username
    $pwd = $_POST["pwd"]; // Password

    // Include classes
    include("../classes/dbh.classes.php");
    include("../classes/login.classes.php");
    include("../classes/login.contr.classes.php");

    // Log in the user
    $login = new LoginContr($uid, $pwd);
    $login->loginUser();

    // Redirect user to the homepage
    header("location: ../index.php?error=none");
}