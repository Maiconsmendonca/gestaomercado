<?php

namespace App\Helper;

class CalculateHelper
{
    public static function calculateTax($taxPercentage, $unitPrice)
    {
        return ($taxPercentage / 100) * $unitPrice;
    }

    public static function calculateTotalTax($tax, $quantity)
    {
        return $tax * $quantity;
    }

    public static function calculateTotalPrice($unitPrice, $quantity)
    {
        return $unitPrice * $quantity;
    }

    public static function calculateTotalWithTax($unitPrice, $quantity, $taxValue)
    {
        return ($unitPrice + $taxValue) * $quantity;
    }
}