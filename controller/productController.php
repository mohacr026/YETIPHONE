<?php
class ProductController {
    public function showFrontPageProducts(){
        include("./view/frontPage/frontPage.php");
    }

    public function showAddProducts(){
        include("./view/adminProduct/addProduct.php");
    }
    public function registreProduct(){
        // instancia producto de todos los datos del post
        //metodo insertar o crear
    }
}
?>