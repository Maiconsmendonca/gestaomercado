<?php

namespace App\Repository;

use App\config\database;
use App\Models\ProductType;
use PDO;
use PDOException;

class ProductTypeRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

//    public function add(ProductType $productType)
//    {
//        $db = Database::getInstance();
//        $stmt = $db->prepare("INSERT INTO product_types (name) VALUES (?)");
//        $stmt->execute([$productType->name]);
//    }
//
//    public function getProductTypeById($id)
//    {
//        $pdo = Database::getConnection();
//        $stmt = $pdo->prepare("SELECT * FROM product_types WHERE id = :id");
//        $stmt->execute(['id' => $id]);
//        $row = $stmt->fetch();
//        return new ProductType($row['id'], $row['name'], $row['tax_porcentage']);
//    }

    public function getAll()
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM product_types WHERE deleted_at IS NULL");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($rows)) {
                return [];
            }

            $productTypes = [];
            foreach ($rows as $row) {
                $productTypes[] = new ProductType($row);
            }

            return $productTypes;
        } catch (PDOException $e) {
            error_log("Erro ao buscar tipos de produtos: " . $e->getMessage());
            return [];
        }
    }

    public function getById($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM product_types WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                return null;
            }

            return new ProductType($row);
        } catch (PDOException $e) {
            die("Erro ao buscar tipo de produtos: " . $e->getMessage());
        }
    }

    public function insertProductType(ProductType $productType)
    {
        $sql = "INSERT INTO product_types (name, tax_porcentage) VALUES (?, ?)";

        try {
            $stmt = Database::getInstance()->prepare($sql);
            $stmt->execute([$productType->getName(), $productType->getTaxPorcentage()]);
            $productTypeId = Database::getInstance()->lastInsertId();
            $productType->setId($productTypeId);
        } catch (PDOException $e) {
            die("Erro ao inserir o typo de produto: " . $e->getMessage());
        }
    }

    public function update($id, $fields)
    {
        $sqlParts = [];
        $values = [];
        // Mapeamento de campos camelCase para snake_case
        $fieldMapping = [
            'taxPorcentage' => 'tax_porcentage',
            // Adicione mais mapeamentos conforme necessário
        ];

        foreach ($fields as $key => $value) {
            $key = $fieldMapping[$key] ?? $key;
            $sqlParts[] = "$key = ?";
            $values[] = $value;
        }

        if (empty($sqlParts)) {
            return false;
        }

        $sql = "UPDATE product_types SET " . implode(", ", $sqlParts) . " WHERE id = ?";
        $values[] = $id;

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($values);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id)
    {
        $sql = "UPDATE product_types SET deleted_at = NOW() WHERE id = ?";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
}