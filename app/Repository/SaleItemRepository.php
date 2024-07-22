<?php

namespace App\Repository;

use App\config\database;
use App\Models\SaleItem;
use Exception;
use PDOException;

class SaleItemRepository
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function createSaleItem($saleId, SaleItem $item)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO sale_items (sale_id, product_id, quantity, unit_price, tax, tax_percentage, tax_amount, total_amount, total_amount_with_tax) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $saleId,
                $item->getProductId(),
                $item->getQuantity(),
                $item->getPrice(),
                $item->getTax(),
                $item->getTaxPercentage(),
                $item->getTaxAmount(),
                $item->getTotalAmount(),
                $item->getTotalAmountWhitTax(),
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao inserir item de venda: " . $e->getMessage());
        }
    }
}