<?php

namespace Config;
use PDO;
use PDOException;

class Database {
    private $db_file;
    private $conn;

    public function __construct() {
        $this->db_file = __DIR__ . "/chi2023.sqlite";  // Adjust path if necessary
    }

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("sqlite:" . $this->db_file);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo json_encode(["error" => "Database connection failed: " . $exception->getMessage()]);
        }
        return $this->conn;
    }
}