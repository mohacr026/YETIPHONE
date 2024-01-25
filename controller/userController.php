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
                    break;
                
                case 'loginAdm':
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
        include("./view/frontPage/adminMenu.php");
    }
}
?>