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