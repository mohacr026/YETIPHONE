<?php
/**
 * Class Database - Represents a database connection.
 */
class Database {
    /** @var PDO|null $db The PDO database connection instance. */
    private static $db;

    /**
     * Establishes a connection to the database.
     * @return PDO The PDO database connection instance.
     */
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

        // Return the PDO database connection instance
        return self::$db;
    }
}
?>
