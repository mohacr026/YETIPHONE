<article class="productCardContainer">
    <img src="./src/img/<?= $product->getImage(); ?>" >
    <a href="index.php?controller=Product&action=showProductPage&product=<?= urlencode(serialize($product)) ?>&category=<?= $product->getCategory(); ?>">ADD TO CART</a>
    <div>
        <div>
            <span><?= $product->getName(); ?></span>
            <span><?= $product->getPrice(); ?>€</span>
        </div>
        <img id="product-<?= $product->getId(); ?>" src="./src/svg/heart.svg">
    </div>
</article>