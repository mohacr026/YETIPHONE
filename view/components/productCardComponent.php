<article class="productCardContainer">
    <h3><?= $product->getName(); ?></h3>
    <div class="separator"></div>
    <div class="productCardInfo">
        <img class="productImage" src="./src/img/products/<?php echo $product->getImage()[0];?>" alt="<?php $product->getName();?>">
        <div class="info">
            <p>Memory: <?= $product->getMemory(); ?></p>
            <p>Storage: <?= $product->getStorage(); ?></p>
        </div>
        <div class="price">
            <p><?= $product->getPrice(); ?> €</p>
        </div>
    </div>
    <a href="index.php?controller=Product&action=showProductPage&product=<?= urlencode(serialize($product)) ?>&category=<?= $product->getCategory(); ?>">ADD TO CART</a>
</article>