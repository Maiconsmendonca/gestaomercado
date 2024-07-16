<?php

namespace App\Models;

use AllowDynamicProperties;

class Product
{
    private $id;
    private $name;
    private $price;
    private $taxRate;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->price = $data['price'] ?? 0;
        $this->taxRate = $data['tax_rate'] ?? 0;
    }

    // ID
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    // Name
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    // Product Type ID
    public function getProductTypeId() {
        return $this->productTypeId;
    }

    public function setProductTypeId($productTypeId) {
        $this->productTypeId = $productTypeId;
    }

    // Price
    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getTaxRate() {
        return $this->taxRate;
    }

    public function setTaxRate($taxRate) {
        $this->taxRate = $taxRate;
    }
}