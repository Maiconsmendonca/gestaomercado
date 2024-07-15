<?php

namespace App\Repository;

class SaleRepository
{
    public function getAllSales()
    {
        return "SELECT * FROM sales";
    }

    public function createSale($data)
    {
        return "INSERT INTO sales (product_id, quantity, sale_date) VALUES ({$data['product_id']}, {$data['quantity']}, '{$data['sale_date']}')";
    }

    public function getSaleById($id)
    {
        return "SELECT * FROM sales WHERE id = {$id}";
    }

    public function updateSale($id, $data)
    {
        return "UPDATE sales SET product_id = {$data['product_id']}, quantity = {$data['quantity']}, sale_date = '{$data['sale_date']}' WHERE id = {$id}";
    }

    public function deleteSale($id)
    {
        return "DELETE FROM sales WHERE id = {$id}";
    }
}