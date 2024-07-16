<?php

namespace App\Repository;

use App\config\database;
use App\Models\Product;
use http\Env\Request;
use PDO;
use PDOException;

class ProductRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function getProductById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return new Product($row['id'], $row['name'], $row['type_id'], $row['unit_price']);
    }

    public function getAll()
    {
        try {
            $stmt = $this->pdo->query("SELECT products.id, products.name, products.price, product_types.tax_rate FROM products JOIN product_types ON products.productTypeId = product_types.id;");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($rows)) {
                // Se não houver dados, retorna um array vazio
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

    public function update(Product $product)
    {
        foreach ($this->products as &$p) {
            if ($p->getId() == $product->getId()) {
                $p = $product;
                return true;
            }
        }
        return false;
    }

    public function delete($id)
    {
        foreach ($this->products as $key => $product) {
            if ($product->getId() == $id) {
                unset($this->products[$key]);
                return true;
            }
        }
        return false;
    }
}