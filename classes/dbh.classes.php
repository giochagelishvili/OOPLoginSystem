<?php

class Dbh {

    // Connects to the database
    protected function connect() {
        try {
            // Connect to the database
            $username = "root";
            $password = "";
            $dbh = new PDO('mysql:host=localhost;dbname=ooplogin', $username, $password);
            return $dbh;
        } catch (PDOException $e) {
            // Print out the error
            print "Error!: " . $e->getMessage() . "<br />";
            die();
        }
    }

}