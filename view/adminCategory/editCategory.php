<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/aside.css">
    <link rel="shortcut icon" href="./src/img/snowflake.png" type="image/x-icon">
    <script src="./src/js/userMenu.js"></script>
    <script type="module" src="./src/js/searchBar.js"></script>
    <script type="module" src="./src/js/ShoppingCart.js"></script>
</head>
<body>
<?php
    if(!isset($_SESSION['role']) && $_SESSION['role'] != "admin"){
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=User&action=showLoginForm'>";
    } else {

    include("./view/components/header.php");
    ?>
    <main id="main-admin">
        <?php include("./view/components/adminAside.php"); ?>
        <div class="container">
            <div class="formContainer">
                <h2>Edit a category</h2>
                <form action="index.php?controller=Category&action=editCategoryPerformed" method="POST" id="categoryForm">
                    <div class="formColumn">

                        <div class="formRow">
                            <label for="categoryId">Default Id:</label>
                            <input type="text" id="categoryId" name="categoryId" readonly value="<?php echo "$id";?>" tabindex="<?php echo $tabindex++; ?>">
                        </div>
    
                        <div class="formRow">
                            <label for="name">Category name:</label>
                            <input type="text" id="name" name="name" required value="<?php echo "$name";?>" tabindex="<?php echo $tabindex++; ?>">
                        </div>
    
                        <?php
                            if($parentCategory != null){
                                echo "
                                <div class='formRow' id='parentCategoryDiv'>
                                <label for='parent'>Parent category</label>
                                <select id='parent' name='parent' tabindex='".$tabindex++."'>";
                                        if(isset($parentCategories)){
                                            if(empty($parentCategories)){
                                                echo "<option value='nothing' selected tabindex='".$tabindex++."'>There are no parent categories</option>";
                                            } else {
                                                foreach ($parentCategories as $_parentCategory) {
                                                    $parentId = $_parentCategory['id'];
                                                    $parentName = $_parentCategory['name'];
                                                    if($parentCategory == $parentId){
                                                        echo "<option value='$parentId' selected tabindex='".$tabindex++."'>$parentName</option>";
                                                    } else {
                                                        echo "<option value='$parentId' tabindex='".$tabindex++."'>$parentName</option>";
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
                    <a href="index.php?controller=Category&action=showEditCategories" class="cancelBtn" tabindex="<?php echo $tabindex++; ?>">Cancel</a>
                    <button type="submit" value="Add category" class="addBtn" form="categoryForm" tabindex="<?php echo $tabindex++; ?>">Update</button>
                </div>
            </div>
        </div>
    </main>
    <?php
    }
    ?>
</body>
</html>