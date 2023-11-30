<?php
require_once("./model/category.php");
class CategoryController{
    public function showAddCategories(){
        $parentCategories = Category::getParentCategories();
        if($parentCategories == null) {
            $parentCategories = array();
        }
        include("./view/adminCategory/addCategory.php");
    }
}
?>