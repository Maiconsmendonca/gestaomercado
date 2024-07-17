<?php

namespace App\Models;

class SaleItem
{
    private $productId;
    private $quantity;
    private $price;
    private $tax;
    private $taxPorcentage;

    private $taxAmount;
    private $totalAmount;

    private $totalAmountWhitTax;

    public function __construct($productId = null, $quantity = null, $price = null, $taxPorcentage = null, $tax = null, $totalAmount = null, $totalAmountWhitTax = null, $taxAmount = null)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->taxPorcentage = $taxPorcentage;
        $this->tax = $tax;
        $this->taxAmount = $taxAmount;
        $this->totalAmount = $totalAmount;
        $this->totalAmountWhitTax = $totalAmountWhitTax;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getTaxPorcentage()
    {
        return $this->taxPorcentage;
    }

    public function setTaxPorcentage($taxPorcentage)
    {
        $this->taxPorcentage = $taxPorcentage;
    }

    public function getTax()
    {
        return $this->tax;
    }

    public function setTax($tax)
    {
        $this->tax = $tax;
    }

    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }

    public function getTotalAmountWhitTax()
    {
        return $this->totalAmountWhitTax;
    }

    public function setTotalAmountWhitTax($totalAmountWhitTax)
    {
        $this->totalAmountWhitTax = $totalAmountWhitTax;
    }

    public function getTaxAmount()
    {
        return $this->taxAmount;
    }

    public function setTaxAmount($taxAmount)
    {
        $this->taxAmount = $taxAmount;
    }
}