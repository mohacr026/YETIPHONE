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
    private $storage;
    private $memory;
    private $colors;
    private $stock;
    private $featured;
    private $isActive;

    // Constructor
    public function __construct($id, $name, $description, $category, $image, $price, $storage, $memory, $colors, $stock, $featured, $isActive){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->image = $image;
        $this->price = $price;
        $this->storage = $storage;
        $this->memory = $memory;
        $this->colors = $colors;
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

    public function getStorage(){
        return $this->storage;
    }

    public function setStorage($storage) {
        $this->storage = $storage;
    }

    public function getMemory() {
        return $this->memory;
    }

    public function setMemory($memory) {
        $this->memory = $memory;
    }

    public function getColors() {
        return $this->colors;
    }

    public function setColors($colors) {
        $this->colors = $colors;
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

    // Metodos
    public static function insertProducts(array $data = []){
        //Connect into the database
        $db = self::connect();
        
        //SQL basic query, we'll modify it later if needed
        $sql = "INSERT INTO product";

        $columns = array_keys($data);
        $values = [];

        foreach($data as $value){
            $values[] = $value;
        }
        
        //This code creates a dynamic SQL query based on the filters given by the parameters
        if(!empty($data)){

            $valuesWithQuotes = [];
            foreach ($values as $value) {
                if (is_string($value)) {
                    $valuesWithQuotes[] = "'" . $value . "'";
                } else {
                    $valuesWithQuotes[] = $value;
                }
            }

            $sql .= "(". implode(', ', $columns).") VALUES(". implode(', ', $valuesWithQuotes).")";

            //Here the SQL query prepares and bind the given parameters on its values to execute the filters
            $statement = $db->prepare($sql);
    
            $result = $statement->execute();
        }

        return $result;
    }

    public static function insertImages(array $images = [], $product_id){
        //Connect into the database
        $db = self::connect();

        if(!empty($images)){
            foreach($images as $image){
                $sql = "INSERT INTO product_image (img, product_id) VALUES('$image', '$product_id');";

                $statement = $db->prepare($sql);

                $statement->execute();
            }
        }
    }

    public static function insertColors($colors, $product_id){
        //Connect into the database
        $db = self::connect();

        $colors = str_replace(" ", "", $colors);
        $colors = explode(",", $colors);

        if(!empty($colors)){
            foreach($colors as $color){
                $sql = "INSERT INTO colors (product_id, color_code) VALUES('$product_id', '$color');";

                $statement = $db->prepare($sql);

                $statement->execute();
            }
        }
    }
    
    public static function updateColors($colors, $product_id){
        //Connect into the database
        $db = self::connect();

        $sql = "DELETE FROM colors WHERE product_id = :id";
        $statement = $db->prepare($sql);
        $statement->bindValue(":id", $product_id);
        $statement->execute();

        self::insertColors($colors, $product_id);
    }

    public static function generateProductID($categoryName, $productName, $categoryID) {
        // Get the first two letters of the category name
        $categoryPrefix = strtoupper(substr($categoryName, 0, 2));
       
        // Get desired number based on how many products have the same category 
        $db = self::connect();
        // Query the database to get the count of products in the same category
        $sql = "SELECT COUNT(*) as count FROM product WHERE id_category = :category";
        
        $statement = $db->prepare($sql);
        $statement->bindValue(":category", $categoryID);

        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
       
        // Increment the count by 1 and format it as a three-digit number
        $productCount = str_pad($result['count'] + 1, 3, '0', STR_PAD_LEFT);
       
        // Get the first two letters of the product name
        $productPrefix = strtoupper(substr($productName, 0, 2));
       
        // Combine the prefixes and the product count to form the final ID
        $productID = $categoryPrefix . $productCount . $productPrefix;
       
        return $productID;
    }

    public static function fetchProductImages($productId, $parsed = true){
        // Connect into database
        $db = self::connect();

        // SQL to execute the query
        $sql = "SELECT * FROM product_image WHERE product_id = :id";
        
        $statement = $db->prepare($sql);
        $statement->bindValue(":id", $productId);

        $statement->execute();
        $images = [];
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            if($parsed){
                $images[] = $row['img'];
            } else {
                $images[] = $row;
            }
        }
        return $images;
    }

    public static function fetchProductColors($productId){
        // Connect into database
        $db = self::connect();

        // SQL to execute the query
        $sql = "SELECT * FROM colors WHERE product_id = :id";
        
        $statement = $db->prepare($sql);
        $statement->bindValue(":id", $productId);

        $statement->execute();
        $colors = [];
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $colors[] = $row['color_code'];
        }
        return $colors;
    }

    public static function updateProducts(array $fields = [], $productId){
        //Connect into the database
        $db = self::connect();
        
        //SQL basic query, we'll modify it later if needed
        $sql = "UPDATE product";

        //This code creates a dynamic SQL query based on the fields given by the parameters
        if(!empty($fields)){
            $sql .= " SET ";
            // $i is started in 1 because the first clause will be always WHERE not ,
            $i = 1;
            foreach($fields as $field => $value){
                $sql .= "$field = ? ";
                if($i < count($fields)){
                    $sql .= ", ";
                }
                $i++;
            }
            $sql .= " WHERE id = ?";
        }

        //Here the SQL query prepares and bind the given parameters on its values to execute the filters
        $statement = $db->prepare($sql);

        if(!empty($fields)){
            $i = 1;
            foreach($fields as $value){
                $statement->bindValue($i++, $value);
            }
            $statement->bindValue($i++, $productId);
        }

        $result = $statement->execute();

        return $result;
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
            $images = self::fetchProductImages($row['id']);
            $colors = self::fetchProductColors($row['id']);
            $products[] = new Product($row['id'], $row['name'], $row['description'], $row['id_category'], $images, $row['price'], $row['storage'], $row['memory'], $colors, $row['stock'], $row['featured'], $row['isactive']);
        }
        return $products;
    }

    public static function deleteImages($images){
        $db = self::connect();

        $query = "DELETE FROM product_image WHERE img IN ('".implode("', '", $images)."')";
        // Delete the image from the database
        $statement = $db->prepare($query);
        $statement->execute();
        foreach($images as $image) {    
            // Delete the image file from the server
            $filePath = "./src/img/products/" . $image;
            if(file_exists($filePath)) {
                unlink($filePath);
            }
        }
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

    public static function searchProducts($toSearch){
        $db = self::connect();
        $sql = "SELECT *, (SELECT i.img FROM product_image i WHERE i.product_id=p.id LIMIT 1) as img
        FROM product p
        WHERE LOWER(p.name) LIKE :name";
        $stmt = $db->prepare($sql);
        $search = "%" . strtolower($toSearch) . "%";
        $stmt->bindParam(':name', $search);
        $stmt->execute();
        
        $productsAsoc = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $productsJson = [];
        foreach ($productsAsoc as $key => $value) {
            $active = $value['isactive'] == "" ? "false" : "true";
            $featured = $value['featured'] == "" ? "false" : "true";
            $json = array(
                "productId" => $value['id'],
                "name" => $value['name'],
                "id_category" => $value['id_category'],
                "img" => "./src/img/products/" . $value['img'],
                "price" => $value['price'],
                "stock" => $value['stock'],
                "storage" => $value['storage'],
                "memory" => $value['memory'],
                "isActive" => $active,
                "isFeatured" => $featured
            );
            $productsJson[] = $json;
        }

        return $productsJson;
    }

    public static function getProductStock($productId){
        $db = self::connect();
        $sql = "SELECT id, stock FROM product WHERE id= :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $productId);
        $stmt->execute();

        $stockAsoc = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stockJSON = [];
        foreach ($stockAsoc as $key => $value) {
            $json = array(
                "stock" => $value['stock'],
            );
            $stockJSON[] = $json;
        }

        return $stockJSON;
    }
}
?>
