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
