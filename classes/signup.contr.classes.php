<?php

class SignupContr extends Signup {

    private $uid; // Username
    private $pwd; // Password
    private $pwdrepeat; // Repeat Password
    private $email; // Email

    public function __construct($uid, $pwd, $pwdrepeat, $email) {
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdrepeat = $pwdrepeat;
        $this->email = $email;
    }

    public function signupUser() {
        // Check for empty input
        if ($this->emptyInput() == false) {
            header("location: ../index.php?error=emptyinput");
            exit();
        }

        // Check for invalid username
        if ($this->invalidUid() == false) {
            header("location: ../index.php?error=username");
            exit();
        }

        // Check for invalid email
        if ($this->invalidEmail() == false) {
            header("location: ../index.php?error=email");
            exit();
        }

        // Check if passwords match
        if ($this->pwdMatch() == false) {
            header("location: ../index.php?error=passwordmatch");
            exit();
        }

        // Check if email or username is already taken
        if ($this->uidTakenCheck() == false) {
            header("location: ../index.php?error=useroremailtaken");
            exit();
        }

        // Add user to the database
        $this->setUser($this->uid, $this->pwd, $this->email);
    }

    // Returns false if any input is empty
    private function emptyInput() {
        $result = true;

        if(empty($this->uid) || empty($this->pwd) || empty($this->pwdrepeat) || empty($this->email)) {
            $result = false;
        }

        return $result;
    }

    // Returns false if username is invalid
    private function invalidUid() {
        $result = true;

        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)) {
            $result = false;
        }

        return $result;
    }

    // Returns false if email is invalid
    private function invalidEmail() {
        $result = true;

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        }

        return $result;
    }

    // Returns false if Password and Repeat Password don't match
    private function pwdMatch() {
        $result = true;

        if ($this->pwd !== $this->pwdrepeat) {
            $result = false;
        }

        return $result;
    }

    // Returns false if username or email is already taken
    private function uidTakenCheck() {
        $result = true;

        if (!$this->checkUser($this->uid, $this->email)) {
            $result = false;
        }

        return $result;
    }

}