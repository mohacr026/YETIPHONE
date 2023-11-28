<?php
require_once("database.php");

class User extends Database {
    private $email;
    private $password;

    // Constructor 
    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function test(){
        $db = $this->connect();
        $sql = "SELECT * FROM admin";

        $result = $db->query($sql);

        print_r($result);
    }

    public function login(){
        print_r($_POST);
    }
}
?>