<?php

namespace App\Models;

class Tax
{
    private $id;
    private $name;
    private $percentage;

    public function __construct($id, $name, $percentage)
    {
        $this->id = $id;
        $this->name = $name;
        $this->percentage = $percentage;
    }

}