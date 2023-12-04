<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="./src/img/snowflake.png" type="image/x-icon">
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
                <h2>Add a new product</h2>
                <form action="index.php?controller=Product&action=registerProduct" method="post" id="productForm">
                    <div class="formColumn">
                        <div class="formRow">
                            <label for="name">Product Name:</label>
                            <input type="text" id="name" name="name" required>
                        </div>
    
                        <div class="formRow">
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" rows="4" required></textarea>
                        </div>
    
                        <div class="formRow">
                            <label for="price">Price:</label>
                            <input type="number" id="price" name="price" min="1" step="1" required>
                        </div>
                    </div>
                    <div class="formColumn">

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
                            <input type="number" id="stock" name="stock" min="0" required>
                        </div>
    
                        <div class="formRow">
                            <label for="image">Product Image:</label>
                            <input type="file" id="image" name="image" accept="image/*" required>
                        </div>
                    </div>
                </form>
                <div class="formAction">
                    <button type="submit" value="Add Product" class="addBtn" form="productForm">Add product</button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>