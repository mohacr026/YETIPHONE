<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/aside.css">

</head>
<body>
    <?php
    include("./view/components/header.php");
    if(!isset($_SESSION['role']) && $_SESSION['role'] != "admin"){
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=User&action=showLoginForm'>";
    } else {

    ?>
    <main>
        <?php include("./view/components/adminNavigationAside.php"); ?>
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
