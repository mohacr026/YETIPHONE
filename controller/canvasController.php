<?php 

require_once './model/database.php';
require_once("./model/category.php");

class CanvasController {
    public function signature(){
        $categories = Category::fetchCategory(["isactive" => "true"]);
        include("./view/adminSignature/adminSignature.php");
    }
}

?>