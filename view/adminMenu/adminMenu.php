<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <!--
        TODO: Hay que hacer que se pueda desloguear, una vez eso, 
        hay que quitar la lista de enlaces de la portada
    -->
    <?php
    include("./view/components/header.php");
    ?>
    <h2>Lista de enlaces improvisada</h2>
    <ul>
        <li><a href="index.php?Controller=Product&action=showAddProducts">Añadir Product</a></li>
        <li><a href="index.php?Controller=Category&action=showAddCategories">Añadir Category</a></li>
    </ul>
    
</body>
</html>