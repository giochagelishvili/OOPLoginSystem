<?php

class Signup extends Dbh {

    protected function checkUser($uid, $email) {
        // Prepare SQL statement to select username from database
        $sql = "SELECT users_uid FROM users WHERE users_uid = ? OR users_email = ?;";
        $stmt = $this->connect()->prepare($sql);
        
        // If statement fails to execute redirect user to the homepage and exit the program
        if (!$stmt->execute([$uid, $email])) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        // Initialize resultCheck variable
        $resultCheck = true;

        // Fetch user data from the database
        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // If statement returns data it means that username or email is already taken and function will return false
        if (count($userData) > 0) {
            $resultCheck = false;
        }

        // Return result
        return $resultCheck;
    }

    // Adds the user to the database
    protected function setUser($uid, $pwd, $email) {
        // Prepare statement to insert user data inside of users table
        $sql = "INSERT INTO users(users_uid, users_pwd, users_email) VALUES (?, ?, ?);";
        $stmt = $this->connect()->prepare($sql);

        // Hash the password
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        // If statement fails to execute redirect user to the homepage and exit the program
        if (!$stmt->execute([$uid, $hashedPwd, $email])) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        // Close connection
        $stmt = null;
    }

}