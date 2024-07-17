<?php

namespace App\Models;

class ProductType
{
    private $id;
    private $name;
    private $taxPorcentage;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->taxPorcentage = $data['taxPorcentage'] ?? 0;
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

    public function getTaxPorcentage() {
        return $this->taxPorcentage;
    }

    public function setTaxPorcentage($taxPorcentage) {
        $this->taxPorcentage = $taxPorcentage;
    }
}