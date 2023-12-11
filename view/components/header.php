<header>
    <h1>YETiPhone</h1>
    <div class="icons">
        <?php
            if(!isset($_SESSION['email'])) {
                echo "<a class='button' href='index.php?controller=User&action=showLoginForm'>";
                echo "  <img src='./src/img/userIcon.png' alt='log in here'>";
                echo "  <p>Log in</p>";
                echo "</a>";
            } else {
                
                echo "<button id='userBtn' class='dropBtn'>";
                echo "  <img class='buttonElements' src='./src/img/userIcon.png' alt='user menu'>";
                echo "  <p class='buttonElements'>{$_SESSION['email']}</p>";
                echo "</button>";
                echo "<div id='userMenu' class='dropdownMenu'>";
                echo "  <a>elemento</a>";
                echo "  <a>elemento</a>";
                echo "  <div class='dropdownDivider'></div>";
                echo "  <a href='index.php?controller=User&action=logout'>Log out</a>";
                echo "</div>";
            }
        ?>
        <a href="#" class="button">
            <img src="./src/img/shoppingCart.png" alt="shopping cart">
        </a>
    </div>
</header>