<?php
class Database {
    private static $db;

    public static function connect() {
        if (self::$db === null) {
            $servername = "localhost";
            $dbname = "yetiphone";
            $username = "yetiphone";
            $password = "yetiphone";

            // Create instance of PDO
            self::$db = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$db;
    }
}

?>