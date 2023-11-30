<?php
require_once("database.php");

class Category extends Database {
    // Attributes
    private $id;
    private $name;
    private $parentCategory; // Default is null
    private $isActive; // Default is true

    // Constructor
    public function __construct($id, $name, $parentCategory = null, $isActive = true) {
        $this->id = $id;
        $this->name = $name;
        $this->parentCategory = $parentCategory;
        $this->isActive = $isActive;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setParentCategory($parentCategory) {
        $this->parentCategory = $parentCategory;
    }

    public function setIsActive($isActive) {
        $this->isActive = $isActive;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getParentCategory() {
        return $this->parentCategory;
    }

    public function getIsActive() {
        return $this->isActive;
    }

    // Methods
    public static function getParentCategories($onlyActives = true) {
        try {
            $db = Category::connect();
            $sql = "SELECT * FROM category WHERE parentCategory IS NULL AND isActive = ?";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $onlyActives, PDO::PARAM_BOOL);
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $categories;
        } catch (PDOException $e) {
            //echo "Error: " . $e->getMessage();
            return null;
        }

    }
    public function getAllCategories()
    {
        $db = Category::connect();

        // Consulta recursiva para obtener todas las categorías y subcategorías
        $categories = $this->getCategoriesRecursively($db, null);

        return $categories;
    }

    public function getCategoriesRecursively($db, $parentCategory) {
        $sql = "SELECT * FROM category WHERE parentCategory " . ($parentCategory === null ? "IS NULL" : "= :parentCategory");
        $stmt = $db->prepare($sql);

        if ($parentCategory !== null) {
            $stmt->bindParam(':parentCategory', $parentCategory, PDO::PARAM_INT);
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = array();

        foreach ($result as $row) {
            $subcategories = $this->getCategoriesRecursively($db, $row['id']);
            $row['subcategories'] = $subcategories;
            $categories[] = $row;
        }

        return $categories;
    }

    public static function getDefaultId(){
        try {
            $db = Category::connect();
        
            $sql = "SELECT COALESCE(MAX(id), 0)+1 AS max_id FROM category";
            $stmt = $db->prepare($sql);
            $stmt->execute();
        
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $maxId = $result['max_id'];
        
            return $maxId;
        } catch (PDOException $e) {
            //echo "Error: " . $e->getMessage();
            return null;
        }
        
    }

    public function insertInDB() {
        $db = Category::connect();
        $sql = "INSERT INTO category (name, parentCategory, isActive) VALUES (?, ?, true)";
        $stmt = $db->prepare($sql);
        $name = $this->getName();
        $stmt->bindParam(1, $name, PDO::PARAM_STR);
    
        // Create a variable to hold null and pass it by reference
        $nullValue = null;
        if ($this->getParentCategory() !== null && $this->getParentCategory() !== "") {
            $parentCategory = $this->getParentCategory();
            $stmt->bindParam(2, $parentCategory, PDO::PARAM_STR);
        } else {
            $stmt->bindParam(2, $nullValue, PDO::PARAM_NULL);
        }
    
        $stmt->execute();
    }
    
}

?>