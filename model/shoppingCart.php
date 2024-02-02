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
}
?>