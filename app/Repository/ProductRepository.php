<?php
namespace App\Repository;

use App\config\database;

class ProductRepository {
    public function insertProduct($product) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO produtos (name, productTypeId, prico) VALUES (?, ?, ?)");
        $stmt->execute([$product->name, $product->productTypeId, $product->prico]);
    }
}