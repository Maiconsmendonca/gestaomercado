<?php

namespace App\Repository;

use App\config\database;
use App\Models\Product;
use http\Env\Request;
use PDO;
use PDOException;

/**
 *
 */
class ProductRepository
{
    /**
     * @var PDO|null
     */
    private $pdo;

    /**
     *
     */
    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    /**
     * @param $id
     * @return Product|void|null
     */
    public function getById($id)
    {
        try {
            $stmt = $this->pdo->prepare("
                        SELECT products.*, product_types.tax_percentage
                        FROM products 
                        JOIN product_types ON products.productTypeId = product_types.id 
                        WHERE products.id = :id");
            $stmt->execute(['id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                return null;
            }

            return new Product($row);
        } catch (PDOException $e) {
            die("Erro ao buscar produtos: " . $e->getMessage());
        }
    }

    /**
     * @return array|void
     */
    public function getAll()
    {
        try {
            $stmt = $this->pdo->query(
                "SELECT products.id, products.name, products.price, product_types.tax_percentage, products.productTypeId
            FROM products
            JOIN product_types ON products.productTypeId = product_types.id
            WHERE products.deleted_at IS NULL;");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($rows)) {
                return [];
            }

            $products = [];
            foreach ($rows as $row) {
                $products[] = new Product($row);
            }

            return $products;
        } catch (PDOException $e) {
            die("Erro ao buscar produtos: " . $e->getMessage());
        }
    }

    /**
     * @param Product $product
     * @return void
     */
    public function insertProduct(Product $product): void
    {

        $sql = "INSERT INTO products (name, productTypeId, price) VALUES (?, ?, ?)";

        try {
            $stmt = Database::getInstance()->prepare($sql);
            $stmt->execute([$product->getName(), $product->getProductTypeId(), $product->getPrice()]);
            $productId = Database::getInstance()->lastInsertId();
            $product->setId($productId);
        } catch (PDOException $e) {
            die("Erro ao inserir o produto: " . $e->getMessage());
        }
    }

    /**
     * @param $id
     * @param $fields
     * @return bool
     */
    public function update($id, $fields)
    {
        $sqlParts = [];
        $values = [];

        foreach ($fields as $key => $value) {
            $sqlParts[] = "$key = ?";
            $values[] = $value;
        }

        if (empty($sqlParts)) {
            return false;
        }

        $sql = "UPDATE products SET " . implode(", ", $sqlParts) . " WHERE id = ?";
        $values[] = $id;

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($values);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $sql = "UPDATE products SET deleted_at = NOW() WHERE id = ?";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
}