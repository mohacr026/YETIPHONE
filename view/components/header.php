<?php $tabindex = 1; ?>
<header>
<input type="checkbox" id="menuBtn" class="menu-button-checkbox" tabindex="<?php echo $tabindex++; ?>">
    <label for="menuBtn" class="menu-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
    </label>
    <div id="mobileMenu" class="mobile-menu">
        <ul>
            <li tabindex="<?php echo $tabindex++; ?>">BEST CATEGORIES</li>
            <li tabindex="<?php echo $tabindex++; ?>">                
                <?php
                    $db = Database::connect();
                    $query = "SELECT id, name FROM category WHERE isActive = true";
                    $stmt = $db->prepare($query);
                    $stmt->execute();
                    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($categories as $category): ?>
        
                    <a href="index.php?controller=Product&action=showProducts&category=<?= $category['id']; ?>" tabindex="<?php echo $tabindex++; ?>"><?= $category['name']; ?></a>
                <?php endforeach; ?>
            </li>
            <li tabindex="<?php echo $tabindex++; ?>">Link 3</li>
            <li tabindex="<?php echo $tabindex++; ?>">Link 4</li>
        </ul>
    </div>

    
    <a href="index.php" style="text-decoration: none" aria-label="YETiPhone" tabindex="<?php echo $tabindex++; ?>">
        <h1>YETiPhone</h1>
    <a>
    <button id="categoriasBtn" class="categorias" aria-expanded="false" aria-haspopup="true" aria-controls="categoriasDropdown" tabindex="<?php echo $tabindex++; ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="33" height="19" viewBox="0 0 44 29" fill="none">
            <path d="M0 2.5C0 1.11929 1.11929 0 2.5 0H41.5C42.8807 0 44 1.11929 44 2.5C44 3.88071 42.8807 5 41.5 5H2.5C1.11929 5 0 3.88071 0 2.5Z" fill="#F3FAFD"/>
                <path d="M0 14.125C0 12.7443 1.11929 11.625 2.5 11.625H41.5C42.8807 11.625 44 12.7443 44 14.125C44 15.5057 42.8807 16.625 41.5 16.625H2.5C1.11929 16.625 0 15.5057 0 14.125Z" fill="#F3FAFD"/>
                <path d="M0 25.75C0 24.3693 1.11929 23.25 2.5 23.25H41.5C42.8807 23.25 44 24.3693 44 25.75C44 27.1307 42.8807 28.25 41.5 28.25H2.5C1.11929 28.25 0 27.1307 0 25.75Z" fill="#F3FAFD"/>
            </svg>
        All Categories
    </button>
    
    <div id="categoriasDropdown" class="categorias-dropdown" aria-labelledby="categoriasBtn">
        <?php
        require_once("./model/category.php");
        $categories = Category::fetchCategory(["isactive" => "true"]);
        $index = 10;
        foreach ($categories as $category): ?>
            <a href="index.php?controller=Product&action=showProducts&category=<?= $category->getId(); ?>" tabindex="<?php echo $tabindex++; ?>"><?= $category->getName(); ?></a>
        <?php endforeach; ?>
    </div>

        <script src="./src/js/headerDropdown.js"></script>

    <div class="searchBar">
        <svg  width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect width="45" height="45" rx="25" fill="url(#pattern0)"/>
            <defs>
                <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                    <use xlink:href="#image0_41_23" transform="scale(0.0078125)"/>
                </pattern>
                <image id="image0_41_23" width="128" height="128" xlink:href="data:image/png;base64,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"/>
            </defs>
        </svg>
        <input type="text" placeholder="Search any product..." id="search" tabindex="<?php echo $tabindex++; ?>">
        
    </div>

    <div class="icons">
        <?php
            if(!isset($_SESSION['email'])) {
                echo "<a class='button' href='index.php?controller=User&action=showLoginForm' tabindex='".$tabindex++."'>";
                echo "  <img src='./src/img/userIcon.png' alt='log in here'>";
                echo "  <p>Log in</p>";
                echo "</a>";
            } else {
                echo "<button id='userBtn' class='dropBtn' aria-haspopup='true' aria-expanded='false' aria-controls='userMenu' tabindex='".$tabindex++."'>";
                echo "  <img class='buttonElements' src='./src/img/userIcon.png' alt='user menu'>";
                echo "  <p class='buttonElements'>{$_SESSION['email']}</p>";
                echo "</button>";
                if($_SESSION['role'] == "admin"){
                    echo "<div id='userMenu' class='dropdownMenu' aria-labelledby='userBtn'>";
                    echo "  <a href='index.php?controller=User&action=showAdminDashboard' tabindex='".$tabindex++."'>Dashboard</a>";
                    echo "  <a>elemento</a>";
                    echo "  <div class='dropdownDivider'></div>";
                    echo "  <a href='index.php?controller=User&action=logout' tabindex='".$tabindex++."'>Log out</a>";
                    echo "</div>";
                } else {
                    echo "<div id='userMenu' class='dropdownMenu'>";
                    echo "  <a href='index.php?controller=Purchase&action=userPurchases'>My purchases</a>";
                    echo "  <a>elemento</a>";
                    echo "  <div class='dropdownDivider'></div>";
                    echo "  <a href='index.php?controller=User&action=logout' tabindex='".$tabindex++."'>Log out</a>";
                    echo "</div>";
                }
            }
        ?>
        <a href="index.php?controller=ShoppingCart&action=viewCart" class="button" tabindex="<?php echo $tabindex++; ?>">
            <img src="./src/img/shoppingCart.png" alt="shopping cart" aria-label="Shopping Cart">
        </a>
    </div>
</header>
