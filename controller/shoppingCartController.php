<?php
require_once("./model/shoppingCart.php");
class ShoppingCartController {
    public function getUserCart(){
        $email = $_REQUEST['email'];
        $lastCart = ShoppingCart::getUserCartFromDatabase($email);

        print_r($lastCart);
    }
}
?>