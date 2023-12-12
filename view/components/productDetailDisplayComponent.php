<div class="productDetailDisplay">
    <span><?= $product->getId() ?></span>
    <span><?= $product->getName() ?></span>
    <img src="./src/img/<?= $product->getImage() ?>">
    <span><?= $details[$product->getId()]->getQuantity() ?></span>
</div>