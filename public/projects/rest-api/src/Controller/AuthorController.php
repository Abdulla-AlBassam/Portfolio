<?php
namespace Controller;

use PDO;
use PDOException;

class AuthorController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllAuthors($search = null, $page = 1, $authorId = null, $contentId = null) {
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $query = "
            SELECT author.id AS author_id, author.name
            FROM author
            LEFT JOIN content_has_author ON author.id = content_has_author.author
            WHERE 1=1
        ";
    
        if ($contentId) {
            $query .= " AND content_has_author.content = :contentId";
        }
    
        if ($search) {
            $query .= " AND (author.name LIKE :search)";
        }
    
        $query .= " LIMIT :limit OFFSET :offset";
    
        $stmt = $this->db->prepare($query);
    
        if ($contentId) {
            $stmt->bindValue(":contentId", $contentId, PDO::PARAM_INT);
        }
        if ($search) {
            $stmt->bindValue(":search", "%$search%", PDO::PARAM_STR);
        }
    
        $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
    
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["error" => $e->getMessage()];
        }
    }
}