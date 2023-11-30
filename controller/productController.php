<?php
class ProductController {
    public function showFrontPageProducts(){
        include("./view/frontPage/frontPage.php");
    }

    public function showAddProducts(){
        include("./view/adminProduct/addProduct.php");
    }

    public function registerProduct() {
        // instancia producto de todos los datos del post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            
            // Insertar el producto en la base de datos
            $query = "INSERT INTO productos (name, description) VALUES ($1, $2)";
            
            $result = pg_query_params($db, $query, array(
                $name,
                $description
            ));
        
            if ($result) {
                echo "Producto agregado correctamente.";
            } else {
                echo "Error al agregar el producto: " . pg_last_error();
            }
        }
    }
}

?>