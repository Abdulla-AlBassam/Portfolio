<?php
namespace Controller;

use PDO;
use Exception;

class AwardController {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAllAwards() {
        $stmt = $this->db->prepare("SELECT id AS award_id, name FROM award");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createAward($data) {
        if (!isset($data['name'])) {
            return ["error" => "Award name is required"];
        }

        try {
            $stmt = $this->db->prepare("INSERT INTO award (name) VALUES (:name)");
            $stmt->execute(["name" => $data['name']]);
            return ["message" => "Award created", "award_id" => $this->db->lastInsertId()];
        } catch (Exception $e) {
            return ["error" => "Failed to create award: " . $e->getMessage()];
        }
    }

    public function updateAward($data) {
        if (!isset($data['award_id']) || !isset($data['name'])) {
            return ["error" => "Award ID and new name are required"];
        }

        try {
            $stmt = $this->db->prepare("UPDATE award SET name = :name WHERE id = :award_id");
            $stmt->execute(["name" => $data['name'], "award_id" => $data['award_id']]);
            return ["message" => "Award updated"];
        } catch (Exception $e) {
            return ["error" => "Failed to update award: " . $e->getMessage()];
        }
    }

    public function deleteAward($data) {
        if (!isset($data['award_id'])) {
            return ["error" => "Award ID is required"];
        }

        try {
            $stmt = $this->db->prepare("DELETE FROM award WHERE id = :award_id");
            $stmt->execute(["award_id" => $data['award_id']]);
            return ["message" => "Award deleted"];
        } catch (Exception $e) {
            return ["error" => "Failed to delete award: " . $e->getMessage()];
        }
    }

    public function assignAwardToContent($data) {
        if (!isset($data['content_id']) || !isset($data['award_id'])) {
            return ["error" => "Content ID and Award ID are required"];
        }

        try {
            $stmt = $this->db->prepare("INSERT INTO content_has_award (content, award) VALUES (:content_id, :award_id)");
            $stmt->execute(["content_id" => $data['content_id'], "award_id" => $data['award_id']]);
            return ["message" => "Award assigned to content successfully"];
        } catch (Exception $e) {
            return ["error" => "Failed to assign award: " . $e->getMessage()];
        }
    }

    public function removeAwardFromContent($data) {
        if (!isset($data['content_id'])) {
            return ["error" => "Content ID is required"];
        }

        try {
            $stmt = $this->db->prepare("DELETE FROM content_has_award WHERE content = :content_id");
            $stmt->execute(["content_id" => $data['content_id']]);
            return ["message" => "Award removed from content successfully"];
        } catch (Exception $e) {
            return ["error" => "Failed to remove award: " . $e->getMessage()];
        }
    }
}