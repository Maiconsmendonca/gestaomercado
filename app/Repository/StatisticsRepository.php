<?php

namespace App\Repository;

use App\config\database;
use App\Models\Statistics;
use Exception;
use PDO;
use PDOException;

class StatisticsRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function getAllStatistics()
    {
        var_dump('estamos aqui');exit;

        try {
            $stmt = $this->pdo->query("
                SELECT
                    (SELECT SUM(quantity) FROM sale_items) AS total_items_sold,
                    (SELECT SUM(total_amount) FROM sale_items) AS total_sales_value,
                    (SELECT COUNT(*) FROM products) AS total_products_registered,
                    (SELECT COUNT(*) FROM product_types) AS total_categories_registered,
                    (SELECT SUM(quantity) FROM sale_items GROUP BY product_id) AS total_items_sold_by_product
            ");

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return new Statistics(
                $result['total_items_sold'] ?? 0,
                $result['total_sales_value'] ?? 0,
                $result['total_products_registered'] ?? 0,
                $result['total_categories_registered'] ?? 0,
                $result['total_items_sold_by_product'] ?? 0
            );
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar estatísticas: " . $e->getMessage());
        }
    }
}
