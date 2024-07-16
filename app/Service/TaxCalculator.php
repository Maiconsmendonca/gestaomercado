<?php
namespace App\Service;

use App\Repository\TaxRepository;

class TaxCalculator {
    private TaxRepository $taxRepository;

    public function __construct(TaxRepository $taxRepository) {
        $this->taxRepository = $taxRepository;
    }

    public function calculateTax($taxRate, $unitPrice, $quantity)
    {
        $taxAmount = ($taxRate / 100) * $unitPrice * $quantity;
        return $taxAmount;
    }
}