<?php

namespace App\Models;

/**
 *
 */
class Statistics
{
    /**
     * @var
     */
    private $totalItemsSold;
    /**
     * @var
     */
    private $totalSalesValue;
    /**
     * @var
     */
    private $totalProductsRegistered;
    /**
     * @var
     */
    private $totalCategoriesRegistered;
    /**
     * @var
     */
    private $totalItemsSoldByProduct;

    /**
     * @param $totalItemsSold
     * @param $totalSalesValue
     * @param $totalProductsRegistered
     * @param $totalCategoriesRegistered
     * @param $totalItemsSoldByProduct
     */
    public function __construct($totalItemsSold, $totalSalesValue, $totalProductsRegistered, $totalCategoriesRegistered, $totalItemsSoldByProduct)
    {
        $this->totalItemsSold = $totalItemsSold;
        $this->totalSalesValue = $totalSalesValue;
        $this->totalProductsRegistered = $totalProductsRegistered;
        $this->totalCategoriesRegistered = $totalCategoriesRegistered;
        $this->totalItemsSoldByProduct = $totalItemsSoldByProduct;
    }

    // Getters and Setters

    /**
     * @return mixed
     */
    public function getTotalItemsSold() { return $this->totalItemsSold; }

    /**
     * @param $totalItemsSold
     * @return void
     */
    public function setTotalItemsSold($totalItemsSold) { $this->totalItemsSold = $totalItemsSold; }

    /**
     * @return mixed
     */
    public function getTotalSalesValue() { return $this->totalSalesValue; }

    /**
     * @param $totalSalesValue
     * @return void
     */
    public function setTotalSalesValue($totalSalesValue) { $this->totalSalesValue = $totalSalesValue; }

    /**
     * @return mixed
     */
    public function getTotalProductsRegistered() { return $this->totalProductsRegistered; }

    /**
     * @param $totalProductsRegistered
     * @return void
     */
    public function setTotalProductsRegistered($totalProductsRegistered) { $this->totalProductsRegistered = $totalProductsRegistered; }

    /**
     * @return mixed
     */
    public function getTotalCategoriesRegistered() { return $this->totalCategoriesRegistered; }

    /**
     * @param $totalCategoriesRegistered
     * @return void
     */
    public function setTotalCategoriesRegistered($totalCategoriesRegistered) { $this->totalCategoriesRegistered = $totalCategoriesRegistered; }

    /**
     * @return mixed
     */
    public function getTotalItemsSoldByProduct() { return $this->totalItemsSoldByProduct; }

    /**
     * @param $totalItemsSoldByProduct
     * @return void
     */
    public function setTotalItemsSoldByProduct($totalItemsSoldByProduct) { $this->totalItemsSoldByProduct = $totalItemsSoldByProduct; }
}
