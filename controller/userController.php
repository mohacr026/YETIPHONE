<?php
require_once("./model/user.php");
require_once("./model/category.php");
class UserController {

    public function showLoginForm(){
        include("./view/login/login.html");
    }
    public function showRegisterForm(){
        include("./view/frontPage/register.php");
    }

    public function login(){
        if(!empty($_POST)){
            $user = new User("", $_POST['email'], $_POST['password'], "", "", "", "");
            $action = $user->checkLogin();

            switch ($action) {
                case 'login':
                    $email = $_SESSION['email'];
                    echo "<div id='email' data-email='$email'></div>";
                    echo "<script type='module' src='./src/js/logUser.js'></script>";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php'>";
                    break;
                
                case 'loginAdm':
                    $email = $_SESSION['email'];
                    echo "<div id='email' data-email='$email'></div>";
                    echo "<script type='module' src='./src/js/logUser.js'></script>";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=User&action=showAdminDashboard'>";
                    break;
                
                case 'badPass':
                    include("./view/login/login.html");
                    break;

                case 'noUser':
                    
                default:
                    include("./view/login/login.html");
                    break;
            }
        } else {
            echo "no post";
        }
    }

    public function logout(){
        echo "<script>
        sessionStorage.clear();
        </script>";
        session_destroy();
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php'>";
    }

    public function showAdminDashboard(){
        $categories = Category::fetchCategory(["isactive" => "true"]);
        include("./view/frontPage/adminMenu.php");
    }

    public function register(){
        if(!empty($_POST)){
            $data["dni"] = $_POST["dni"];
            $data["email"] = $_POST["email"];
            $data["password"] = md5($_POST["password"]);
            $confirmPassword = md5($_POST["confirmPassword"]);
            $data["phone_number"] = $_POST["phoneNumber"];
            $data["username"] = $_POST["name"];
            $data["surname"] = $_POST["surname"];
            $data["direction"] = $_POST["direction"];
            $data["isactive"] = "true";

            try {
                User::register($data);
                $categories = Category::fetchCategory(["isactive" => "true"]);
                include("./view/login/login.html");
            } catch(Exception $e) {
                $error = "The registration form failed, please, use valid credentials.";
                $categories = Category::fetchCategory(["isactive" => "true"]);
                include("./view/frontPage/register.php");
            }
            
        } else {
            $error = "The registration form failed, please, try again later.";
        }
    }
}
?>