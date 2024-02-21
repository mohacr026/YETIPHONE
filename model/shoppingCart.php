<?php
require_once("database.php");

class ShoppingCart extends Database{
    private $email;
    private $cart;

    public function __construct($email, $cart) {
        $this->email = $email;
        $this->cart = $cart;
    }

    public static function getUserCartFromDatabase($email) {
        $db = self::connect();
        $sql = "SELECT * FROM userCarts WHERE email = :email";
        $statement = $db->prepare($sql);
        $statement->bindValue(":email", $email);

        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function uploadUserCartToDatabase($email, $cart) {
        $db = self::connect();
    
        // Check if the usercart exists
        $selectSql = "SELECT * FROM usercarts WHERE email = :email";
        $selectStatement = $db->prepare($selectSql);
        $selectStatement->bindParam(":email", $email);
        $selectStatement->execute();
    
        if ($selectStatement->rowCount() > 0) {
            // Update the existing usercart
            $updateSql = "UPDATE usercarts SET lastcart = :cart WHERE email = :email";
            $updateStatement = $db->prepare($updateSql);
            $updateStatement->bindParam(':cart', $cart);
            $updateStatement->bindParam(':email', $email);
            $updateStatement->execute();
        } else {
            // Insert a new usercart
            $insertSql = "INSERT INTO usercarts (email, lastcart) VALUES (:email, :cart)";
            $insertStatement = $db->prepare($insertSql);
            $insertStatement->bindParam(':email', $email);
            $insertStatement->bindParam(':cart', $cart);
            $insertStatement->execute();
        }
    
        // Retrieve the updated/inserted usercart
        $selectStatement->execute();
        $result = $selectStatement->fetch(PDO::FETCH_ASSOC);
    
        return $result;
    }    

    public static function removeUserCartFromDB($user){
        $sql = "DELETE FROM usercarts WHERE email = :user";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":user", $user);
        $stmt->execute();
    }
}
?>