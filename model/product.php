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
        $connection = self::connect();
    
        // Escapar y sanear los datos antes de usarlos en la consulta (para prevenir inyección SQL)
        $id = $connection->quote($this->getId());
        $name = $connection->quote($this->getName());
        $description = $connection->quote($this->getDescription());
        $id_category = $connection->quote($this->getCategory());
        $price = $connection->quote($this->getPrice());
        $stock = $connection->quote($this->getStock());
        
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
    

    public static function getAllProducts($onlyActives = false, $filters = null) {
        // Ahora lo de los filtros no tiene uso, pero lo usaré en otra cosa
        $db = Product::connect();
        if($filters != null){
            // Action if comes with filters
            $search = $filters["elementToSearch"];
            // Checks if element to search is empty or spaces
            if (preg_match('/^\s*$/', $search)) $search = "";
            
            $sql = "
            SELECT
                p.id AS product_id,
                p.name AS product_name,
                p.description AS product_description,
                p.id_category AS product_id_category,
                p.img AS product_img,
                p.price AS product_price,
                p.stock AS product_stock,
                p.featured AS product_featured,
                p.isActive AS product_isActive,
                c.name AS category_name
            FROM
                product p
            JOIN
                category c ON p.id_category = c.id
            WHERE
                ( LOWER(p.name) LIKE :pname OR LOWER(c.name) LIKE :pname)
            ";
            // AÑADIR LOWER(p.id) LIKE :id OR dentro de los parentesis
            foreach ($filters as $key => $value) {
                if ($key != "elementToSearch") {
                    $sql .= " AND $key = :$key";
                }
            }

            $stmt = $db->prepare($sql);
            $searchWithPercent = "%" . $search . "%";
            //$stmt->bindParam(':id', $searchWithPercent, PDO::PARAM_STR);
            $stmt->bindParam(':pname', $searchWithPercent, PDO::PARAM_STR);

            foreach ($filters as $key => $value) {
                if ($key != "elementToSearch") {
                    $stmt->bindParam(":$key", $value, PDO::PARAM_STR);
                }
            }

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $productsArray = [];
            foreach ($result as $key => $product) {
                $featured = $product["product_featured"] == null ? false : true;
                $active = $product["product_isactive"] == null ? false : true;
                $newProduct = new Product($product["product_id"], $product["product_name"], $product["product_description"], $product["product_id_category"], $product["product_img"], $product["product_price"], $product["product_stock"], $featured, $active);
                $productsArray[] = $newProduct;
            }
        } else{
            //Action if doesnt come with filters
            if($onlyActives) $sql = "SELECT * FROM product WHERE isActive = true";
            else $sql = "SELECT * FROM product";
            
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
        }

        return $productsArray;
    }

    public static function fetchProducts(array $filters = []){
        /* 
            Example of $filters array application
            $filters = [
                'user_id' => 456,
                'status' => 'shipped',
                'startDate' => '2023-10-01',
                'endDate' => '2023-10-15',
            ];
            $records = Product::fetchPurchases($filters);
        */

        //Connect into the database
        $db = self::connect();
        
        //SQL basic query, we'll modify it later if needed
        $sql = "SELECT * FROM product";

        //This code creates a dynamic SQL query based on the filters given by the parameters
        if(!empty($filters)){
            $sql .= " WHERE ";
            // $i is started in 1 because the first clause will be always WHERE not AND
            $i = 1;
            foreach($filters as $field => $value){
                $sql .= "$field = ? ";
                if($i < count($filters)){
                    $sql .= " AND ";
                }
                $i++;
            }

        }

        //Here the SQL query prepares and bind the given parameters on its values to execute the filters
        $statement = $db->prepare($sql);

        if(!empty($filters)){
            $i = 1;
            foreach($filters as $value){
                $statement->bindValue($i++, $value);
            }
        }

        $statement->execute();

        // Adds into the purchases array every purchase the SQL returned
        $products = [];
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $products[] = new Product($row['id'], $row['name'], $row['description'], $row['id_category'], $row['img'], $row['price'], $row['stock'], $row['featured']);
        }
        return $products;
    }

    public function toggleStatus(){
        $id = $this->getId();
        $status = $this->getIsActive();
    
        $db = self::connect();
        $sql = $status ? "UPDATE product SET isactive = false WHERE id = ?" : "UPDATE product SET isactive = true WHERE id = ?";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }    
}
?>
