<!--Controlador frontal: fichero que se encarga de cargarlo absolutamente todo -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
</head>
<body>
<?php 
require_once "autoload.php";

if (isset($_GET['controller'])){
    $controllerName = $_GET['controller']."Controller";
}
else{
    //Controlador per dedecte
    $controllerName = "productController";
}
if (class_exists($controllerName)){
    $controller = new $controllerName(); 
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }
    else{
        $action ="showAllProducts";
    }
    $controller->$action();   
}else{
    require_once("./view/login/login.html");
}
?>
</body>
</html>