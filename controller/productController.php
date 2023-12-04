<?php
require_once("./model/product.php");
require_once("./model/database.php");

class ProductController {
    public function showFrontPageProducts(){
        include("./view/frontPage/frontPage.php");
    }

    public function showInterfaz(){
        include("./view/frontPage/interfaz.php");
    }

    public function showAddProducts(){
        include("./view/adminProduct/addProduct.php");
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

    public function showProductList() {
        // Obtener la lista de productos desde la base de datos
        $products = $this->getAllProducts();
    
        // Incluir la vista de la lista de productos
        include("./view/adminProduct/productList.php");
    }
    

    public function showEditProduct(){
        // Verificar si se proporciona un ID de producto
        // var_dump($_GET);  // Muestra toda la información en $_GET
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

    public function getAllProducts() {
        $database = new Database();
        $connection = $database->connect();
    
        $products = array();
    
        $result = $connection->query("SELECT * FROM product");
    
        while ($row = $result->fetch()) {
            $product = new Product(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['id_category'],
                $row['price'],
                $row['stock'],
                $row['isactive'],
                $row['featured']
            );
    
            $products[] = $product;
        }
    
        return $products;
    }
    
    private function getProductById($productId) {
        $database = new Database();
        $connection = $database->connect();
    
        $result = $connection->query("SELECT * FROM product WHERE id = $productId");
    
        if ($result && $result->rowCount() > 0) {
            $row = $result->fetch();
    
            return new Product(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['id_category'],
                $row['price'],
                $row['stock'],
                $row['isactive'],
                $row['featured']
            );
        } else {
            return null;
        }
    }

    public function getAllCategories() {
        $database = new Database();
        $connection = $database->connect();
    
        $categories = array();
    
        $result = $connection->query("SELECT * FROM category");
    
        while ($row = $result->fetch()) {
            $category = new Category(
                $row['id'],
                $row['name']
                // Puedes agregar más propiedades según la estructura de tu categoría
            );
    
            $categories[] = $category;
        }
    
        return $categories;
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
                    $existingProduct->getIsActive(),
                    $existingProduct->getFeatured()
                );

                // Manejar la actualización de la imagen (si se proporciona una nueva)
                $this->uploadImage($updatedProduct);

                // Actualizar el producto en la base de datos
                $updatedProduct->updateProducts();
                echo "Producto actualizado correctamente.";
            } else {
                echo "Producto no encontrado.";
            }
        } else {
            echo "El formulario no se envió correctamente.";
        }
    }

    public function showActDesc() {
        // Verificar si se proporciona un ID de producto
        if (isset($_GET['id'])) {
            $productId = $_GET['id'];
            
            // Obtener el producto existente de la base de datos
            $existingProduct = $this->getProductById($productId);
    
            if ($existingProduct) {
                // Cambiar el estado del producto
                $newStatus = !$existingProduct->getIsActive(); // Invertir el estado actual
                $existingProduct->setIsActive($newStatus);
    
                // Actualizar el producto en la base de datos
                $existingProduct->updateProducts();
    
                // Redirigir o mostrar un mensaje, según sea necesario
                header("Location: index.php?controller=Product&action=showProductList");
                exit();
            } else {
                echo "Producto no encontrado.";
            }
        } else {
            echo "ID de producto no proporcionado.";
        }
    }

    public function toggleProductStatus() {
        // Verificar si se proporciona un ID de producto
        if (isset($_GET['id'])) {
            $productId = $_GET['id'];
            
            // Obtener el producto existente de la base de datos
            $existingProduct = $this->getProductById($productId);
    
            if ($existingProduct) {
                // Cambiar el estado del producto
                $newStatus = !$existingProduct->getIsActive(); // Invertir el estado actual
                $existingProduct->setIsActive($newStatus);
    
                // Actualizar el producto en la base de datos
                $existingProduct->updateProductIsActive();
    
                // Redirigir o mostrar un mensaje, según sea necesario
                header("Location: index.php?controller=Product&action=showProductList");
                exit();
            } else {
                echo "Producto no encontrado.";
            }
        } else {
            echo "ID de producto no proporcionado.";
        }
    }
    
    
    
    // Función para actualizar el estado del producto en la base de datos
    private function updateProductStatus($productId, $newStatus) {
        $database = new Database();
        $connection = $database->connect();
    
        // Escapar y sanear los datos antes de usarlos en la consulta (para prevenir inyección SQL)
        $id = $connection->quote($productId);
        $isActive = $connection->quote($newStatus);
    
        // Consulta SQL para actualizar el estado del producto
        $query = "UPDATE product SET isActive = $isActive WHERE id = $id";
    
        // Ejecutar la consulta
        $connection->exec($query);
    }


}


?>
