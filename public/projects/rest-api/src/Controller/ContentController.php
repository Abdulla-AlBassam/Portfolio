<?php
namespace Controller;

use PDO;
use PDOException;

class ContentController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllContent($search = null, $page = 1, $contentId = null, $authorId = null) {
        try {
            $limit = 10;
            $offset = ($page - 1) * $limit;
            $query = "SELECT 
                        content.id AS content_id, content.title, content.abstract, 
                        content.doi_link, content.preview_video, 
                        type.name AS type, award.name AS award 
                      FROM content
                      LEFT JOIN type ON content.type = type.id
                      LEFT JOIN content_has_award ON content.id = content_has_award.content
                      LEFT JOIN award ON content_has_award.award = award.id
                      WHERE 1=1";

            if ($contentId) {
                $query .= " AND content.id = :contentId";
            }
            if ($authorId) {
                $query .= " AND content.id IN (SELECT content_id FROM content_author WHERE author_id = :authorId)";
            }
            if ($search) {
                $query .= " AND (content.title LIKE :search OR content.abstract LIKE :search)";
            }

            $query .= " LIMIT :limit OFFSET :offset";
            $stmt = $this->db->prepare($query);

            if ($contentId) {
                $stmt->bindValue(":contentId", $contentId, PDO::PARAM_INT);
            }
            if ($authorId) {
                $stmt->bindValue(":authorId", $authorId, PDO::PARAM_INT);
            }
            if ($search) {
                $stmt->bindValue(":search", "%$search%", PDO::PARAM_STR);
            }
            $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
            $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["error" => $e->getMessage()];
        }
    }
}