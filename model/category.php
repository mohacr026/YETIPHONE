<?php
require_once("database.php");
require_once("../controller/CategoryController.php");
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
    
}

?>