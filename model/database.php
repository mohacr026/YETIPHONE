<?php
class Database {
    private static $db;

    public static function connect() {
        if (self::$db === null) {
            $servername = "localhost";
            $port = "5432";
            $dbname = "yetiphone";
            $username = "yetiphone";
            $password = "yetiphone";

            // Create instance of PDO
            self::$db = new PDO("pgsql:host=$servername;port=$port;dbname=$dbname", $username, $password);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$db;
    }
}
?>
