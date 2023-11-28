<?php
require_once("database.php");
require_once("../controller/productController.php");
class Product extends Database {
    //Attributes
    private $id;
    private $name;
    private $description;
    private $category;
    private $image;
    private $price;
    private $stock;
    private $featured;

    //Constructor
    public function __construct($id, $name, $description, $category, $image, $price, $stock, $featured){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->image = $image;
        $this->price = $price;
        $this->stock = $stock;
        $this->featured = $featured;
    }

    //Static methods
    public static function displayAll(){
        
    }
    public static function displayAllFeatured(){
        
    }
    public static function displayAllCategory($category){

    }
}
?>