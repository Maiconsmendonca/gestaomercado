<?php

namespace App\Models;

use AllowDynamicProperties;

/**
 *
 */
class Product {
    /**
     * @var mixed|null
     */
    private mixed $id;
    /**
     * @var mixed|string
     */
    private mixed $name;
    /**
     * @var int|mixed
     */
    private mixed $price;
    /**
     * @var int|mixed
     */
    private mixed $taxPercentage;
    /**
     * @var mixed|null
     */
    private mixed $productTypeId;

    /**
     * @param array $data
     */
    public function __construct(array $data) {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->price = $data['price'] ?? 0;
        $this->taxPercentage = $data['tax_percentage'] ?? 0;
        $this->productTypeId = $data['productTypeId'] ?? null;
    }

    /**
     * @return mixed|null
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param $id
     * @return void
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return mixed|string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param $name
     * @return void
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return mixed|null
     */
    public function getProductTypeId() {
        return $this->productTypeId;
    }

    /**
     * @param $productTypeId
     * @return void
     */
    public function setProductTypeId($productTypeId) {
        $this->productTypeId = $productTypeId;
    }

    // Price

    /**
     * @return int|mixed
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * @param $price
     * @return void
     */
    public function setPrice($price) {
        $this->price = $price;
    }

    /**
     * @return int|mixed
     */
    public function getTaxPercentage() {
        return $this->taxPercentage;
    }

    /**
     * @param $taxPercentage
     * @return void
     */
    public function setTaxPercentage($taxPercentage) {
        $this->taxPercentage = $taxPercentage;
    }
}