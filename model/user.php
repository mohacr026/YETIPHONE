<?php
require_once("database.php");

class User extends Database {
    //Attributes
    private $dni;
    private $email;
    private $password;
    private $phoneNumber;
    private $name;
    private $surname;
    private $direction;
    private $isActive;

    //Constructor
    public function __construct($dni, $email, $password, $phoneNumber = null, $name, $surname, $direction = null, $isActive = true){
        $this->dni = $dni;
        $this->email = $email;
        $this->password = $password;
        $this->phoneNumber = $phoneNumber;
        $this->name = $name;
        $this->surname = $surname;
        $this->direction = $direction;
        $this->isActive = $isActive;
    }

    //Setters & Getters
    public function getDni(){
        return $this->dni;
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }

    public function getPassword(){
        return $this->password;
    }
    public function setPassword($password){
        $this->password = $password;
    }

    public function getPhoneNumber(){
        return $this->phoneNumber;
    }
    public function setPhoneNumber($phoneNumber){
        $this->phoneNumber = $phoneNumber;
    }

    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
    }

    public function getSurname(){
        return $this->surname;
    }
    public function setSurname($surname){
        $this->surname = $surname;
    }

    public function getDirection(){
        return $this->direction;
    }
    public function setDirection($direction){
        $this->direction = $direction;
    }
    
    public function getIsActive(){
        return $this->isActive;
    }
    public function setIsActive($isActive){
        $this->isActive = $isActive;
    }

    //Class methods
    public function checkLogin(){
        $db = User::connect();

        $sql = "SELECT * FROM admin";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $exists = false;
        $passOK = false;
        $isAdmin = false;
        // TODO: Falta comprobar si el user esta activo o no

        foreach ($result as $key => $adminArr) {
            if($this->getEmail() == $adminArr['email'] && $exists == false) {
                $exists = true;

                if(md5($this->getPassword()) == $adminArr['pass']) {
                    $passOK = true;
                    $isAdmin = true;
                    $_SESSION['email'] = $adminArr['email'];
                    $_SESSION['role'] = "admin";
                }
            }
        }

        $sql = "SELECT * FROM users";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $key => $userArr) {
            if($this->getEmail() == $userArr['email'] && $exists == false) {
                $exists = true;

                if(md5($this->getPassword()) == $userArr['password']) {
                    $passOK = true;

                    $_SESSION['dni'] = $userArr['dni'];
                    $_SESSION['email'] = $userArr['email'];
                    $_SESSION['name'] = $userArr['username'];
                    $_SESSION['role'] = "user";
                }
            }
        }

        if($exists) {
            if($passOK) {
                if($isAdmin) return "loginAdm";
                else return "login";
            }
            else return "badPass";
        } else return "noUser";
    }

    //Static methods
    public static function register(array $data = []){
        //Connect into the database
        $db = self::connect();
        
        //SQL basic query, we'll modify it later if needed
        $sql = "INSERT INTO users";

        $columns = array_keys($data);
        $values = [];

        foreach($data as $value){
            $values[] = $value;
        }
        
        //This code creates a dynamic SQL query based on the filters given by the parameters
        if(!empty($data)){

            $valuesWithQuotes = [];
            foreach ($values as $value) {
                if (is_string($value)) {
                    $valuesWithQuotes[] = "'" . $value . "'";
                } else {
                    $valuesWithQuotes[] = $value;
                }
            }

            $sql .= "(". implode(', ', $columns).") VALUES(". implode(', ', $valuesWithQuotes).")";

            //Here the SQL query prepares and bind the given parameters on its values to execute the filters
            $statement = $db->prepare($sql);
    
            $result = $statement->execute();
        }

        return $result;
    }

    public static function fetchUsers(array $filters = []){
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
        $sql = "SELECT * FROM users";

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
        $users = [];
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $users[] = new User($row['dni'], $row['email'], $row['password'], $row['phone_number'], $row['username'], $row['surname'], $row['direction'], $row['isactive'] );
        }
        return $users;
    }
}
?>