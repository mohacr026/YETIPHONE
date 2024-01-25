<?php
require_once("./model/product.php");
require_once("./model/category.php");

class ProductController {
    public function showFrontPageProducts(){
        include("./view/frontPage/frontPage.php");
    }

    public function showInterfaz(){
        $products = Product::fetchProducts(["featured" => "true"]);
    
        include("./view/frontPage/interfaz.php");
    }

    public function showPageProductMobile(){
        $products = Product::fetchProducts(["featured" => "true"]);
    
        include("./view/frontPage/pageProductMobile.php");
    }

    public function showAddProducts(){
        $categories = Category::fetchCategory(["isActive" => "true"]);
        include("./view/adminProduct/addProduct.php");
    }

    public function registerProduct() {
        if (!empty($_POST)) {

            $data["name"] = $_POST["name"];
            $data["description"] = $_POST["description"];
            $data["id_category"] = $_POST["id_category"];
            $data["price"] = $_POST["price"];
            $data["stock"] = $_POST["stock"];
            $data["storage"] = $_POST["storage"];
            $data["memory"] = $_POST["memory"];
            $data["isactive"] = "true";
            $data["featured"] = "false";

            $categoryName = Category::fetchCategory(["id" => $data["id_category"]])[0];
            $data["id"] = Product::generateProductID($categoryName->getName() ,$data["name"], $data["id_category"]);

            Product::insertProducts($data);
            
            $images = [];

            // Loop through each uploaded file
            foreach ($_FILES["img"]["tmp_name"] as $key => $tmp_name) {
                $timestamp = time();
                $image_name = $data['id']."-$timestamp.png";
                $image_tmp = $_FILES["img"]["tmp_name"][$key];
                
                // Move the uploaded file to a desired location
                $destination = "./src/img/products/" . $image_name;
                move_uploaded_file($image_tmp, $destination);
                
                $images[] = $image_name;
            }

            Product::insertImages($images, $data["id"]);
            Product::insertColors($_POST["colors"], $data["id"]);

            $categories = Category::fetchCategory(["isActive" => "true"]);
            include("./view/adminProduct/addProduct.php");
        } else {
            echo "The form was not submitted correctly.";
        }
    }
    

    public function showEditProducts() {
        // Obtener la lista de productos desde la base de datos
        $productsArray = Product::fetchProducts();
        $categoriesArray = Category::getAllCategories();
        
        $productsJSON = [];
        foreach ($productsArray as $product) {
            $productsJSON[] = array(
                "id" => $product->getId(),
                "name" => $product->getName(),
                "description" => $product->getDescription(),
                "id_category" => $product->getCategory(),
                "img" => $product->getImage(),
                "price" => $product->getPrice(),
                "stock" => $product->getStock(),
                "featured" => $product->getFeatured(),
                "isActive" => $product->getIsActive()
            );
        }
        $categoriesJSON = [];
        foreach ($categoriesArray as $category) {
            $categoriesJSON[] = array(
                "id" => $category->getId(),
                "name" => $category->getName()
            );
        }

        $productsJsonResult = json_encode($productsJSON);
        $categoriesJsonResult = json_encode($categoriesJSON);
        // Incluir la vista de la lista de productos
        include("./view/adminProduct/editProductMenu.php");
    }
    

    public function editProduct(){
        // Verificar si se proporciona un ID de producto
        // var_dump($_GET);  // Muestra toda la información en $_GET
        if (isset($_GET['id'])) {
            $productId = $_GET['id'];
            $product = Product::fetchProducts(['id' => $productId])[0];
            $productImages = Product::fetchProductImages($product->getId(), false);
            $categoriesArray = Category::getAllCategories();
            include("./view/adminProduct/editProduct.php");
        } else {
            echo "ID de producto no proporcionado.";
        }
    }

    public function editProductPerformed() {
        
    }

    public function updateProduct() {
        try {
            if (!empty($_POST)) {
                // Validar datos (agrega validaciones según sea necesario)
    
                $id = $_POST['id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $id_category = $_POST['category'];
                $stock = $_POST['stock'];
    
                // Obtener el producto existente de la base de datos
                $existingProduct = Product::fetchProducts(['id' => $id]);
                $existingProduct = $existingProduct[0];
                if ($existingProduct) {
                    // Crear una instancia de la clase Product con los nuevos datos
                    $updatedProduct = new Product(
                        $id,
                        $name,
                        $description,
                        $id_category,
                        // $existingProduct->getImage(),
                        $price,
                        $stock,
                        $existingProduct->getIsActive(),
                        $existingProduct->getFeatured()
                    );
    
                    // Manejar la actualización de la imagen (si se proporciona una nueva)
                    // $this->uploadImage($updatedProduct);
    
                    // Actualizar el producto en la base de datos
                    $updatedProduct->updateProducts();
                    echo "Producto actualizado correctamente.";
                } else {
                    echo "Producto no encontrado.";
                }
            } else {
                echo "El formulario no se envió correctamente.";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    

    public function showActDesc() {
        // Verificar si se proporciona un ID de producto
        if (isset($_GET['id'])) {
            $productId = $_GET['id'];
            
            // Obtener el producto existente de la base de datos
            $existingProducts = Product::getProductById($productId);
    
            if (!empty($existingProducts)) {
                foreach ($existingProducts as $existingProduct) {
                    // Cambiar el estado del producto
                    $newStatus = !$existingProduct->getIsActive(); // Invertir el estado actual
                    $existingProduct->setIsActive($newStatus);
    
                    // Actualizar el producto en la base de datos
                    $existingProduct->updateProducts();
                }
    
                // Redirigir a la página de productos
                header("Location: index.php?controller=Product&action=showEditProducts");
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
    
    public function toggleProduct(){
        if(isset($_GET["id"])){
            $product = Product::getProductById($_GET["id"]);
            
            $product[0]->toggleStatus();
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=Product&action=showEditProducts&insertOK=true'>";
        }
    }
  
    public function showProducts(){
        if(isset($_GET['category'])){
            $categoria = Category::fetchCategory(['id' => $_GET['category']])[0];
            
            if($categoria->getParentCategory() == NULL) {
                $products = Product::fetchProducts(['id_category' => $categoria->getId() ]);
                include "./view/product/productByParentCategory.php";
            } else {
                $products = Product::fetchProducts(['id_category' => $categoria->getId() ]);
                include "./view/product/productByCategory.php";
            }
        }
    }

    public function showProductPage(){
        if(isset($_GET['product'])){
            $product = unserialize(urldecode($_GET['product']));
            $categoria = Category::getCategoryById($product->getCategory());
            include("./view/product/productPage.php");
        } else if(isset($_GET['id'])) {
            $product = Product::fetchProducts(['id' => $_GET['id']])[0];
            $categoria = Category::getCategoryById($product->getCategory());
            include("./view/product/productPage.php");
        } else {
            if(isset($_GET['category'])){
                echo"<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=index.php?controller=Product&action=showProducts&category='".$_GET['category']."'";
            } else {
                echo"<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=index.php?controller=Product&action=showInterfaz";
            }
        }
    }
    public function searchProducts(){
        if(isset($_REQUEST['toSearch'])){
            $JSON = Product::searchProducts($_REQUEST['toSearch']);
            header("Content-Type: application/json");
            $productsJSON = json_encode($JSON);
            echo "$productsJSON";
        }
    }
}

?>
