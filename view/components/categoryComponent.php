<?php
class CategoryComponent {
    private $__category;
    private $__subcategories;

    public function __construct($category, $subcategories){
        $this->__category = $category;
        $this->__subcategories = $subcategories;
    }

    public function render(){
        $categoryName = $this->__category->getName();
        $categoryId = $this->__category->getId();
        echo "<div class='categoryComponent'>";
        echo "<h3>$categoryName <a href='index.php?controller=Category&action=editCategory&id=$categoryId'>Edit</a>  <a>Disable</a></h3>";
        if(!empty($this->__subcategories)){
            echo "<div class='subcategoriesContainer'>";
            foreach ($this->__subcategories as $subcategory) {
                echo "<p>{$subcategory['name']} <a href='index.php?controller=Category&action=editCategory&id={$subcategory['id']}'>Edit</a>  <a>Disable</a></p>";
            }
            echo "</div>";
        }
        
        echo "</div>";
    }
    
}
?>