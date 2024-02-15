<!-- <aside class="filters">
    <h2>Filtros</h2>
    <div class="filter-section">
        <h3>Ordenar por precio</h3>
        <ul>
            <li><a href="#" id="sortByPriceAsc">Menor a mayor</a></li>
            <li><a href="#" id="sortByPriceDesc">Mayor a menor</a></li>
        </ul>
    </div>
    <div class="filter-section">
        <h3>Productos en oferta</h3>
        <ul>
            <li><a href="#">Mostrar solo productos en oferta</a></li>
        </ul>
    </div>
</aside> -->

<article class="productCardContainer">
    <div class="cardTop">
        <?php if ($product->getFeatured()): ?>
            <p class="topSale2">IN OFFER!</p>
        <?php endif; ?>
        <img class="productImage" src="./src/img/products/<?php echo $product->getImage()[0]; ?>"
            alt="<?php $product->getName(); ?>">
        <a href="index.php?controller=Product&action=showProductPage&product=<?= urlencode(serialize($product)) ?>&category=<?= $product->getCategory(); ?>"
            class="enlaceVista" tabindex="<?php echo $tabindex++; ?>">Vista rápida</a>
    </div>
    <div class="separator"></div>
    <div class="productCardInfo">
        <div class="info">
            <a
                href="index.php?controller=Product&action=showProductPage&product=<?= urlencode(serialize($product)) ?>&category=<?= $product->getCategory(); ?>" tabindex="<?php echo $tabindex++; ?>">
                <h3>
                    <?= $product->getName(); ?>
                </h3>
            </a>
            <div class="spec">
                <p>Memory:</p>
                <p>
                    <?= $product->getMemory(); ?>GB
                </p>
            </div>
            <div class="spec">
                <p>Storage:</p>
                <p>
                    <?= $product->getStorage(); ?>GB
                </p>
            </div>
        </div>
        <div class="price">
            <p><?= $product->getPrice(); ?>€</p>
            <button class="addCart" data-product="<?= $product->getId(); ?>" data-price="<?= $product->getPrice(); ?>" data-name="<?= $product->getName(); ?>" data-image="<?= $product->getImage()[0]; ?>" tabindex="<?php echo $tabindex++; ?>">
                <img class="cart" src="./src/img/shoppingCart.png" alt="add to cart">
            </button>
        </div>
    </div>
</article>

<!-- <style>
    .filters {
        position: fixed;
        top: 40px;
        left: 0;
        width: 100%;
        background-color: #f2f2f2;
        padding: 20px;
    }

    .filter-section {
        margin-bottom: 20px;
    }

    .filter-section h3 {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .filter-section ul {
        list-style-type: none;
        padding: 0;
    }

    .filter-section ul li {
        margin-bottom: 5px;
    }

    .filter-section ul li a {
        text-decoration: none;
        color: #333;
    }

    .filter-section ul li a:hover {
        color: blue;
    }
</style> -->

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Capturar clics en "Menor a mayor"
        document.getElementById('sortByPriceAsc').addEventListener('click', function(event) {
            event.preventDefault(); // Evitar que el enlace se comporte como un enlace normal
            sortProductsByPriceAsc(); // Llamar a la función para ordenar de menor a mayor
        });

        // Capturar clics en "Mayor a menor"
        document.getElementById('sortByPriceDesc').addEventListener('click', function(event) {
            event.preventDefault(); // Evitar que el enlace se comporte como un enlace normal
            sortProductsByPriceDesc(); // Llamar a la función para ordenar de mayor a menor
        });
    });

    // Función para ordenar productos de menor a mayor
    function sortProductsByPriceAsc() {
        var products = document.querySelectorAll('.productCardContainer');
        var sortedProducts = Array.from(products).sort(function(a, b) {
            return parseFloat(a.querySelector('.price').innerText) - parseFloat(b.querySelector('.price').innerText);
        });
        var productsContainer = document.querySelector('.productCardGrid');
        productsContainer.innerHTML = '';
        sortedProducts.forEach(function(product) {
            productsContainer.appendChild(product);
        });
    }

    // Función para ordenar productos de mayor a menor
    function sortProductsByPriceDesc() {
        var products = document.querySelectorAll('.productCardContainer');
        var sortedProducts = Array.from(products).sort(function(a, b) {
            return parseFloat(b.querySelector('.price').innerText) - parseFloat(a.querySelector('.price').innerText);
        });
        var productsContainer = document.querySelector('.productCardGrid');
        productsContainer.innerHTML = '';
        sortedProducts.forEach(function(product) {
            productsContainer.appendChild(product);
        });
    }
</script> -->
