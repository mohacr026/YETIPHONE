<?php
require_once("database.php");
require_once("../controller/UserController.php");
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
    public function __construct($email, $password, $phoneNumber, $name, $surname, $direction, $state){
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
    public function login(){

    }

    //Static methods
    public static function register(){

    }
}
?>