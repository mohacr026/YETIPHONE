<?php

class Database{
   
    
    public function conectar(){
        $servername = "localhost";
        $dbname= "notas_master";
        $username = "root";
        $password = "";

        //creem una nova connexió instancinat l'objecte PDO
		$this->db = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
		// establim el mode PDO error a exception per poder
		// recuperar les excepccions
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         return $this->db;
    
    }
    
    
    
}

