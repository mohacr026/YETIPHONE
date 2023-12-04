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
</head>
<body class="noscroll">
    <?php
    include("./view/components/header.php");
    ?>
    <main>
    <aside>
            <h2>Navigation / Preferences</h2>
            <a href="index.php?controller=Product&action=showAddProducts">Add Products</a>
            <a href="index.php?controller=Product&action=showEditProducts">Edit Products</a>
            <a href="index.php?controller=Category&action=showAddCategories">Add Category</a>
            <a href="index.php?controller=Category&action=showEditCategories">Edit Category</a>
            <a href="index.php?controller=Product&action=showInterfaz">User Interface</a>
        </aside>

        <div class="container">
            <h2>Categories</h2>
            <div class="categoryContainer">
                <?php
                    require_once("./view/components/categoryComponent.php");
                    foreach ($categoriesArray as $key => $value) {
                        $category = new Category($value['id'], $value['name']);
                        $component = new CategoryComponent($category, $value['subcategories']);
                        $component->render();
                    }
                ?>
            </div>
        </div>
    </main> 
</body>
</html>