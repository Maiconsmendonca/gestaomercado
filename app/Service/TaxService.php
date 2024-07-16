<?php

namespace App\Service;

use App\Repository\TaxRepository;

class TaxService
{
    protected $taxRepository;

    public function __construct(TaxRepository $taxRepository)
    {
        $this->taxRepository = $taxRepository;
    }

    public function getAllTaxes()
    {
        return $this->taxRepository->getAllTaxes();
    }

    public function getTaxById($id)
    {
        return $this->taxRepository->getTaxById($id);
    }

    public function createTax($data)
    {
        // Lógica para criar um novo imposto
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