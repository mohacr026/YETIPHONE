<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
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

    <h2>Add Product</h2>

    <form action="index.php?controller=Product&action=registerProduct" method="post">

        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>
        <br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>
        <br>

        <!-- <label for="category">Category:</label>
        <select id="featured" name="featured" required>
                // aqui va el php de las categorias
        </select>
        <br>

        <label for="img">Image:</label>
        <input type="file" id="img" name="img" required accept="img/*">
        <br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" min="0.01" step="0.01" required>
        <br>

        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" min="0" required>
        <br>

        <label for="featured">Featured:</label>
        <select id="featured" name="featured" required>
            <option value="true">Yes</option>
            <option value="false">No</option>
        </select>
        <br>

        <label for="isactive">Is Active:</label>
        <select id="isactive" name="isactive" required>
            <option value="true">Yes</option>
            <option value="false">No</option>
        </select>
        <br> -->

        <input type="submit" value="Add Product">
    </form>

</body>
</html>