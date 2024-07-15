<?php

namespace App\Models;

class SaleItem
{
    public $id;
    public $items = []; // Array of SaleItem
    public $totalAmount;
    public $totalTax;
}