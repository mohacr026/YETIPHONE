<?php
class CategoryComponent {
    private $__category;
    private $__subcategories;

    public function __construct($category, $subcategories = []){
        $this->__category = $category;
        $this->__subcategories = $subcategories;
    }

    public function render($tabindex){
        $categoryName = $this->__category->getName();
        $categoryId = $this->__category->getId();
        $categoryStatus = $this->__category->getIsActive();
        echo "<div class='categoryComponent'>";
        echo "  <div class='category'>";
        echo "  <p class='categoryName'>$categoryName</p>";
        echo "  <a href='index.php?controller=Category&action=editCategory&id=$categoryId' tabindex='".$tabindex++."'>Edit</a>";
        $stateMessage = $categoryStatus ? "Disable" : "Enable";
        echo "  <a href='index.php?controller=Category&action=toggleCategory&id=$categoryId' tabindex='".$tabindex++."'>$stateMessage</a>";
        echo "</div>";

        if(!empty($this->__subcategories)){
            echo "<div class='subcategoriesContainer'>";
                foreach ($this->__subcategories as $key => $value) {
                    $subName = $value->getName();
                    $subId = $value->getId();
                    $subStatus = $value->getIsActive();
                    echo "<div class='subcategory'>";
                    echo "  <p class='subcategoryName'>$subName</p>";
                    echo "  <a href='index.php?controller=Category&action=editCategory&id=$subId' tabindex='".$tabindex++."'>Edit</a>";
                    $subMessage = $subStatus ? "Disable" : "Enable";
                    echo "  <a href='index.php?controller=Category&action=toggleCategory&id=$subId' tabindex='".$tabindex++."'>$subMessage</a>";
                    echo "</div>";
                }
            echo "</div>";
        }
        
        echo "</div>";
    }
    
}
?>