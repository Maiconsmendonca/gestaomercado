<?php

namespace App\Service;

use App\Repository\TaxRepository;

class TaxService
{
    private TaxRepository $taxRepository;

    public function __construct($taxRepository)
    {
        $this->taxRepository = $taxRepository;
    }

    public function getAllTaxes()
    {
        // Lógica para buscar todos os impostos
    }

    public function createTax($data)
    {
        // Lógica para criar um novo imposto
    }

    public function getTaxById($id)
    {
        // Lógica para buscar um imposto pelo ID
    }

    public function updateTax($id, $data)
    {
        // Lógica para atualizar um imposto
    }

    public function deleteTax($id)
    {
        // Lógica para deletar um imposto
    }
}