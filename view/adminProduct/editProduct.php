<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/aside.css">
    <script src="./src/js/userMenu.js"></script>
    <script type="module" src="./src/js/ShoppingCart.js"></script>
</head>
<body>
    <?php include("./view/components/header.php"); 
    if(!isset($_SESSION['role']) && $_SESSION['role'] != "admin"){
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=User&action=showLoginForm'>";
    } else {

    ?>
    <main>
        <?php include("./view/components/adminAside.php"); ?>
        <div class="container">
            <div class="formContainer">
                <h2>Edit Product</h2>
                <form action="index.php?controller=Product&action=updateProduct" method="post" id="productForm" enctype="multipart/form-data">
                    <div class="formColumn">
                        <div class="formRow">
                            <label for="id" aria-label="Product id">Id:</label>
                            <input type="text" name="id" readonly value="<?php print($product->getId()); ?>" tabindex="<?php echo $tabindex++; ?>">
                        </div>

                        <div class="formRow">
                            <label for="name" aria-label="Product name">Name:</label>
                            <input type="text" name="name" value="<?php print($product->getName()); ?>" required tabindex="<?php echo $tabindex++; ?>">
                        </div>

                        <div class="formRow">
                            <label for="description" aria-label="Product description">Description:</label>
                            <textarea name="description" required tabindex="<?php echo $tabindex++; ?>"><?php print($product->getDescription()); ?></textarea>
                        </div>
                    </div>

                    <div class="formColumn">
                        <div class="formRow">
                            <label for="price" aria-label="Product price">Price:</label>
                            <input type="number" name="price" value="<?php print($product->getPrice()); ?>" required tabindex="<?php echo $tabindex++; ?>">
                        </div>

                        <div class="formRow">
                            <label for="category" aria-label="Product category">Category:</label>
                            <select id="category" name="category" required tabindex="<?php echo $tabindex++; ?>">
                                <?php
                                foreach ($categoriesArray as $category) {
                                    $id = $category->getId();
                                    $name = $category->getName();
                                    // Corregido: cambia "selected" a "selected='selected'" y corrige el error de lógica
                                    if ($product->getCategory() == $id) {
                                        echo "<option value='$id' selected='selected' tabindex='".$tabindex++."'>$name</option>";
                                    }else {
                                        echo "<option value='$id' tabindex='".$tabindex++."'>$name</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="formRow">
                            <label for="storage" aria-label="Product storage">Storage:</label>
                            <input type="number" name="storage" min="0" value="<?php print($product->getStorage()); ?>" required tabindex="<?php echo $tabindex++; ?>">
                        </div>

                        <div class="formRow">
                            <label for="memory" aria-label="Product memory">Memory:</label>
                            <input type="number" name="memory" min="0" value="<?php print($product->getMemory()); ?>" required tabindex="<?php echo $tabindex++; ?>">
                        </div>

                        <div class="formRow">
                            <label for="stock" aria-label="Product stock">Stock:</label>
                            <input type="number" name="stock" min="0" value="<?php print($product->getStock()); ?>" required tabindex="<?php echo $tabindex++; ?>">
                        </div>

                        <div class="formRow">
                            <label for="colors" aria-label="Product colors">Colors:</label>
                            <input type="text" id="colors" name="colors" value="<?php print(implode(", ",$product->getColors())); ?>" title="Write each color code separated with commas as shown in the example" required tabindex="<?php echo $tabindex++; ?>">
                        </div>

                        <div class="formRow">
                            <label for="delete_imgs" aria-label="Select to delete product images">Product images:</label>
                            <?php foreach($productImages as $image): ?>
                                <input type="checkbox" name="delete_imgs[]" value="<?php echo $image['img']; ?>" tabindex="<?php echo $tabindex++; ?>"><img style="width: 50px;" src="./src/img/products/<?php echo $image['img']; ?>" alt="<?php echo $product->getName(); ?>'s image"> 
                            <?php endforeach; ?>
                        </div>

                        <div class="formRow">
                            <label for="img" aria-label="Add new product images">Add product Image:</label>
                            <input type="file" id="img" name="img[]" accept="image/jpeg, image/png" multiple tabindex="<?php echo $tabindex++; ?>">
                        </div>

                        <div class="formRow">
                            <label for="featured" aria-label="Edit if product is featured">Featured:</label>
                            <select id="featured" name="featured" required tabindex="<?php echo $tabindex++; ?>">
                                <option value="true" <?php if($product->getFeatured()){ echo("selected"); } ?> tabindex="<?php echo $tabindex++; ?>">True</option>
                                <option value="false" <?php if(!$product->getFeatured()){ echo("selected"); } ?> tabindex="<?php echo $tabindex++; ?>">False</option>
                            </select>
                        </div>

                        <div class="formRow">
                            <label for="isactive" aria-label="Edit if product is active">Active:</label>
                            <select id="isactive" name="isactive" required tabindex="<?php echo $tabindex++; ?>">
                                <option value="true" <?php if($product->getIsActive()){ echo("selected"); } ?> tabindex="<?php echo $tabindex++; ?>">True</option>
                                <option value="false" <?php if(!$product->getIsActive()){ echo("selected"); } ?> tabindex="<?php echo $tabindex++; ?>">False</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="formAction">
                    <a href="index.php?controller=Product&action=showEditProducts" class="cancelBtn" aria-label="Cancel and revert changes" tabindex="<?php echo $tabindex++; ?>">Cancel</a>
                    <button type="submit" form="productForm" class="addBtn" aria-label="Update and confirm product information update" tabindex="<?php echo $tabindex++; ?>">Update</button>
                </div>
            </div>
        </div>
    </main>
    <?php
    }
    ?>
</body>
</html>
