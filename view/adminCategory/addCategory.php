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

    <h2>Add a new category</h2>

    <form action="index.php?controller=Category&action=registerCategory" method="POST">

        <label for="name">Category name:</label>
        <input type="text" id="name" name="name" required>
        <br>

        <label for="showParent">Is a sub category:</label>
        <input type="checkbox" name="showParent" id="showParent">

        <br>
        <label for="parent">Parent category</label>
        <select id="parent" name="parent" required>
                <option value="0" selected>No parent category</option>
                <?php
                    
                ?>
        </select>
        <br>

        <input type="submit" value="Add Product">
    </form>

</body>
</html>