<?php
require_once("./model/shoppingCart.php");
require_once("./model/purchase.php");
require_once("./model/product.php");
require_once("./model/category.php");

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
        $categories = Category::fetchCategory(["isactive" => "true"]);
        include("./view/cart/shoppingCart.php");
    }

    public function goToPayment(){
        if(!isset($_SESSION['email'])){
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=User&action=showLoginForm'>";
        } else {
            $categories = Category::fetchCategory(["isactive" => "true"]);
            include("./view/cart/paymentResume.php");
        }
    }

    public function purchase(){
        if(isset($_POST['user'])){
            $cart = json_decode($_POST['cart']);
            $errors = false;
            $idArray = [];
            $quantityArray = [];
            foreach ($cart as $key => $product) {
                $id = $product->product;
                $idArray[] = $id;
                $quantity = $product->quantity;
                $quantityArray[] = $quantity;
                $stock = Product::getProductStock($id);
                $stock = $stock[0]['stock'];
                if($stock - $quantity < 0){
                    $errors = true;
                }
            }

            if(!$errors){
                Product::decreaseProductsStock($idArray, $quantityArray);
                $details = [];
                for ($i=0; $i < count($idArray); $i++) { 
                    $details[] = [$idArray[$i], $quantityArray[$i]];
                }
                Purchase::insertPurchase($_POST['user'], $_POST['direction'], $_POST['province'],$_POST['city'], $_POST['zipCode'], $details);
                ShoppingCart::removeUserCartFromDB($_POST['user']);
                echo "<script src='./src/js/deleteCart.js'></script>";
                echo("<meta http-equiv='refresh' content='0;url=index.php'>");
            } else {
                echo("<meta http-equiv='refresh' content='0;url=index.php?controller=ShoppingCart&action=viewCart&error'>");
            }
        }
    }
}
?>