<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/aside.css">
    <link rel="shortcut icon" href="./src/img/snowflake.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./src/js/userMenu.js"></script>
    <script src="./src/js/productIdUpdater.js"></script>
</head>
<body>
    <?php
    if(!isset($_SESSION['role']) && $_SESSION['role'] != "admin"){
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=User&action=showLoginForm'>";
    } else {

    include("./view/components/header.php");
    ?>
    <main>
    <?php include("./view/components/adminAside.html"); ?>
        <div class="container">
            <div class="formContainer">
                <h2>Add a new product</h2>
                <form action="index.php?controller=Product&action=registerProduct" method="post" id="productForm" enctype="multipart/form-data">
                    <div class="formColumn">
                        <div class="formRow">
                            <label for="name" aria-label="Product name">Product Name:</label>
                            <input type="text" id="name" name="name" required min="2" aria-required="true" tabindex="60">
                        </div>

                        <div class="formRow">
                            <label for="description" aria-label="Product description">Description:</label>
                            <textarea id="description" name="description" rows="4" required aria-required="true" tabindex="61"></textarea>
                        </div>

                    </div>
                    <div class="formColumn">

                        <div class="formRow">
                            <label for="id_category" aria-label="Product category">Category:</label>
                            <select id="category" name="id_category" required aria-required="true" tabindex="62">
                                <?php foreach ($allCategories as $eachCategory): ?>
                                    <option value="<?php echo $eachCategory->getId(); ?>"><?php echo $eachCategory->getName(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="formRow">
                            <label for="price" aria-label="Product price">Price:</label>
                            <input type="number" id="price" name="price" min="1" step="1" required aria-required="true" tabindex="63">
                        </div>

                        <div class="formRow">
                            <label for="storage" aria-label="Product storage">Storage:</label>
                            <input type="number" id="storage" name="storage" min="0" required aria-required="true" tabindex="64">
                        </div>

                        <div class="formRow">
                            <label for="memory" aria-label="Product memory">Memory:</label>
                            <input type="number" id="memory" name="memory" min="0" required aria-required="true" tabindex="65">
                        </div>

                        <div class="formRow">
                            <label for="stock" aria-label="Product stock">Stock:</label>
                            <input type="number" id="stock" name="stock" min="0" required aria-required="true" tabindex="66">
                        </div>

                        <div class="formRow">
                            <label for="colors" aria-label="Product colors">Colors:</label>
                            <input type="text" id="colors" name="colors" placeholder="#FFFFFF, #000000, #FF00FF..." title="Write each color code separated with commas as shown in the example" required aria-required="true" tabindex="67">
                        </div>

                        <div class="formRow">
                            <label for="img" aria-label="Product images">Product Image:</label>
                            <input type="file" id="img" name="img[]" accept="image/jpeg, image/png" multiple tabindex="68">
                        </div>

                        <div class="formRow">
                            <label for="featured" aria-label="Is Featured?">Featured:</label>
                            <select id="featured" name="featured" required aria-required="true" tabindex="69">
                                <option value="true">True</option>
                                <option value="false">False</option>
                            </select>
                        </div>

                        <div class="formRow">
                            <label for="isactive" aria-label="Is active?">Active:</label>
                            <select id="isactive" name="isactive" required aria-required="true" tabindex="70">
                                <option value="true" tabindex="71">True</option>
                                <option value="false" tabindex="72">False</option>
                            </select>
                        </div>

                    </div>
                </form>
                <div class="formAction">
                    <button type="submit" value="Add Product" class="addBtn" form="productForm" tabindex="73">Add product</button>
                </div>
            </div>
        </div>
    </main>
    <?php
    }
    ?>
</body>
</html>