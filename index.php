<!-- MAIN CONTROLLER -->
<?php 
require_once "autoload.php";

if (isset($_GET['controller'])){
    $controllerName = $_GET['controller']."Controller";
    //echo "<script>alert('$controllerName')</script>";
}
else{
    // Default Controller
    $controllerName = "ProductController";
}
if (class_exists($controllerName)){
    $controller = new $controllerName(); 
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }
    else{
        $action ="showFrontPageProducts";
    }
        $controller->$action(); 
} else {
    echo "<script>alert('No existe el nombre del controlador')</script>";
}
?>