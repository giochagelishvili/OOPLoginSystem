<?php

class Login extends Dbh {

    protected function getUser($uid, $pwd) {
        // Prepare SQL query to select user from the database
        $sql = "SELECT users_pwd FROM users WHERE users_uid = ? OR users_email = ?;";
        $stmt = $this->connect()->prepare($sql);

        // If statement fails to execute redirect user to homepage and exit program
        if (!$stmt->execute([$uid, $uid])) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        // Fetch password from the database
        $passwordData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // In case of no data redirect user to homepage and exit program
        if(count($passwordData) == 0) {
            $stmt = null;
            header("location: ../index.php?error=usernotfound");
            exit();
        }

        // Verify the password
        $checkPwd = password_verify($pwd, $passwordData[0]["users_pwd"]);

        // If passwords don't match redirect user to the homepage and exit the program
        if ($checkPwd == false) {
            $stmt = null;
            header("location: ../index.php?error=wrongpassword");
            exit();
        // Else if passwords match
        } elseif ($checkPwd == true) {
            // Prepare SQL statement to select user data from the database
            $sql = "SELECT * FROM users WHERE users_uid = ? OR users_email = ? AND users_pwd = ?;";
            $stmt = $this->connect()->prepare($sql);
            
            // If statement failed to execute redirect user to the homepage and exit the program
            if (!$stmt->execute([$uid, $uid, $passwordData[0]["user_pwd"]])) {
                $stmt = null;
                header("location: ../index.php?error=stmtfailed");
                exit();
            }

            // Fetch user data from the database
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // In case of no data redirect user to the homepage and exit the program
            if(count($user) == 0) {
                $stmt = null;
                header("location: ../index.php?error=usernotfound");
                exit();
            }

            // Start the session for the user
            session_start();
            $_SESSION["userid"] = $user[0]["users_id"];
            $_SESSION["useruid"] = $user[0]["users_uid"];
        }

        // Close connection
        $stmt = null;
    }

}