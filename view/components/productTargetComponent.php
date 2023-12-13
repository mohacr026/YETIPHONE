<a href="index.php?controller=productController&action=productCart&product=<?= urlencode(serialize($product)) ?>">
    <img src="./src/img/<?= $product->getImage(); ?>" >
    <span>ADD TO CART</span>
    <div>
        <span><?= $product->getName(); ?></span>
        <span><?= $product->getPrice(); ?></span>
        <img id="product-<?= $product->getId(); ?>" src="./src/svg/heart.svg">
    </div>
</a>