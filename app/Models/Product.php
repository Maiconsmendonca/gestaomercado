<?php

namespace App\Models;

use AllowDynamicProperties;

class Product {
    private $id;
    private $name;
    private $price;
    private $taxPorcentage;
    private $productTypeId;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->price = $data['price'] ?? 0;
        $this->taxPorcentage = $data['tax_porcentage'] ?? 0;
        $this->productTypeId = $data['productTypeId'] ?? null;
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

    // Setter para productTypeId
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

    public function getTaxPorcentage() {
        return $this->taxPorcentage;
    }

    public function setTaxPorcentage($taxPorcentage) {
        $this->taxPorcentage = $taxPorcentage;
    }
}