<?php
class ProductComponent {
    private $__product;

    public function __construct($product){
        $this->__product = $product;
    }

    public function render(){
        $productName = $this->__product->getName();
        $productId = $this->__product->getId();
        echo "<div class='productComponent'>";
        echo "  <div class='product'>";
        echo "      $productName";
        echo "      <a href='index.php?controller=Product&action=editproduct&id=$productId'>Edit</a>";
        echo "      <a>Disable</a>";
        echo "  </div>";
        echo "</div>";
    }
    
}
?>