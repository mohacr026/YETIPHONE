<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="./src/js/dropdownCategories.js"></script>
</head>
<body class="test">
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
</body>
</html>