<?php
require_once("./model/product.php");
require_once("./model/database.php");

class ProductController {
    public function showFrontPageProducts(){
        include("./view/frontPage/frontPage.php");
    }

    public function showAddProducts(){
        include("./view/adminProduct/addProduct.php");
    }

    public function showEditProduct(){
         // Assuming you have a way to get the product ID from the URL or form data
         $id = isset($_GET['productId']) ? $_GET['productId'] : null;

         if ($productId) {
             // Retrieve product details for editing
             $product = $this->getProductForEditing($productId);

             if ($product) {
                 // Include the edit product view
                 include("./view/adminProduct/editProduct.php");
             } else {
                 echo "Product not found.";
             }
         } else {
             echo "Product ID not provided.";
         }
    }

    public function registerProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $id_category = $_POST['category'];
            $stock = $_POST['stock'];

            // Create an instance of the Product class
            $product = new Product(null, $name, $description, $id_category, null, $price, $stock, 'false', true);

            // Handle image upload
            $this->uploadImage($product);

            // Insert the product into the database
            $this->insertProductIntoDatabase($product);
        } else {
            echo "The form was not submitted correctly.";
        }
    }

    private function insertProductIntoDatabase(Product $product) {
        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $id_category = $product->getCategory();
        $stock = $product->getStock();
        $isactive = $product->getIsactive();
        $featured = $product->getFeatured();
        $img = $product->getImage();

        $db = Database::connect();  
    
        if (!$db) {
            echo "Error connecting to the database.";
            return;
        }

        try {
            $query = "INSERT INTO product (name, description, price, id_category, stock, isactive, featured, img) VALUES (:name, :description, :price, :id_category, :stock, :isactive, :featured, :image)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':id_category', $id_category);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':isactive', $isactive);
            $stmt->bindParam(':featured', $featured);
            $stmt->bindParam(':image', $img);

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

    private function uploadImage(Product $product) {
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $targetDir = "./src/productImg/";
            $targetFile = $targetDir . uniqid() . '_' . basename($_FILES['image']['name']);

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                echo "File uploaded successfully.";
            } else {
                echo "Error uploading file.";
            }

            $product->setImage($targetFile);
        } else {
            echo "No image uploaded.";
        }
    }
}



?>
