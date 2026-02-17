<?php

require_once "src/Config/Database.php";

$database = new Config\Database();
$db = $database->getConnection();

$query = $db->query("SELECT * FROM author LIMIT 5"); // Change table name if needed
$authors = $query->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($authors, JSON_PRETTY_PRINT);