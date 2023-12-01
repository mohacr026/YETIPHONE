<?php
require_once("./model/category.php");
class CategoryController{
    public function showAddCategories(){
        $defaultId = Category::getDefaultId();
        if($defaultId == null) $defaultId = 1;
        $parentCategories = Category::getParentCategories();
        if($parentCategories == null) {
            $parentCategories = array();
        }
        include("./view/adminCategory/addCategory.php");
        if(isset($_GET['insertOk'])) {
            echo "<script src='./src/js/popups/popupInsertOk.js'></script>";
        }
    }

    public function showEditCategories(){
        $category = new Category("", "");
        $categoriesArray = $category->getAllCategories();
        
        include("./view/adminCategory/editCategoryMenu.php");
    }

    public function registerCategory(){
        if(!empty($_POST)){
            if(isset($_POST['showParent']) && ($_POST['parent'] != "nothing")){
                $category = new Category($_POST['categoryId'], $_POST['name'], $_POST['parent']);
            } else {
                $category = new Category($_POST['categoryId'], $_POST['name']);
            }
            $category->insertInDB();
    
            echo "<META HTTP-EQUIV='REFRESH' CONTENT=1; URL=index.php?controller=Category&action=showAddCategories&insertOK=true>";
        } else {
            echo "<META HTTP-EQUIV='REFRESH' CONTENT=1; URL=index.php?controller=Category&action=showAddCategories>";
        }
    }
}
?>