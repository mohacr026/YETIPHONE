<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/aside.css">

    <link rel="shortcut icon" href="./src/img/snowflake.png" type="image/x-icon">
</head>
<body>
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
            <div class="formContainer">
                <h2>Edit a category</h2>
                <form action="index.php?controller=Category&action=editCategoryPerformed" method="POST" id="categoryForm">
                    <div class="formColumn">

                        <div class="formRow">
                            <label for="categoryId">Default Id:</label>
                            <input type="text" id="categoryId" name="categoryId" readonly value="<?php echo "$id";?>">
                        </div>
    
                        <div class="formRow">
                            <label for="name">Category name:</label>
                            <input type="text" id="name" name="name" required value="<?php echo "$name";?>">
                        </div>
    
                        <?php
                            if($parentCategory != null){
                                echo "
                                <div class='formRow' id='parentCategoryDiv'>
                                <label for='parent'>Parent category</label>
                                <select id='parent' name='parent'>";
                                        if(isset($parentCategories)){
                                            if(empty($parentCategories)){
                                                echo "<option value='nothing' selected>There are no parent categories</option>";
                                            } else {
                                                foreach ($parentCategories as $_parentCategory) {
                                                    $parentId = $_parentCategory['id'];
                                                    $parentName = $_parentCategory['name'];
                                                    if($parentCategory == $parentId){
                                                        echo "<option value='$parentId' selected>$parentName</option>";
                                                    } else {
                                                        echo "<option value='$parentId'>$parentName</option>";
                                                    }                                                    
                                                }
                                            }
                                        }
                                echo "
                                </select>
                            </div>
                                ";
                            }
                        ?>             
                    </div>
                </form>
                <div class="formAction">
                    <a href="index.php?controller=Category&action=showEditCategories" class="cancelBtn">Cancel</a>
                    <button type="submit" value="Add category" class="addBtn" form="categoryForm">Update</button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>