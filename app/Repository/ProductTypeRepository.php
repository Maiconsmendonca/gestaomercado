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

    public function getProductTypeById($id)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM product_types WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return new ProductType($row['id'], $row['name'], $row['tax_rate']);
    }

    public function getAllProductTypes()
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT * FROM product_types");
        $productTypes = [];
        while ($row = $stmt->fetch()) {
            $productTypes[] = new ProductType($row['id'], $row['name'], $row['tax_rate']);
        }
        return $productTypes;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM product_types";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM product_types WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert(ProductType $productType)
    {
        $sql = "INSERT INTO product_types (name, tax_percentage) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$productType->getName(), $productType->getTaxPercentage()]);
        $productType->setId($this->pdo->lastInsertId());
        return $productType;
    }

    public function update(ProductType $productType)
    {
        $sql = "UPDATE product_types SET name = ?, tax_percentage = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$productType->getName(), $productType->getTaxPercentage(), $productType->getId()]);
        return $stmt->rowCount() > 0;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM product_types WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }
}