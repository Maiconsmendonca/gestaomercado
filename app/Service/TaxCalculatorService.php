<?php
namespace App\Service;

use App\Repository\TaxRepository;

class TaxCalculatorService {
    private TaxRepository $taxRepository;

    public function __construct(TaxRepository $taxRepository) {
        $this->taxRepository = $taxRepository;
    }

    public function calculateTax($taxPorcentage, $unitPrice, $quantity)
    {
        $taxAmount = ($taxPorcentage / 100) * $unitPrice * $quantity;
        return $taxAmount;
    }
}