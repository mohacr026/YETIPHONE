<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/aside.css">
    <link rel="shortcut icon" href="./src/img/snowflake.png" type="image/x-icon">
    <script src="./src/js/dropdownCategories.js"></script>
    <script src="./src/js/userMenu.js"></script>
</head>
<body class="noscroll">
    <?php
    if(!isset($_SESSION['role']) && $_SESSION['role'] != "admin"){
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=User&action=showLoginForm'>";
    } else {

    include("./view/components/header.php");
    ?>
    <main>
        <?php include("./view/components/adminAsideSearch.html"); ?>
        <div class="container">
            <h2>Categories</h2>
            <div class="categoryContainer">
                <?php
                    require_once("./view/components/categoryComponent.php");
                    foreach ($categoriesArray as $key => $value) {
                        $state = $value['isactive'] == null ? false : true;
                        $category = new Category($value['id'], $value['name'], "", $state);
                        $subCategories = $subCategoriesArray[strval($value['id'])];
                        $component = new CategoryComponent($category, $subCategories);
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