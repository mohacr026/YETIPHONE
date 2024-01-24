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
    if(!isset($_SESSION['role']) && $_SESSION['role'] != "admin"){
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=User&action=showLoginForm'>";
    } else {

    ?>
    <main>
        <?php include("./view/components/adminAside.html"); ?>
        <div class="container">
            <div class="formContainer">
                <h2>Edit Product</h2>
                <form action="index.php?controller=Product&action=updateProduct" method="post" id="productForm" enctype="multipart/form-data">
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
                            <label for="storage">Storage:</label>
                            <input type="number" name="storage" min="0" value="<?php print($product->getStorage()); ?>" required>
                        </div>

                        <div class="formRow">
                            <label for="memory">Memory:</label>
                            <input type="number" name="memory" min="0" value="<?php print($product->getMemory()); ?>" required>
                        </div>

                        <div class="formRow">
                            <label for="stock">Stock:</label>
                            <input type="number" name="stock" min="0" value="<?php print($product->getStock()); ?>" required>
                        </div>

                        <div class="formRow">
                            <label for="colors">Colors:</label>
                            <input type="text" id="colors" name="colors" value="<?php print(implode(", ",$product->getColors())); ?>" title="Write each color code separated with commas as shown in the example" required>
                        </div>

                        <div class="formRow">
                            <label for="delete_imgs">Product images:</label>
                            <?php foreach($productImages as $image): ?>
                                <input type="checkbox" name="delete_imgs[]" value="<?php echo $image['img']; ?>"><img style="width: 50px;" src="./src/img/products/<?php echo $image['img']; ?>" alt="<?php echo $product->getName(); ?>'s image"> 
                            <?php endforeach; ?>
                        </div>

                        <div class="formRow">
                            <label for="img">Add product Image:</label>
                            <input type="file" id="img" name="img[]" accept="image/jpeg, image/png" multiple>
                        </div>

                        <div class="formRow">
                            <label for="featured">Featured:</label>
                            <select id="featured" name="featured" required>
                                <option value="true" <?php if($product->getFeatured()){ echo("selected"); } ?>>True</option>
                                <option value="false" <?php if(!$product->getFeatured()){ echo("selected"); } ?>>False</option>
                            </select>
                        </div>

                        <div class="formRow">
                            <label for="isactive">Active:</label>
                            <select id="isactive" name="isactive" required>
                                <option value="true" <?php if($product->getIsActive()){ echo("selected"); } ?>>True</option>
                                <option value="false" <?php if(!$product->getIsActive()){ echo("selected"); } ?>>False</option>
                            </select>
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
