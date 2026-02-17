<?php

declare(strict_types=1);

namespace Controller;

use Model\Product;
use PDO;

class ProductController
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllProducts(): array
    {
        $stmt = $this->db->query('SELECT * FROM products');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        return $product ?: null;
    }

    public function createProduct(array $data): ?array
    {
        $stmt = $this->db->prepare(
            'INSERT INTO products (name, description, price) VALUES (:name, :description, :price)'
        );

        $success = $stmt->execute([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price']
        ]);

        if ($success) {
            $id = (int) $this->db->lastInsertId();
            return $this->getProductById($id);
        }
        return null;
    }

    public function updateProduct(int $id, array $data): ?array
    {
        $stmt = $this->db->prepare(
            'UPDATE products SET name = :name, description = :description, price = :price WHERE id = :id'
        );

        $success = $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price']
        ]);

        return $success ? $this->getProductById($id) : null;
    }

    public function deleteProduct(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
