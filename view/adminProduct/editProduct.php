<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone - Edit Product</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <header>
        <h1>YETiPhone</h1>
        <div class="icons">
            <a 
                <?php
                if(!isset($_SESSION['email'])) {
                    echo 'href="index.php?controller=User&action=showLoginForm"';
                }
                ?>
            >
                <img src="./src/img/userIcon.png" alt="log in here">
                <?php
                if(isset($_SESSION['email'])) {
                    echo "<p>{$_SESSION['email']}</p>";
                } else {
                    echo "<p>Log In</p>";
                }
                ?>
            </a>
            <a href="index.php">
                <img src="./src/img/shoppingCart.png" alt="shopping cart">
            </a>
        </div>
    </header>

    <h2>Edit Product</h2>

    <?php
        // Assuming you have a $product variable with the product details
        if (isset($product)) {
    ?>
        <form action="index.php?controller=Product&action=updateProduct" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $product->getId(); ?>">

            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $product->getName(); ?>" required>
            <br>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required><?php echo $product->getDescription(); ?></textarea>
            <br>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" min="1" step="1" value="<?php echo $product->getPrice(); ?>" required>
            <br>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <?php
                $db = Database::connect();
                $query = "SELECT id, name FROM category WHERE isActive = true";
                $stmt = $db->prepare($query);
                $stmt->execute();
                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($categories as $category):
                    $selected = ($category['id'] == $product->getCategory()) ? 'selected' : '';
                ?>
                    <option value="<?php echo $category['id']; ?>" <?php echo $selected; ?>><?php echo $category['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <br>

            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" min="0" value="<?php echo $product->getStock(); ?>" required>
            <br>

            <label for="image">Product Image:</label>
            <input type="file" id="image" name="image" accept="image/*">
            <br>

            <!-- Additional fields if needed -->

            <input type="submit" value="Update Product">
        </form>
    <?php
        } else {
            echo "Product not found.";
        }
    ?>

</body>
</html>
