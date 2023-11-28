<?php
require_once("database.php");
require_once("../controller/UserController.php");
class User extends Database {
    private $email;
    private $password;

    function test(){
        $db = $this->conectar();
        $sql = "SELECT * FROM admin";
    }
}
?>