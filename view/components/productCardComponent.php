<article class="productCardContainer">
    <div class="cardTop">
        <a href="index.php?controller=Product&action=showProductPage&product=<?= urlencode(serialize($product)) ?>&category=<?= $product->getCategory(); ?>"><h3><?= $product->getName(); ?></h3></a>
        <?php if($product->getFeatured()): ?>
        <div>
            <p>ON SALE!!</p>
        </div>
        <?php endif; ?>
    </div>
    <div class="separator"></div>
    <div class="productCardInfo">
        <img class="productImage" src="./src/img/products/<?php echo $product->getImage()[0];?>" alt="<?php $product->getName();?>">
        <div class="info">
            <div class="spec">
                <p>Memory:</p>
                <p><?= $product->getMemory(); ?>GB</p>
            </div>
            <div class="spec">
                <p>Storage:</p>
                <p><?= $product->getStorage(); ?>GB</p>
            </div>
        </div>
        <div class="price">
            <p><?= $product->getPrice(); ?>€</p>
            <button class="addCart" data-product="<?= $product->getId(); ?>" data-price="<?= $product->getPrice(); ?>" data-name="<?= $product->getName(); ?>" data-image="<?= $product->getImage()[0]; ?>">
                <img class="cart" src="./src/img/shoppingCartBlue.png" alt="add to cart">
                ADD TO CART
            </button>
        </div>
    </div>
    
</article>