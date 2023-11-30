<?php
require_once("./model/product.php");
require_once("./model/database.php");  // Make sure to include the Database class file

class ProductController {
    public function showFrontPageProducts(){
        include("./view/frontPage/frontPage.php");
    }

    public function showAddProducts(){
        include("./view/adminProduct/addProduct.php");
    }

    public function registerProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];

            // instancia 
            $product = new Product(null, $name, $description, null, null, null, null, null, true);
            $this->insertProductIntoDatabase($product);
        } else {
            echo "The form was not submitted correctly.";
        }
    }

    private function insertProductIntoDatabase(Product $product) {
        $name = $product->getName();
        $description = $product->getDescription();
    
        $db = Database::connect();  
    
        if (!$db) {
            echo "Error connecting to the database.";
            return;
        }

        try {
            $query = "INSERT INTO product (name, description) VALUES (:name, :description)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $result = $stmt->execute();

            if ($result) {
                echo "Product successfully registered in the database.";
            } else {
                echo "Error registering the product in the database.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            $db = null;
        }
    }
}
?>
