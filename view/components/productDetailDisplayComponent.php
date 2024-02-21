<div class="productDetailDisplay">
    <span><?= $product->getId() ?></span>
    <span><?= $product->getName() ?></span>
    <img src="./src/img/products/<?= $product->getImage()[0] ?>" alt="<?= $product->getName() ?>'s image">
    <span><?= $details[$product->getId()][0]->getQuantity() ?></span>
</div>