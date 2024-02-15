<?php
require_once("database.php");

class User extends Database {
    //Attributes
    /** @var string $dni The user's DNI (Documento Nacional de Identidad). */
    private $dni;
    /** @var string $email The user's email address. */
    private $email;
    /** @var string $password The user's password. */
    private $password;
    /** @var string|null $phoneNumber The user's phone number. */
    private $phoneNumber;
    /** @var string $name The user's name. */
    private $name;
    /** @var string $surname The user's surname. */
    private $surname;
    /** @var string|null $direction The user's address. */
    private $direction;
    /** @var bool $isActive Indicates if the user is active or not. */
    private $isActive;

    //Constructor
    /**
     * User constructor.
     * @param string $dni The user's DNI.
     * @param string $email The user's email address.
     * @param string $password The user's password.
     * @param string|null $phoneNumber The user's phone number. (Optional)
     * @param string $name The user's name.
     * @param string $surname The user's surname.
     * @param string|null $direction The user's address. (Optional)
     * @param bool $isActive Indicates if the user is active or not. (Optional, default is true)
     */
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
    /**
     * Get the user's DNI.
     * @return string The user's DNI.
     */
    public function getDni(){
        return $this->dni;
    }

    /**
     * Get the user's email address.
     * @return string The user's email address.
     */
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }

    /**
     * Get the user's password.
     * @return string The user's password.
     */
    public function getPassword(){
        return $this->password;
    }
    /**
     * Set the user's password.
     * @param string $password The user's password.
     */
    public function setPassword($password){
        $this->password = $password;
    }

    /**
     * Get the user's phone number.
     * @return string|null The user's phone number.
     */
    public function getPhoneNumber(){
        return $this->phoneNumber;
    }
    /**
     * Set the user's phone number.
     * @param string|null $phoneNumber The user's phone number.
     */
    public function setPhoneNumber($phoneNumber){
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Get the user's name.
     * @return string The user's name.
     */
    public function getName(){
        return $this->name;
    }
    /**
     * Set the user's name.
     * @param string $name The user's name.
     */

    public function setName($name){
        $this->name = $name;
    }
    /**
     * Get the user's surname.
     * @return string The user's surname.
     */
    public function getSurname(){
        return $this->surname;
    }
    /**
     * Set the user's surname.
     * @param string $surname The user's surname.
     */
    public function setSurname($surname){
        $this->surname = $surname;
    }

    /**
     * Get the user's address.
     * @return string|null The user's address.
     */
    public function getDirection(){
        return $this->direction;
    }

    /**
     * Set the user's address.
     * @param string|null $direction The user's address.
     */
    public function setDirection($direction){
        $this->direction = $direction;
    }
    
    /**
     * Get the user's active status.
     * @return boolean The user's active status.
     */
    public function getIsActive(){
        return $this->isActive;
    }
    /**
     * Sets the user's active status
     * @param boolean $isActive The user's active status.
     */
    public function setIsActive($isActive){
        $this->isActive = $isActive;
    }

    //Class methods
    /**
     * Check user login credentials.
     * @return string Indicates the login status: "loginAdm" for admin login, "login" for user login, "badPass" for incorrect password, "noUser" for user not found.
     */
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
    /**
     * Register a new user.
     * @param array $data An array containing user data.
     * @return bool Indicates whether the registration was successful.
     */
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

    /**
     * Fetch users from the database based on given filters.
     * @param array $filters An array containing filters for the query.
     * @return array An array of User objects matching the filters.
     */
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

    public static function getAdmin($email){
        $db = self::connect();
        $sql = "SELECT * FROM admin WHERE email = :email";
        $statement = $db->prepare($sql);

        $statement->bindParam(":email", $email);
        $statement->execute();

        $admin = $statement->fetch(PDO::FETCH_ASSOC);
        return $admin;
    }
}
?>