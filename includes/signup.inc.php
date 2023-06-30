<?php

if (isset($_POST["submit"])) {

    // Grabbing the data
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $email = $_POST["email"];

    // Include classes
    include("../classes/dbh.classes.php");
    include("../classes/signup.classes.php");
    include("../classes/signup.contr.classes.php");

    // Running error handlers and user signup
    $signup = new SignupContr($uid, $pwd, $pwdRepeat, $email);
    $signup->signupUser();

    // Redirect user to the homepage
    header("location: ../index.php?error=none");
}