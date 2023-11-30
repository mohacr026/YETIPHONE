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

    // Por si se me olvida esto es para que nos de que el método existe antes de llamarlo
    if (method_exists($controller, $action)) {
        $controller->$action(); 
    } else {
        echo "<script>alert('No existe el nombre de la acción')</script>";
    }
} else {
    echo "<script>alert('No existe el nombre del controlador')</script>";
}
?>