<?php
require_once("./model/user.php");
class UserController {
    public function showLoginForm(){
        include("./view/login/login.html");
    }

    public function login(){
        if(!empty($_POST)){
            $user = new User($_POST['email'], $_POST['password']);
            $user->checkLogin();
        } else {
            echo "no";
        }
    }
}
?>