<?php
declare(strict_types=1);

namespace Model;

class Product
{
    public int $id;
    public string $name;
    public string $description;
    public float $price;
    public string $created_at;

    public function __construct(int $id, string $name, string $description, float $price, string $created_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->created_at = $created_at;
    }
}