<?php

namespace App\Helper;

/**
 *
 */
class CalculateHelper
{
    /**
     * @param $taxPercentage
     * @param $unitPrice
     * @return float|int
     */
    public static function calculateTax($taxPercentage, $unitPrice): float|int
    {
        return ($taxPercentage / 100) * $unitPrice;
    }

    /**
     * @param $tax
     * @param $quantity
     * @return float|int
     */
    public static function calculateTotalTax($tax, $quantity): float|int
    {
        return $tax * $quantity;
    }

    /**
     * @param $unitPrice
     * @param $quantity
     * @return float|int
     */
    public static function calculateTotalPrice($unitPrice, $quantity): float|int
    {
        return $unitPrice * $quantity;
    }

    /**
     * @param $unitPrice
     * @param $quantity
     * @param $taxValue
     * @return float|int
     */
    public static function calculateTotalWithTax($unitPrice, $quantity, $taxValue): float|int
    {
        return ($unitPrice + $taxValue) * $quantity;
    }
}