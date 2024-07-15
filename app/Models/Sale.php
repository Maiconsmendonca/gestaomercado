<?php

namespace App\Models;

class Sale
{
    public $id;
    public $items = []; // Array of SaleItem
    public $totalAmount;
    public $totalTax;
}