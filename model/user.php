<?php
require_once("database.php");

class User extends Database {
    private $email;
    private $password;

    public function test(){
        $db = $this->connect();
        $sql = "SELECT * FROM admin";

        $result = $db->query($sql);

        print_r($result);
    }
}
?>