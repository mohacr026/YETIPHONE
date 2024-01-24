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
                            <label for="name">Product Name:</label>
                            <input type="text" id="name" name="name" required min="2">
                        </div>
    
                        <div class="formRow">
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" rows="4" required></textarea>
                        </div>
    
                    </div>
                    <div class="formColumn">

                        <div class="formRow">
                            <label for="id_category">Category:</label>
                            <select id="category" name="id_category" required>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="formRow">
                            <label for="price">Price:</label>
                            <input type="number" id="price" name="price" min="1" step="1" required>
                        </div>

                        <div class="formRow">
                            <label for="storage">Storage:</label>
                            <input type="number" id="storage" name="storage" min="0" required>
                        </div>

                        <div class="formRow">
                            <label for="memory">Memory:</label>
                            <input type="number" id="memory" name="memory" min="0" required>
                        </div>

                        <div class="formRow">
                            <label for="stock">Stock:</label>
                            <input type="number" id="stock" name="stock" min="0" required>
                        </div>

                        <div class="formRow">
                            <label for="colors">Colors:</label>
                            <input type="text" id="colors" name="colors" placeholder="#FFFFFF, #000000, #FF00FF..." title="Write each color code separated with commas as shown in the example" required>
                        </div>
    
                        <div class="formRow">
                            <label for="img">Product Image:</label>
                            <input type="file" id="img" name="img[]" accept="image/jpeg, image/png" multiple>
                        </div>

                        <div class="formRow">
                            <label for="featured">Featured:</label>
                            <select id="featured" name="featured" required>
                                <option value="true">True</option>
                                <option value="false">False</option>
                            </select>
                        </div>

                        <div class="formRow">
                            <label for="isactive">Active:</label>
                            <select id="isactive" name="isactive" required>
                                <option value="true">True</option>
                                <option value="false">False</option>
                            </select>
                        </div>

                    </div>
                </form>
                <div class="formAction">
                    <button type="submit" value="Add Product" class="addBtn" form="productForm">Add product</button>
                </div>
            </div>
        </div>
    </main>
    <?php
    }
    ?>
</body>
</html>