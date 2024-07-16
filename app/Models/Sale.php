<?php

namespace App\Models;

class Sale
{
    private $id;
    private $productId;
    private $quantity;
    private $unitPrice;
    private $taxAmount;
    private $totalAmount;

    public function __construct($id, $productId, $quantity, $unitPrice, $taxAmount, $totalAmount)
    {
        $this->id = $id;
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
        $this->taxAmount = $taxAmount;
        $this->totalAmount = $totalAmount;
    }
}