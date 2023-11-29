<?php
require_once("database.php");

class User extends Database {
    //Attributes
    private $email;
    private $password;
    private $phoneNumber;
    private $name;
    private $surname;
    private $direction;
    private $state;

    //Constructor
    public function __construct($email, $password, $phoneNumber = null, $name, $surname, $direction = null, $state = true){
        $this->email = $email;
        $this->password = $password;
        $this->phoneNumber = $phoneNumber;
        $this->name = $name;
        $this->surname = $surname;
        $this->direction = $direction;
        $this->state = $state;
    }

    //Setters & Getters
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }

    public function getPassword(){
        return $this->password;
    }
    public function setPassword($password){
        $this->password = $password;
    }

    public function getPhoneNumber(){
        return $this->phoneNumber;
    }
    public function setPhoneNumber($phoneNumber){
        $this->phoneNumber = $phoneNumber;
    }

    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
    }

    public function getSurname(){
        return $this->surname;
    }
    public function setSurname($surname){
        $this->surname = $surname;
    }

    public function getDirection(){
        return $this->direction;
    }
    public function setDirection($direction){
        $this->direction = $direction;
    }
    
    public function getState(){
        return $this->state;
    }
    public function setState($state){
        $this->state = $state;
    }

    //Class methods
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

    //Static methods
    public static function register(){

    }
}
?>