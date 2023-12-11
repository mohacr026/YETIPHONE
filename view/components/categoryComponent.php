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
        $categoryStatus = $this->__category->getIsActive();
        echo "<div class='categoryComponent'>";
        echo "  <div class='category'>";
        echo "  <p class='categoryName'>$categoryName</p>";
        echo "  <a href='index.php?controller=Category&action=editCategory&id=$categoryId'>Edit</a>";
        echo "</div>";
        if(!empty($this->__subcategories)){
            echo "<div class='subcategoriesContainer'>";
            foreach ($this->__subcategories as $subcategory) {
                echo "<div class='subcategory'>{$subcategory['name']} <a href='index.php?controller=Category&action=editCategory&id={$subcategory['id']}'>Edit</a>  <a>Disable</a></div>";
            }
            echo "</div>";
        }
        
        echo "</div>";
    }
    
}
?>