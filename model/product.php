<?php
require_once("database.php");

class Product extends Database {
    // Attributes
    private $id;
    private $name;
    private $description;
    private $category;
    private $image;
    private $price;
    private $stock;
    private $featured;
    private $isActive;

    // Constructor
    public function __construct($id, $name, $description, $category, $image, $price, $stock, $featured, $isActive = true){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->image = $image;
        $this->price = $price;
        $this->stock = $stock;
        $this->featured = $featured;
        $this->isActive = $isActive;
    }

    // Getters and Setters

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getStock() {
        return $this->stock;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function getFeatured() {
        return $this->featured;
    }

    public function setFeatured($featured) {
        $this->featured = $featured;
    }

    public function getIsActive() {
        return $this->isActive;
    }

    public function setIsActive($isActive) {
        $this->isActive = $isActive;
    }

    // Methodos
    public function insertProductIntoDatabase() {
        $name = $this->getName();
        $description = $this->getDescription();
        $price = $this->getPrice();
        $id_category = $this->getCategory();
        $stock = $this->getStock();
        $isactive = $this->getIsactive();
        $featured = $this->getFeatured();
        $img = $this->getImage();

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
    
    public function updateProducts() {
        // Conectar a la base de datos
        $database = new Database();
        $connection = $database->connect();
    
        // Escapar y sanear los datos antes de usarlos en la consulta (para prevenir inyección SQL)
        $id = $connection->quote($this->getId());
        $name = $connection->quote($this->getName());
        $description = $connection->quote($this->getDescription());
        $id_category = $connection->quote($this->getCategory());  // Modificado de getCategoryId() a getCategory()
        $price = $connection->quote($this->getPrice());
        $stock = $connection->quote($this->getStock());
    
        // Consulta SQL para actualizar el producto
        $query = "UPDATE product SET 
                  name = $name,
                  description = $description,
                  id_category = $id_category,
                  price = $price,
                  stock = $stock
                  WHERE id = $id";
    
        // Ejecutar la consulta
        $connection->exec($query);
    }
    
    public function updateProductIsActive() {
        // Conectar a la base de datos
        $database = new Database();
        $connection = $database->connect();
    
        // Obtener el valor booleano de isactive
        $isActiveValue = $this->getIsActive() ? 'true' : 'false';
    
        // Escapar y sanear los datos antes de usarlos en la consulta (para prevenir inyección SQL)
        $id = $connection->quote($this->getId());
        $isActive = $connection->quote($isActiveValue);
    
        // Consulta SQL para actualizar el estado isactive del producto
        $query = "UPDATE product SET isactive = $isActive WHERE id = $id";
    
        // Ejecutar la consulta
        $connection->exec($query);
    }

    public static function getProductById($id){
        $db = Product::connect();
        $sql = "SELECT * FROM product WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $productsArray = [];
        foreach ($result as $key => $product) {
            $featured = $product["featured"] == null ? false : true;
            $active = $product["isactive"] == null ? false : true;
            $newProduct = new Product($product["id"], $product["name"], $product["description"], $product["id_category"], $product["img"], $product["price"], $product["stock"], $product["featured"], $active);
            $productsArray[] = $newProduct;
        }

        return $productsArray;
    }

    public static function getAllProducts() {
        $db = Product::connect();
        $sql = "SELECT * FROM product";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $productsArray = [];
        foreach ($result as $key => $product) {
            $featured = $product["featured"] == null ? false : true;
            $active = $product["isactive"] == null ? false : true;
            $newProduct = new Product($product["id"], $product["name"], $product["description"], $product["id_category"], $product["img"], $product["price"], $product["stock"], $product["featured"], $active);
            $productsArray[] = $newProduct;
        }

        return $productsArray;
    }
}
?>
