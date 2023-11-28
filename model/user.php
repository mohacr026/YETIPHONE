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

    // Getter for email
    public function getEmail() {
        return $this->email;
    }

    // Setter for email
    public function setEmail($email) {
        $this->email = $email;
    }

    // Getter for password
    public function getPassword() {
        return $this->password;
    }

    // Setter for password
    public function setPassword($password) {
        $this->password = $password;
    }

    public function test(){
        $db = $this->connect();
        $sql = "SELECT * FROM admin";

        $result = $db->query($sql);

        print_r($result);
    }

    public function checkLogin(){
        $db = $this->connect();

        $sql = "SELECT * FROM admin";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $exists = false;
        $passOK = false;

        foreach ($result as $key => $adminArr) {
            if($this->getEmail() == $adminArr['username'] && $exists == false) {
                $exists = true;

                if(md5($this->getPassword()) == $adminArr['pass']) {
                    $passOK = true;

                    $_SESSION['email'] = $adminArr['username'];
                }
            }
        }

        $sql = "SELECT * FROM usuarios";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $key => $adminArr) {
            if($this->getEmail() == $adminArr['email'] && $exists == false) {
                $exists = true;

                if(md5($this->getPassword()) == $adminArr['password']) {
                    $passOK = true;

                    $_SESSION['email'] = $adminArr['email'];
                }
            }
        }

        if($exists) {
            echo "existe";
            if($passOK) echo "pass ok";
            else echo "pass no ok";
        }
        else {
            echo "no existe";
            
        }
    }
}
?>