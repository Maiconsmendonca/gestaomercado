<?php

namespace App\Models;

/**
 *
 */
class ProductType {
    /**
     * @var mixed|null
     */
    private $id;
    /**
     * @var mixed|null
     */
    private $name;
    /**
     * @var mixed|null
     */
    private $taxPercentage;

    /**
     * @param $data
     */
    public function __construct($data = null) {
        if ($data) {
            $this->id = $data['id'] ?? null;
            $this->name = $data['name'] ?? null;
            $this->taxPercentage = $data['tax_percentage'] ?? null;
        }
    }

    /**
     * @return mixed|null
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return mixed|null
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return mixed|null
     */
    public function getTaxPercentage() {
        return $this->taxPercentage;
    }
}