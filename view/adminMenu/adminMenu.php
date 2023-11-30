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
    <header>
        <h1>YETiPhone</h1>
        <div class="icons">
            <a 
                <?php
                if(!isset($_SESSION['email'])) {
                    echo 'href="index.php?controller=User&action=showLoginForm"';
                }
                ?>
            >
                <img src="./src/img/userIcon.png" alt="log in here">
                <?php
                if(isset($_SESSION['email'])) {
                    echo "<p>{$_SESSION['email']}</p>";
                } else {
                    echo "<p>Log In</p>";
                }
                ?>
            </a>
            <a href="index.php">
                <img src="./src/img/shoppingCart.png" alt="shopping cart">
            </a>
        </div>
    </header>
    <h2>Lista de enlaces improvisada</h2>
    <ul>
        <li><a href="index.php?Controller=Product&action=showAddProducts">Añadir Product</a></li>
        <li><a href="index.php?Controller=Category&action=showAddCategories">Añadir Category</a></li>
    </ul>
    
</body>
</html>