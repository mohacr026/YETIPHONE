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
    private $isActive;

    //Constructor
    public function __construct($email, $password, $phoneNumber = null, $name, $surname, $direction = null, $isActive = true){
        $this->email = $email;
        $this->password = $password;
        $this->phoneNumber = $phoneNumber;
        $this->name = $name;
        $this->surname = $surname;
        $this->direction = $direction;
        $this->isActive = $isActive;
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
    
    public function getIsActive(){
        return $this->isActive;
    }
    public function setIsActive($isActive){
        $this->isActive = $isActive;
    }

    //Class methods
    public function checkLogin(){
        $db = User::connect();

        $sql = "SELECT * FROM admin";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $exists = false;
        $passOK = false;
        $isAdmin = false;
        // TODO: Falta comprobar si el user esta activo o no

        foreach ($result as $key => $adminArr) {
            if($this->getEmail() == $adminArr['username'] && $exists == false) {
                $exists = true;

                if(md5($this->getPassword()) == $adminArr['pass']) {
                    $passOK = true;
                    $isAdmin = true;
                    $_SESSION['email'] = $adminArr['username'];
                }
            }
        }

        $sql = "SELECT * FROM usuarios";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $key => $userArr) {
            if($this->getEmail() == $userArr['email'] && $exists == false) {
                $exists = true;

                if(md5($this->getPassword()) == $userArr['password']) {
                    $passOK = true;

                    $_SESSION['email'] = $userArr['email'];
                    $_SESSION['name'] = $userArr['name'];
                }
            }
        }

        if($exists) {
            if($passOK) {
                if($isAdmin) return "loginAdm";
                else return "login";
            }
            else return "badPass";
        } else return "noUser";
    }

    //Static methods
    public static function register(){

    }
}
?>