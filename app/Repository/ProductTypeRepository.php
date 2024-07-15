<?php
namespace App\Repository;

use App\config\database;
use App\Models\ProductType;

class ProductTypeRepository {
    public function add(ProductType $productType) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO product_types (name) VALUES (?)");
        $stmt->execute([$productType->name]);
    }

    public function find($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM product_types WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();
        if ($data) {
            $productType = new ProductType();
            $productType->id = $data['id'];
            $productType->name = $data['name'];
            return $productType;
        }
        return null;
    }

    public function getAllProductTypes()
    {
        return "SELECT * FROM product_types";
    }

    public function createProductType($data)
    {
        return "INSERT INTO product_types (name, description) VALUES ('{$data['name']}', '{$data['description']}')";
    }

    public function getProductTypeById($id)
    {
        return "SELECT * FROM product_types WHERE id = {$id}";
    }

    public function updateProductType($id, $data)
    {
        return "UPDATE product_types SET name = '{$data['name']}', description = '{$data['description']}' WHERE id = {$id}";
    }

    public function deleteProductType($id)
    {
        return "DELETE FROM product_types WHERE id = {$id}";
    }
}