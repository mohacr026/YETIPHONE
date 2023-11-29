<?php
require_once("./model/user.php");
class UserController {
    public function showLoginForm(){
        include("./view/login/login.html");
    }


    public function login(){
        if(!empty($_POST)){
            $user = new User($_POST['email'], $_POST['password'], "", "", "", "", "");
            $action = $user->checkLogin();

            switch ($action) {
                case 'login':
                    include("./view/frontPage/frontPage.php");
                    echo "<script>alert('Logueado')</script>";
                    break;
                
                case 'loginAdm':
                    include("./view/frontPage/frontPage.php");
                    echo "<script>alert(Llogueado Admin')</script>";
                    break;
                
                case 'badPass':
                    include("./view/login/login.html");
                    echo "<script>alert('bad pass')</script>";
                    break;

                case 'noUser':
                    
                default:
                    include("./view/login/login.html");
                    echo "<script>alert('bad user')</script>";
                    break;
            }
        } else {
            echo "no post";
        }
    }
}
?>