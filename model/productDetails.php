<?php
require_once("database.php");
class ProductDetails extends Database {
    // Attributes
    private $id;
    private $product_id;
    private $quantity;

    // Constructor
    public function __construct($id, $product_id, $quantity){
        $this->id = $id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }

    // Getters and Setters
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function getProductId(){
        return $this->product_id;
    }
    public function setProductId($product_id){
        $this->product_id = $product_id;
    }

    public function getQuantity(){
        return $this->quantity;
    }
    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }

    // Methods
    public static function fetchDetails(array $filters = []){
        /* 
            Example of $filters array application
            $filters = [
                'user_id' => 456,
                'status' => 'shipped',
                'startDate' => '2023-10-01',
                'endDate' => '2023-10-15',
            ];
            $records = Product::fetchPurchases($filters);
        */

        //Connect into the database
        $db = self::connect();
        
        //SQL basic query, we'll modify it later if needed
        $sql = "SELECT * FROM purchase_details";

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
        $details = [];
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $details[] = new ProductDetails($row['id'], $row['product_id'], $row['quantity']);
        }
        return $details;
    }
}

?>