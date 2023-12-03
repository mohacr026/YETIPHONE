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

    public function showEditProducts(){
        // Verificar si se proporciona un ID de producto
        if (isset($_GET['id'])) {
            $productId = $_GET['id'];
            $product = $this->getProductById($productId);

            if ($product) {
                include("./view/adminProduct/editProduct.php");
            } else {
                echo "Producto no encontrado.";
            }
        } else {
            echo "ID de producto no proporcionado.";
        }
    }

    private function getProductById($productId) {
        $database = new Database();
        $connection = $database->connect();

        $product = $connection->query("SELECT * FROM products WHERE id = $productId")->fetch();

        if ($product) {
            return new Product(
                $product['id'],
                $product['name'],
                $product['description'],
                $product['id_category'],
                $product['image'],
                $product['price'],
                $product['stock'],
                $product['active'],
                $product['featured']
            );
        } else {
            return null;
        }
    }

    public function updateProduct() {
        if (!empty($_POST)) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $id_category = $_POST['category'];
            $stock = $_POST['stock'];

            // Obtener el producto existente de la base de datos
            $existingProduct = $this->getProductById($id);

            if ($existingProduct) {
                // Crear una instancia de la clase Product con los nuevos datos
                $updatedProduct = new Product(
                    $id,
                    $name,
                    $description,
                    $id_category,
                    $existingProduct->getImage(), // Mantener la imagen existente
                    $price,
                    $stock,
                    $existingProduct->getActive(),
                    $existingProduct->getFeatured()
                );

                // Manejar la actualización de la imagen (si se proporciona una nueva)
                $this->uploadImage($updatedProduct);

                // Actualizar el producto en la base de datos
                $updatedProduct->updateProductInDatabase();
            } else {
                echo "Producto no encontrado.";
            }
        } else {
            echo "El formulario no se envió correctamente.";
        }
    }

    public function registerProduct() {
        if (!empty($_POST)) {
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
            $product->insertProductIntoDatabase();
        } else {
            echo "The form was not submitted correctly.";
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
