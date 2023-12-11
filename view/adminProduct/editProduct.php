<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/aside.css">
    <script src="./src/js/userMenu.js"></script>
</head>
<body>
    <?php include("./view/components/header.php"); 
    if(!isset($_SESSION['role'] && $_SESSION['role'] != "admin")){
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=User&action=showLoginForm'>";
    } else {

    ?>
    <main>
        <?php include("./view/components/adminAside.html"); ?>
        <div class="container">
            <div class="formContainer">
                <h2>Edit Product</h2>
                <form action="index.php?controller=Product&action=editProductPerformed" method="post" id="productForm" enctype="multipart/form-data">
                    <div class="formColumn">
                        <div class="formRow">
                            <label for="id">Id:</label>
                            <input type="text" name="id" readonly value="<?php print($product->getId()); ?>">
                        </div>

                        <div class="formRow">
                            <label for="name">Name:</label>
                            <input type="text" name="name" value="<?php print($product->getName()); ?>" required>
                        </div>

                        <div class="formRow">
                            <label for="description">Description:</label>
                            <textarea name="description" required><?php print($product->getDescription()); ?></textarea>
                        </div>
                    </div>

                    <div class="formColumn">
                        <div class="formRow">
                            <label for="price">Price:</label>
                            <input type="number" name="price" value="<?php print($product->getPrice()); ?>" required>
                        </div>

                        <div class="formRow">
                            <label for="category">Category:</label>
                            <select id="category" name="category" required>
                                <?php
                                foreach ($categoriesArray as $category) {
                                    $id = $category->getId();
                                    $name = $category->getName();
                                    // Corregido: cambia "selected" a "selected='selected'" y corrige el error de lógica
                                    if ($product->getCategory() == $id) {
                                        echo "<option value='$id' selected='selected'>$name</option>";
                                    }else {
                                        echo "<option value='$id'>$name</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="formRow">
                            <label for="stock">Stock:</label>
                            <input type="number" name="stock" value="<?php print($product->getStock()); ?>" required>
                        </div>

                        <div class="formRow">
                            <label for="image">Image:</label>
                            <input type="file" name="image">
                        </div>

                        <div class="formRow">
                            <img src="<?php print($product->getImage()); ?>" alt="Current image" width="100">
                        </div>
                    </div>
                </form>
                <div class="formAction">
                    <a href="index.php?controller=Product&action=showEditProducts" class="cancelBtn">Cancel</a>
                    <button type="submit" form="productForm" class="addBtn">Update</button>
                </div>
            </div>
        </div>
    </main>
    <?php
    }
    ?>
</body>
</html>
