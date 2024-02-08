<?php

require_once("database.php");

class Company extends Database {
    public static function getCompanyInfo(){
        $db = self::connect();
        $sql = "SELECT * FROM companyInfo";
        $statement = $db->prepare($sql);
        $statement->execute();

        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $data = ['name' => $row['name'], 'direction' => $row['direction'], 'email' => $row['email'], 'cif' => $row['cif'], 'phone' => $row['phone']];
        }
        return $data;
    }
}

?>