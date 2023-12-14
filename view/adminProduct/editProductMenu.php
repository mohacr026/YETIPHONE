<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/aside.css">
    <script src="./src/js/userMenu.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./src/js/searchBarAdmin.js"></script>
    <script id="productJSON" type="application/json"> <?php echo "$productsJsonResult"; ?> </script>
    <script id="categoryJSON" type="application/json"> <?php echo "$categoriesJsonResult"; ?> </script>
</head>
<body>
    
    <div id="destination" data-destination="Product"></div>
    <?php
    include("./view/components/header.php");
    if(!isset($_SESSION['role']) && $_SESSION['role'] != "admin"){
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=User&action=showLoginForm'>";
    } else {

    ?>
    <main>
        <?php include("./view/components/adminAsideSearch.html"); ?>
        <div class="container">
            <h2>List Product</h2>
            <div class="productContainer">
                <?php
                    require_once("./view/components/productComponent.php");
                    foreach ($productsArray as $product) {
                        $component = new ProductComponent($product);
                        $component->render();
                    }
                ?>
            </div>
        </div>
    </main>
    <?php
    }
    ?>
</body>
</html>
