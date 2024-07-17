<?php

namespace App\Models;

class Sale
{
    private $id;
    private $saleItemId;
    private $taxAmount;
    private $totalAmount;

    public function __construct($id, $saleItemId, $taxAmount, $totalAmount)
    {
        $this->id = $id;
        $this->saleItemId = $saleItemId;
        $this->taxAmount = $taxAmount;
        $this->totalAmount = $totalAmount;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getSaleItemId()
    {
        return $this->saleItemId;
    }

    public function setSaleItemId($saleItemId)
    {
        $this->saleItemId = $saleItemId;
    }

    public function getTaxAmount()
    {
        return $this->taxAmount;
    }

    public function setTaxAmount($taxAmount)
    {
        $this->taxAmount = $taxAmount;
    }

    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }
}