<?php 
require_once("./model/purchase.php");
require_once("./model/product.php");
require_once("./model/productDetails.php");
class PurchaseController {
    public function showPurchases(){
        $filters = [];
        if(isset($_POST)){
            if(isset($_GET['purchase'])) {
                $purchase = unserialize(urldecode($_GET['purchase']));
                $purchase->setStatus($_POST['status']);
                $purchase->updateStatus();
            }
            if(isset($_POST['purchase_id']) && !empty($_POST['purchase_id'])){
                $filters['id'] = (int) $_POST['purchase_id'];
            }
            if(isset($_POST['user_id']) && !empty($_POST['user_id'])){
                $filters['id_user'] = $_POST['user_id'];
            }
            if(isset($_POST['status']) && $_POST['status'] != "NOSTATE"){
                $filters['status'] = $_POST['status'];
            }
            if(isset($_POST['dateOrder']) && !empty($_POST['dateOrder'])){
                $filters['date_order'] = $_POST['dateOrder'];
            }
            if(isset($_POST['dateShipment']) && !empty($_POST['dateShipment'])){
                $filters['date_shipment'] = $_POST['dateShipment'];
            }
        }
        $purchases = Purchase::fetchPurchases($filters);
        include("./view/adminPurchase/purchase.php");
    }
    public function showPurchaseInformation(){
        if (isset($_GET['purchase'])) {
            $purchase = unserialize(urldecode($_GET['purchase']));
            $products = Product::fetchProducts(['id' => $purchase->getId()]);
            $details = [];
            foreach($products as $product){
                $details[$product->getId()] = ProductDetails::fetchDetails(['id' => $purchase->getPurchaseDetails()])[0];
            }
        }
        include("./view/adminPurchase/editPurchase.php");
    }
}

?>