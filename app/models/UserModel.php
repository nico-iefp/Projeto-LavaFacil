<?php
require_once 'config/Database.php';

class UserModel {
    private $db;

    public function __construct() {
        // Fetch the active PDO connection instance smoothly
        $this->db = Database::getInstance();
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }
}
?>