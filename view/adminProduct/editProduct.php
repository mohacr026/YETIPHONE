<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">

</head>
<body>
    <?php
    include("./view/components/header.php");
    ?>
    <main>
        <aside>
        <a href="index.php?controller=Product&action=showProductList">atras</a>
            filtros y tal nose
        </aside>


<div class="container">
    <div class="formContainer">
    <h2>Edit Product</h2>

        <div class="formColumn">
            <form action="?action=updateProduct" method="post" enctype="multipart/form-data">
            <div class="formRow">

                <?php

                // Obtener el ID del producto de la URL
                $productId = $_GET['id'];

                // Obtener el producto para mostrar la información actual
                $product = $this->getProductById($productId);

                if ($product) {
                ?>

                    <div class="formRow">
                        <input type="hidden" name="id" value="<?php echo $product->getId(); ?>">
                    </div>

                    <div class="formRow">
                        <label for="name">Name:</label>
                        <input type="text" name="name" value="<?php echo $product->getName(); ?>" required>
                    </div>

                    <div class="formRow">
                        <label for="description">Description:</label>
                        <textarea name="description" required><?php echo $product->getDescription(); ?></textarea>
                    </div>

                    <div class="formRow">
                        <label for="price">Price:</label>
                        <input type="number" name="price" value="<?php echo $product->getPrice(); ?>" required>
                    </div>

                    <div class="formRow">
                        <label for="category">Category:</label>
                        <select id="category" name="category" required>
                            <?php
                            $db = Database::connect();
                            $query = "SELECT id, name FROM category WHERE isActive = true";
                            $stmt = $db->prepare($query);
                            $stmt->execute();
                            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($categories as $category):
                            ?>
                                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="formRow">
                        <label for="stock">Stock:</label>
                        <input type="number" name="stock" value="<?php echo $product->getStock(); ?>" required>
                    </div>

                    <div class="formRow">
                        <label for="image">Image:</label>
                        <input type="file" name="image">
                    </div>

                    <div class="formRow">
                        <img src="<?php echo $product->getImage(); ?>" alt="Current image" width="100">
                    </div>

                    <div class="formAction">
                        <a href="index.php?controller=Product&action=showProductList" class="cancelBtn">Cancel</a>
                        <button type="submit" class="addBtn">Update</button>
                    </div>

                <?php
                } else {
                    echo "Producto no encontrado.";
                }
                ?>
            </div>                
            </form>
        </div>
    </div>
</div>

</main>

</body>
</html>
