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
            
            if($onlyActives) {
                $sql = "SELECT * FROM category WHERE parentCategory IS NULL AND isActive = ?";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(1, $onlyActives, PDO::PARAM_BOOL);
                
            } else {
                $sql = "SELECT * FROM category WHERE parentCategory IS NULL";
                $stmt = $db->prepare($sql);
            }
                        
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $categories;
        } catch (PDOException $e) {
            //echo "Error: " . $e->getMessage();
            return null;
        }

    }

    public static function getAllCategories(){
        $db = Category::connect();
        $sql = "SELECT * FROM category";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categoriesArray = [];

        foreach ($result as $key => $category) {
            $parent = $category['parentcategory'] == null ? null : $category['parentcategory'];
            $active = $category['isactive'] == null ? false : true;
            $newCategory = new Category($category['id'], $category['name'], $parent, $active);

            $categoriesArray[] = $newCategory;
        }

        return $categoriesArray;
    }

    public static function getSubCategories() {
        try {
            $db = self::connect();
        
            // Obtener todas las filas como un array asociativo
            $categoryData = $db->query("SELECT * FROM category WHERE parentcategory IS NULL")->fetchAll(PDO::FETCH_ASSOC);
    
            $subCategoriesArray = [];
            foreach ($categoryData as $value) {
                $subCategoriesArray[$value['id']] = [];
    
                $subCatSQL = "SELECT * FROM category WHERE parentcategory = ?";
                $stmt = $db->prepare($subCatSQL);
                $stmt->execute([$value['id']]);
    
                $subCategoryData = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($subCategoryData as $subValue) {
                    $state = ($subValue !== null);
                    $subCategory = new Category($subValue['id'], $subValue['name'], $subValue['parentcategory'], $state);
    
                    $subCategoriesArray[$value['id']][] = $subCategory;
                }
            }
    
            return $subCategoriesArray;
        } catch (PDOException $e) {
            // Manejar el error según tus necesidades
            // Por ejemplo: throw new Exception("Error fetching subcategories: " . $e->getMessage());
        }
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

    public static function getCategoryById($id) {
        $db = Category::connect();
        $sql = "SELECT * FROM category WHERE id = ?";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_id = $result[0]["id"];
        $_name = $result[0]["name"];
        $_parentCategory = empty($result[0]["parentcategory"]) ? null : $result[0]["parentcategory"];
        $_isActive = $result[0]["isactive"] == 1 ? true : false;
        
        $category = new Category($_id, $_name, $_parentCategory, $_isActive);

        return $category;
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

    public function updateCategory(){
        $db = Category::connect();
        $sql = "UPDATE category SET name = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $name = $this->getName();
        $id = $this->getId();
        $stmt->bindParam(1, $name, PDO::PARAM_STR);
        $stmt->bindParam(2, $id, PDO::PARAM_INT);
    
        $stmt->execute();
    }
    
    public function toggleStatus(){
        $id = $this->getId();
        $status = $this->getIsActive();
    
        $db = self::connect();
        $sql = $status ? "UPDATE category SET isactive = false WHERE id = ?" : "UPDATE category SET isactive = true WHERE id = ?";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }    
    
    public static function fetchCategory(array $filters = []){
        //Connect into the database
        $db = self::connect();
        
        //SQL basic query, we'll modify it later if needed
        $sql = "SELECT * FROM category";

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
        $categories = [];
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $categories[] = new Category($row['id'], $row['name'], $row['parentcategory'], $row['isactive']);
        }
        return $categories;
    }
}

?>