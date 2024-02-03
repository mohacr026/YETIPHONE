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
        $categoriesArray = Category::getParentCategories(false);
        $subCategoriesArray = Category::getSubCategories();

        $categoriesJSON = [];
        foreach ($categoriesArray as $key => $category) {
            $state = $category['isactive'] == null ? false : true;
            $subCategories = [];
            foreach ($subCategoriesArray[$category["id"]] as $subcategory) {
                $subCategories[] = array(
                    "id" => $subcategory->getId(),
                    "name" => $subcategory->getName(),
                    "isActive" => $subcategory->getIsActive()
                );
            }
            $categoriesJSON[] = array(
                "id" => $category["id"],
                "name" => $category['name'],
                "subcategories" => $subCategories,
                "isActive" => $state
            );

        }
        $categoriesJsonResult = json_encode($categoriesJSON);

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
    
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=Category&action=showAddCategories&insertOK=true'>";
        } else {
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=Category&action=showAddCategories'>";
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

    public function toggleCategory(){
        if(isset($_GET["id"])){
            $category = Category::getCategoryById($_GET["id"]);

            $category->toggleStatus();
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=Category&action=showEditCategories&insertOK=true'>";
        }
    }

    public function editCategoryPerformed(){
        if(!empty($_POST)){
            $updatedCategory = new Category($_POST['categoryId'], $_POST['name']);
            $updatedCategory->updateCategory();
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=Category&action=showEditCategories&updateOK=true'>";
        } else {
            echo "No";
        }
    }

    public function fetchCategorys(){
        require_once './model/product.php';
        ob_clean();
        header("Content-Type: application/json");

        $categories = Category::fetchCategory();
        $data = array();
        foreach($categories as $category){
            $products = Product::fetchProducts(['id_category' => $category->getId()]);
            array_push($data, ["name" => $category->getName(), "count" => count($products)]);
        }
        echo json_encode(['success' => true, 'info' => $data]);
        exit;
    }
}
?>