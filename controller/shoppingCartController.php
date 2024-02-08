<?php
require_once("./model/shoppingCart.php");
class ShoppingCartController {
    public function getUserCart(){
        $email = $_REQUEST['email'];
        $lastCart = ShoppingCart::getUserCartFromDatabase($email);

        print_r($lastCart);
    }

    public function saveUserCart(){
        $email = $_REQUEST['email'];
        $lastCart = $_REQUEST['cart'];

        ShoppingCart::uploadUserCartToDatabase($email, $lastCart);

        print_r($lastCart);
    }

    public function viewCart(){
        include("./view/cart/shoppingCart.php");
    }

    public function goToPayment(){
        if(!isset($_SESSION['email'])){
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=User&action=showLoginForm'>";
        } else {
            include("./view/cart/paymentResume.php");
        }
    }
}
?>