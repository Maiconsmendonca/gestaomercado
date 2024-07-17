<?php

namespace App\Repository;

use App\config\database;
use App\Helper\CalculateHelper;
use App\Models\SaleItem;
use App\Repository\SaleItemRepository;
use Exception;
use PDOException;

class SaleRepository
{
    private $pdo;
    private SaleItemRepository $saleItemRepository;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
        $this->saleItemRepository = new SaleItemRepository();
    }

    public function createSale($saleData)
    {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("INSERT INTO sales (date) VALUES (NOW())");
            $stmt->execute();
            $saleId = $this->pdo->lastInsertId();

            foreach ($saleData as $itemData) {
                $tax = CalculateHelper::calculateTax($itemData->getTaxPorcentage(), $itemData->getPrice());
                $itemData->setTax($tax);

                $taxAmount = CalculateHelper::calculateTotalTax($itemData->getTax(), $itemData->getQuantity());
                $itemData->setTaxAmount($taxAmount);

                $totalAmount = CalculateHelper::calculateTotalPrice($itemData->getPrice(), $itemData->getQuantity());
                $itemData->setTotalAmount($totalAmount);

                $totalAmountWhitTax = CalculateHelper::calculateTotalWithTax($itemData->getPrice(), $itemData->getQuantity(), $taxAmount);
                $itemData->setTotalAmountWhitTax($totalAmountWhitTax);

                $this->saleItemRepository->createSaleItem($saleId, $itemData);
            }

            $this->pdo->commit();
            return $this->getSaleById($saleId);
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            throw new Exception("Erro ao criar venda: " . $e->getMessage());
        }
    }

    public function getSaleById($saleId)
    {
        $saleData = [];
        $totalTaxes = 0;
        $totalSaleWithoutTaxes = 0;
        $totalSaleWithTaxes = 0;

        try {
            $stmt = $this->pdo->prepare("
        SELECT s.*, si.product_id, si.quantity, si.unit_price, si.tax_amount, si.total_amount, p.name AS product_name, pt.name AS category_name
        FROM sales s
        LEFT JOIN sale_items si ON s.id = si.sale_id
        LEFT JOIN products p ON si.product_id = p.id
        LEFT JOIN product_types pt ON p.productTypeId = pt.id
        WHERE s.id = :saleId
        ");
            $stmt->execute([':saleId' => $saleId]);
            $saleItems = $stmt->fetchAll();

            if ($saleItems) {
                foreach ($saleItems as $item) {
                    $totalTaxes += $item['tax_amount'];
                    $totalSaleWithoutTaxes += $item['unit_price'] * $item['quantity'];
                    $totalSaleWithTaxes += $item['total_amount'];
                }

                $saleData = [
                    'saleDetails' => array_map(function ($item) {
                        return [
                            'id' => $item['id'],
                            'product_id' => $item['product_id'],
                            'product_name' => $item['product_name'],
                            'category_name' => $item['category_name'],
                            'quantity' => $item['quantity'],
                            'unit_price' => $item['unit_price'],
                            'tax_amount' => $item['tax_amount'],
                            'total_amount' => $item['total_amount'],
                        ];
                    }, $saleItems),
                    'totalTaxes' => $totalTaxes,
                    'totalSaleWithoutTaxes' => $totalSaleWithoutTaxes,
                    'totalSaleWithTaxes' => $totalSaleWithTaxes
                ];
            }

            return $saleData;
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar venda: " . $e->getMessage());
        }
    }

}