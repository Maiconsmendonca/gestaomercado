<?php

namespace App\Repository;

class SaleRepository
{
    public function createSale(Sale $sale)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("INSERT INTO sales (date) VALUES (:date)");
        $stmt->execute(['date' => $sale->date]);
        $saleId = $pdo->lastInsertId();

        // Insert sale items
        foreach ($sale->items as $item) {
            $this->createSaleItem($saleId, $item);
        }

        return $this->getSaleById($saleId);
    }

    protected function createSaleItem($saleId, SaleItem $item)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("INSERT INTO sale_items (sale_id, product_id, quantity, unit_price, tax) VALUES (:sale_id, :product_id, :quantity, :unit_price, :tax)");
        $stmt->execute([
            'sale_id' => $saleId,
            'product_id' => $item->productId,
            'quantity' => $item->quantity,
            'unit_price' => $item->unitPrice,
            'tax' => $item->tax
        ]);
    }

    public function getSaleById($id)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM sales WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        // Fetch sale items
        $items = $this->getSaleItemsBySaleId($id);

        return new Sale($row['id'], $row['date'], $items);
    }

    protected function getSaleItemsBySaleId($saleId)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM sale_items WHERE sale_id = :sale_id");
        $stmt->execute(['sale_id' => $saleId]);
        $items = [];
        while ($row = $stmt->fetch()) {
            $items[] = new SaleItem($row['product_id'], $row['quantity'], $row['unit_price'], $row['tax']);
        }
        return $items;
    }
}