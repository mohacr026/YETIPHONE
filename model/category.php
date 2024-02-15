<?php
require_once("database.php");

/**
 * Class Category - Represents a category entity.
 */
class Category extends Database {
    // Attributes
    /** @var int $id The category's ID. */
    private $id;
    /** @var string $name The category's name. */
    private $name;
    /** @var int|null $parentCategory The parent category's ID. */
    private $parentCategory; // Default is null
    /** @var bool $isActive Indicates if the category is active or not. */
    private $isActive; // Default is true

    // Constructor
    /**
     * Category constructor.
     * @param int $id The category's ID.
     * @param string $name The category's name.
     * @param int|null $parentCategory The parent category's ID. (Optional)
     * @param bool $isActive Indicates if the category is active or not. (Optional, default is true)
     */
    public function __construct($id, $name, $parentCategory = null, $isActive = true) {
        $this->id = $id;
        $this->name = $name;
        $this->parentCategory = $parentCategory;
        $this->isActive = $isActive;
    }

    // Setters
    /**
     * Set the category's ID.
     * @param int $id The category's ID.
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * Set the category's name.
     * @param string $name The category's name.
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Set the parent category's ID.
     * @param int|null $parentCategory The parent category's ID.
     */
    public function setParentCategory($parentCategory) {
        $this->parentCategory = $parentCategory;
    }

    /**
     * Set whether the category is active or not.
     * @param bool $isActive Indicates if the category is active or not.
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;
    }

    // Getters
    /**
     * Get the category's ID.
     * @return int The category's ID.
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get the category's name.
     * @return string The category's name.
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Get the parent category's ID.
     * @return int|null The parent category's ID.
     */
    public function getParentCategory() {
        return $this->parentCategory;
    }

    /**
     * Get whether the category is active or not.
     * @return bool Indicates if the category is active or not.
     */
    public function getIsActive() {
        return $this->isActive;
    }

    // Methods
    /**
     * Get parent categories from the database.
     * @param bool $onlyActives Indicates whether to fetch only active parent categories. (Optional, default is true)
     * @return array|null An array of parent categories.
     */
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

    /**
     * Get all categories from the database.
     * @return array An array of Category objects.
     */
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

    /**
     * Get subcategories from the database.
     * @return array|null An array of subcategories.
     */
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
            return null;
            // Manejar el error según tus necesidades
            // Por ejemplo: throw new Exception("Error fetching subcategories: " . $e->getMessage());
        }
    }
       

    /**
     * Get the default ID for a new category.
     * @return int|null The default ID for a new category.
     */
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

    /**
     * Get a category by its ID.
     * @param int $id The ID of the category to fetch.
     * @return Category|null The category object if found, else null.
     */
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

    /**
     * Update the category's name in the database.
     */
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
    
    /**
     * Toggle the status (active/inactive) of the category in the database.
     */
    public function toggleStatus(){
        $id = $this->getId();
        $status = $this->getIsActive();
    
        $db = self::connect();
        $sql = $status ? "UPDATE category SET isactive = false WHERE id = ?" : "UPDATE category SET isactive = true WHERE id = ?";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }    
    
    /**
     * Fetch categories from the database based on given filters.
     * @param array $filters An array containing filters for the query.
     * @return array An array of Category objects matching the filters.
     */
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