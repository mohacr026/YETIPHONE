<?php
class Database{

    public function connect(){
        $servername = "localhost";
        $dbname= "yetiphone";
        $username = "yetiphone";
        $password = "yetiphone";

        // Create instance of PDO
		$this->db = new PDO("pgsql:host=$servername;dbname=$dbname",$username, $password);
		
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         return $this->db;
    }
}
?>