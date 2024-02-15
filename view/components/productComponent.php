<?php
class ProductComponent {
    private $__product;

    public function __construct($product){
        $this->__product = $product;
    }

    public function render(){
        $productName = $this->__product->getName();
        $productId = $this->__product->getId();
        $productStatus = $this->__product->getIsActive();

        echo "<div class='productComponent2'>";
        echo "<div class='product2'>";
        echo "<p class='productName'>$productName</p>";
        echo "<a href='index.php?controller=Product&action=editproduct&id=$productId'>Edit</a>";
        $statusMessage = $productStatus ? "Disable" : "Enable";
        echo "<a href='index.php?controller=Product&action=toggleProduct&id=$productId'>$statusMessage</a>";
        echo "</div>";
        echo "</div>";
    }
    
}
?>