<?php 
require_once 'database.php';
class Purchase extends Database {
    // Attributes
    private $id;
    private $userId;
    private $purchaseDetails;
    private $status;
    private $dateOrder;
    private $dateShipment;

    // Constructor
    /**
     * Constructs a new Purchase object.
     * 
     * @param int $id The ID of the purchase.
     * @param int $userId The ID of the user making the purchase.
     * @param array $purchaseDetails An array of ProductDetails objects representing the purchase details.
     * @param string $status The status of the purchase.
     * @param string $dateOrder The date of the purchase order.
     * @param string|null $dateShipment The date of shipment, or null if not yet shipped.
     */
    public function __construct($id, $userId, $purchaseDetails, $status, $dateOrder, $dateShipment = null){
        $this->id = $id;
        $this->userId = $userId;
        $this->purchaseDetails = $purchaseDetails;
        $this->status = $status;
        $this->dateOrder = $dateOrder;
        $this->dateShipment = $dateShipment;
    }

    // Setter y Getter
    /**
     * Get the ID of the purchase.
     * 
     * @return int The ID of the purchase.
     */
    public function getId(){
        return $this->id;
    }
    /**
     * Set the ID of the purchase.
     * 
     * @param int $id The ID of the purchase.
     */
    public function setId($id){
        $this->id = $id;
    }
    /**
     * Get the ID of the user making the purchase.
     * 
     * @return int The ID of the user making the purchase.
     */
    public function getUserId(){
        return $this->userId;
    }
    /**
     * Set the ID of the user making the purchase.
     * 
     * @param int $userId The ID of the user making the purchase.
     */
    public function setUserId($userId){
        $this->userId = $userId;
    }
    /**
     * Get the purchase details.
     * 
     * @return array An array of ProductDetails objects representing the purchase details.
     */
    public function getPurchaseDetails(){
        return $this->purchaseDetails;
    }
    /**
     * Set the purchase details.
     * 
     * @param array $purchaseDetails An array of ProductDetails objects representing the purchase details.
     */
    public function setPurchaseDetails($purchaseDetails){
        $this->purchaseDetails = $purchaseDetails;
    }
    /**
     * Get the status of the purchase.
     * 
     * @return string The status of the purchase.
     */
    public function getStatus(){
        return $this->status;
    }
    /**
     * Set the status of the purchase.
     * 
     * @param string $status The status of the purchase.
     */
    public function setStatus($status){
        $this->status = $status;
    }
    /**
     * Get the date of the purchase order.
     * 
     * @return string The date of the purchase order.
     */
    public function getDateOrder(){
        return $this->dateOrder;
    }
    /**
     * Set the date of the purchase order.
     * 
     * @param string $dateOrder The date of the purchase order.
     */
    public function setDateOrder($dateOrder){
        $this->dateOrder = $dateOrder;
    }
    /**
     * Get the date of shipment.
     * 
     * @return string|null The date of shipment, or null if not yet shipped.
     */
    public function getDateShipment(){
        return $this->dateShipment;
    }
    /**
     * Set the date of shipment.
     * 
     * @param string|null $dateShipment The date of shipment, or null if not yet shipped.
     */
    public function setDateShipment($dateShipment){
        $this->dateShipment = $dateShipment;
    }

    public static function fetchPurchases(array $filters = []) {
        /* 
            Example of $filters array application
            $filters = [
                'user_id' => 456,
                'status' => 'shipped',
                'startDate' => '2023-10-01',
                'endDate' => '2023-10-15',
            ];
            $records = ClientRecord::fetchPurchases($filters);
        */

        //Connect into the database
        $db = self::connect();
        
        //SQL basic query, we'll modify it later if needed
        $sql = "SELECT * FROM purchase";

        //This code creates a dynamic SQL query based on the filters given by the parameters
        if(!empty($filters)){
            $sql .= " WHERE ";
            // $i is started in 1 because the first clause will be always WHERE not AND
            $i = 1;
            foreach($filters as $field => $value){
                $sql .= "$field = ? ";
                if($i < count($filters)){
                    $sql .= " AND ";
                }
                $i++;
            }

        }

        //Here the SQL query prepares and bind the given parameters on its values to execute the filters
        $statement = $db->prepare($sql);

        if(!empty($filters)){
            $i = 1;
            foreach($filters as $value){
                $statement->bindValue($i++, $value);
            }
        }

        $statement->execute();

        // Adds into the purchases array every purchase the SQL returned
        $purchases = [];
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $purchases[] = new Purchase($row['id'], $row['id_user'], $row['purchase_details_id'], $row['status'], $row['date_order'], $row['date_shipment']);
        }
        return $purchases;
    }
    
    public function updateStatus() {
        
        //Connect into the database
        $db = self::connect();

        $sql = "UPDATE purchase SET status = ?, date_shipment = ? WHERE id = ?";
        
        // Prepare and execute the statement
        $statement = $db->prepare($sql);
        $statement->bindValue(1, $this->status);
        //Updates the shipment date to today (the moment the shipment is marked as shipped) or to null if the status is updated to NULL
        if($this->status === "PENDING"){
            $today = null;
        } else {
            $today = new DateTime('now');
            $today = $today->format('Y-m-d');
        }
        $statement->bindValue(2, $today);
        $statement->bindValue(3, $this->id);
        $statement->execute();
    }


    // TODO - Implement the functions
    public function getProductDetails() {
        // Parse and extract product details from $product_details
        // ...
        // Return an array of product information
    }

    public static function insertPurchase($user, $direction, $province, $city, $zipCode, $details){
        $db = self::connect();

        $sql = 
        "INSERT INTO purchase (id_user, shipment_direction, province, city, zip_code, status, date_order)
        VALUES (:user, :direction, :province, :city, :zipCode, 'PENDING', CURRENT_TIMESTAMP)";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(":user", $user);
        $stmt->bindValue(":direction", $direction);
        $stmt->bindValue(":province", $province);
        $stmt->bindValue(":city", $city);
        $stmt->bindValue(":zipCode", $zipCode);

        $stmt->execute();

        $purchaseId = $db->lastInsertId();

        $detailsSQL = 
        "INSERT INTO purchase_details (purchase_id, product_id, quantity) 
        VALUES (:purchaseId, :productId, :quantity)";
        $stmt2 = $db->prepare($detailsSQL);
        $stmt2->bindParam(":purchaseId", $purchaseId);
        $stmt2->bindParam(":productId", $id);
        $stmt2->bindParam(":quantity", $quantity);

        foreach ($details as $detail) {
            $id = $detail[0];
            $quantity = $detail[1];
            
            $stmt2->bindValue(":productId", $id);
            $stmt2->bindValue(":quantity", $quantity);
            
            $stmt2->execute();
        }

    }

}
?> 