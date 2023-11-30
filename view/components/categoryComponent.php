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
        
        echo "<div class='categoryComponent'>";
        echo "<h3>$categoryName</h3>";
        if(!empty($this->__subcategories)){
            echo "<div>";
            foreach ($this->__subcategories as $subcategory) {
                echo "<p>{$subcategory['name']}</p>";
            }
            echo "</div>";
        }
        
        echo "</div>";
    }
    
}
?>