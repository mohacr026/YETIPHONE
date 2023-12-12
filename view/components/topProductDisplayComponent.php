<div>
    <img src="./src/img/<?= $product->getImage() ?>">
    
    <span>Product id: <?= $product->getId() ?></span><br>
    <span>Product name: <?= $product->getName() ?></span><br>
    <span>Quantity: <?= $details[$product->getId()]->getQuantity() ?></span><br>
</div>