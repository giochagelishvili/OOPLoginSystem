<?php

if(isset($_POST["logout"])) {
    // Destroy session
    session_start();
    session_unset();
    session_destroy();

    // Redirect user to homepage
    header("location: ../index.php?error=none");
}