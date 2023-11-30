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

    // Static methods

    public static function displayAll() {
        // Implementar lógica para mostrar todos los productos
    }

    public static function displayAllFeatured() {
        // Implementar lógica para mostrar todos los productos destacados
    }

    public static function displayAllCategory($category) {
        // Implementar lógica para mostrar todos los productos de una categoría
    }

    public function insertProduct() {
        // Implementar lógica para insertar un producto en la base de datos
    }
}
?>
