<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="./src/js/categoryCheckHider.js"></script>
</head>
<body>
<?php
    include("./view/components/header.php");
    ?>
    <main>
        <aside>
            <a href="index.php">Back</a>
            filtros y tal nose
        </aside>
        <div class="container">
            <div class="formContainer">
                <h2>Add a new category</h2>
                <form action="index.php?controller=Category&action=registerCategory" method="POST" id="categoryForm">
                    <div class="formColumn">

                        <div class="formRow">
                            <label for="categoryId">Default Id:</label>
                            <input type="text" id="categoryId" name="categoryId" readonly value="<?php echo "$defaultId";?>">
                        </div>
    
                        <div class="formRow">
                            <label for="name">Category name:</label>
                            <input type="text" id="name" name="name" required>
                        </div>
    
                        <div class="formRowLine">
                            <label for="showParent">Is a sub category:</label>
                            <input type="checkbox" name="showParent" id="showParent">
                        </div>
    
                        <div class="formRow hiddenElement" id="parentCategoryDiv">
                            <label for="parent">Parent category</label>
                            <select id="parent" name="parent">
                                <option value=""></option>
                                <?php
                                    if(isset($parentCategories)){
                                        if(empty($parentCategories)){
                                            echo "<option value='nothing' selected>There are no parent categories</option>";
                                        } else {
                                            foreach ($parentCategories as $parentCategory) {
                                                $id = $parentCategory['id'];
                                                $name = $parentCategory['name'];
                                                echo "<option value='$id'>$name</option>";
                                            }
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="formAction">
                    <button type="submit" value="Add category" class="addBtn" form="categoryForm">Add category</button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>