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
        $categoriesArray = $category->getAllCategoriesAsoc();
        
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

    public function editCategory(){
        if(isset($_GET["id"])){
            $category = Category::getCategoryById($_GET["id"]);
            
            $id = $category->getId();
            $name = $category->getName();
            $parentCategory = $category->getParentCategory();
            
            if($parentCategory != null) $parentCategories = Category::getParentCategories();
            
            $isActive = $category->getIsActive();

            include("./view/adminCategory/editCategory.php");
        } else{
            echo "bad id";
        }
    }

    public function updateCategoryStatus(){
        
    }

    public function editCategoryPerformed(){
        if(!empty($_POST)){
            print_r($_POST);
            if(isset($_POST["parent"])){
                echo "tiene parent";
            } else {
                echo "no tiene parent";
            }
        }
    }
}
?>