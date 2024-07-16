<?php

namespace App\Models;

class ProductType
{
    private $id;
    private $name;
    private $taxPercentage;

    public function __construct($id, $name, $taxPercentage)
    {
        $this->id = $id;
        $this->name = $name;
        $this->taxPercentage = $taxPercentage;
    }
}