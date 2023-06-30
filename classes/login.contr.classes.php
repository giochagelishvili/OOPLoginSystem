<?php

class LoginContr extends Login {
    private $uid; // Username
    private $pwd; // Password

    public function __construct($uid, $pwd) {
        $this->uid = $uid;
        $this->pwd = $pwd;
    }

    public function loginUser() {
        // In case of empty inputs redirect user to the homepage and exit the program
        if ($this->emptyInput() == false) {
            // Empty input
            header("location: ../index.php?error=emptyinput");
            exit();
        }

        // Log in the user
        $this->getUser($this->uid, $this->pwd);
    }

    // Returns false if any input is empty
    private function emptyInput() {
        $result = true;

        if (empty($this->uid) || empty($this->pwd)) {
            $result = false;
        }

        return $result;
    }
}