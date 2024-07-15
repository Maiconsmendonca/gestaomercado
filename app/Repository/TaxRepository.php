<?php

namespace App\Repository;

class TaxRepository
{
    public function getAllTaxes()
    {
        return "SELECT * FROM taxes";
    }

    public function createTax($data)
    {
        return "INSERT INTO taxes (name, percentage) VALUES ('{$data['name']}', {$data['percentage']})";
    }

    public function getTaxById($id)
    {
        return "SELECT * FROM taxes WHERE id = {$id}";
    }

    public function updateTax($id, $data)
    {
        return "UPDATE taxes SET name = '{$data['name']}', percentage = {$data['percentage']} WHERE id = {$id}";
    }

    public function deleteTax($id)
    {
        return "DELETE FROM taxes WHERE id = {$id}";
    }
}
