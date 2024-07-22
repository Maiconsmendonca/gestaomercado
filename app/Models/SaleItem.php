<?php

namespace App\Models;

/**
 *
 */
class SaleItem
{
    /**
     * @var mixed|null
     */
    private $productId;
    /**
     * @var mixed|null
     */
    private $quantity;
    /**
     * @var mixed|null
     */
    private $price;
    /**
     * @var mixed|null
     */
    private $tax;
    /**
     * @var
     */
    private $taxPercentage;

    /**
     * @var mixed|null
     */
    private $taxAmount;
    /**
     * @var mixed|null
     */
    private $totalAmount;

    /**
     * @var mixed|null
     */
    private $totalAmountWhitTax;

    /**
     * @param $productId
     * @param $quantity
     * @param $price
     * @param $taxrcentage
     * @param $tax
     * @param $totalAmount
     * @param $totalAmountWhitTax
     * @param $taxAmount
     */
    public function __construct($productId = null, $quantity = null, $price = null, $taxrcentage = null, $tax = null, $totalAmount = null, $totalAmountWhitTax = null, $taxAmount = null)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->taxPercentage = $taxPercentage;
        $this->tax = $tax;
        $this->taxAmount = $taxAmount;
        $this->totalAmount = $totalAmount;
        $this->totalAmountWhitTax = $totalAmountWhitTax;
    }

    /**
     * @return mixed|null
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param $productId
     * @return void
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return mixed|null
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param $quantity
     * @return void
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed|null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param $price
     * @return void
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getTaxPercentage()
    {
        return $this->taxPercentage;
    }

    /**
     * @param $taxPercentage
     * @return void
     */
    public function setTaxPercentage($taxPercentage)
    {
        $this->taxPercentage = $taxPercentage;
    }

    /**
     * @return mixed|null
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param $tax
     * @return void
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
    }

    /**
     * @return mixed|null
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @param $totalAmount
     * @return void
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return mixed|null
     */
    public function getTotalAmountWhitTax()
    {
        return $this->totalAmountWhitTax;
    }

    /**
     * @param $totalAmountWhitTax
     * @return void
     */
    public function setTotalAmountWhitTax($totalAmountWhitTax)
    {
        $this->totalAmountWhitTax = $totalAmountWhitTax;
    }

    /**
     * @return mixed|null
     */
    public function getTaxAmount()
    {
        return $this->taxAmount;
    }

    /**
     * @param $taxAmount
     * @return void
     */
    public function setTaxAmount($taxAmount)
    {
        $this->taxAmount = $taxAmount;
    }
}