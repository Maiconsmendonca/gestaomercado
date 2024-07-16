<?php

namespace App\Models;

class SaleItem
{
    public $productId;
    public $quantity;
    public $unitPrice;
    public $tax;

    public function __construct($productId = null, $quantity = null, $unitPrice = null, $tax = null)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
        $this->tax = $tax;
    }
}