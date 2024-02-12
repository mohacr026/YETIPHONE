<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/aside.css">
    <link rel="shortcut icon" href="./src/img/snowflake.png" type="image/x-icon">
    <script src="./src/js/categoryCheckHider.js"></script>
    <script src="./src/js/userMenu.js"></script>
    <script type="module" src="./src/js/ShoppingCart.js"></script>
</head>
<body>
<?php
    if(!isset($_SESSION['role']) && $_SESSION['role'] != "admin"){
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=User&action=showLoginForm'>";
    } else {

    include("./view/components/header.php");
    ?>
    <main>
        <?php include("./view/components/adminAside.php"); ?>
        <div class="container">
            <div class="formContainer">
                <h2>Add a new category</h2>
                <form action="index.php?controller=Category&action=registerCategory" method="POST" id="categoryForm">
                    <div class="formColumn">

                        <div class="formRow">
                            <label for="categoryId">Default Id:</label>
                            <input type="text" id="categoryId" name="categoryId" readonly value="<?php echo "$defaultId";?>" tabindex="<?php echo $tabindex++; ?>">
                        </div>
    
                        <div class="formRow">
                            <label for="name">Category name:</label>
                            <input type="text" id="name" name="name" required tabindex="<?php echo $tabindex++; ?>">
                        </div>
    
                        <div class="formRowLine">
                            <label for="showParent">Is a sub category:</label>
                            <input type="checkbox" name="showParent" id="showParent" tabindex="<?php echo $tabindex++; ?>">
                        </div>
    
                        <div class="formRow hiddenElement" id="parentCategoryDiv">
                            <label for="parent">Parent category</label>
                            <select id="parent" name="parent" tabindex="<?php echo $tabindex++; ?>">
                                <option value="" tabindex="<?php echo $tabindex++; ?>"></option>
                                <?php
                                    if(isset($parentCategories)){
                                        if(empty($parentCategories)){
                                            echo "<option value='nothing' selected tabindex='".$tabindex++."'>There are no parent categories</option>";
                                        } else {
                                            foreach ($parentCategories as $parentCategory) {
                                                $id = $parentCategory['id'];
                                                $name = $parentCategory['name'];
                                                echo "<option value='$id' tabindex='".$tabindex++."'>$name</option>";
                                            }
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="formAction">
                    <button type="submit" value="Add category" class="addBtn" form="categoryForm" tabindex="<?php echo $tabindex++; ?>">Add category</button>
                </div>
            </div>
        </div>
    </main>
    <?php
    }
    ?>
</body>
</html>