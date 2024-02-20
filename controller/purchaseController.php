<?php 
require_once("./model/purchase.php");
require_once("./model/product.php");
require_once("./model/productDetails.php");
require_once("./model/company.php");
require_once("./model/user.php");
require_once("./model/category.php");

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
        
        $categories = Category::fetchCategory(["isactive" => "true"]);
        include("./view/adminPurchase/purchase.php");
    }
    public function showPurchaseInformation(){
        if (isset($_GET['purchase'])) {
            $purchase = unserialize(urldecode($_GET['purchase']));
            $details = ProductDetails::fetchDetails(['purchase_id' => $purchase->getId()]);
            $products = [];
            foreach($details as $detail){
                $products = array_merge($products, Product::fetchProducts(['id' => $detail->getProductId()]));
            }
            foreach($products as $product){
                $details[$product->getId()] = ProductDetails::fetchDetails(['purchase_id' => $purchase->getId()]);
            }
        }
        $categories = Category::fetchCategory(["isactive" => "true"]);
        include("./view/adminPurchase/editPurchase.php");
    }

    public function printPDF(){
        ob_clean();
        $data = Company::getCompanyInfo();
        // $purchaseData = Purchase::fetchPurchases(['id' => $_GET['id'] ])[0];
        $user = User::fetchUsers(['dni' => $_SESSION['dni']])[0];
        $purchaseData = Purchase::fetchPurchases(['id' => $_GET['id'] ])[0];
        $productsData = ProductDetails::fetchDetails(['purchase_id' => $purchaseData->getId()]);
        $products = array();
        foreach($productsData as $product){
            array_push($products, ['product_name' => Product::fetchProducts(['id' => $product->getProductId()])[0]->getName(), 'count' => $product->getQuantity(), 'price' => Product::fetchProducts(['id' => $product->getProductId()])[0]->getPrice()] );
        }
        $admin = User::getAdmin("admin@gmail.com");
        $adminName = preg_replace('/@.*$/', '',$admin['email']);
        include("./view/adminPurchase/printPDF.php");
    }

    public function userPurchases(){
        $purchases = Purchase::fetchPurchases(['id_user' => $_SESSION['email']]);
        $categories = Category::fetchCategory(["isactive" => "true"]);
        include("./view/user/userPurchases.php");
    }

    public function userPurchaseDetails(){
        if(isset($_GET['id'])){
            $purchaseDetail = ProductDetails::fetchDetails(['purchase_id' => $_GET['id']]);
            $purchaseData = [];
            foreach($purchaseDetail as $purchase){
                $product = Product::fetchProducts(['id' => $purchase->getProductId()])[0];
                array_push($purchaseData, ['name' => $product->getName(), 'image' => $product->getImage()[0], 'price' => $product->getPrice(), 'quantity' => $purchase->getQuantity()]);
            }
            $categories = Category::fetchCategory(["isactive" => "true"]);
            include("./view/user/userPurchaseDetails.php");
        } else {
            echo "<script>alert('An error ocurred, try again later')</script>";
            echo "<meta http-equiv='refresh' content='0; url=index.pxp?controller=Purchase&action=userPurchases'>";
        }
    }
}

?>