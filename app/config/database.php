<?php
class Database {
    private static $instance = null;
    private $connection;

    // Database configurations
    private $host = 'localhost';
    private $db_name = 'your_database_name';
    private $username = 'root'; // Default for local servers
    private $password = '';     // Default for local servers

    // Private constructor prevents direct instantiation outside of this class
    private function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";
            
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throws exceptions on errors
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Returns associative arrays by default
                PDO::ATTR_EMULATE_PREPARES   => false,                  // Turns off emulation for genuine prepared statements
            ];

            $this->connection = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            // In development, you want to see the error. In production, log it securely instead.
            die("Database Connection Error: " . $e->getMessage());
        }
    }

    // Static method to get the single instance of the database connection
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->connection;
    }
}
?>