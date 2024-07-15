<?php

namespace App\Controller;

class TaxController
{
    private $taxService;

    public function __construct($taxService)
    {
        $this->taxService = $taxService;
    }

    public function index()
    {
        return $this->taxService->getAllTaxes();
    }

    public function store($data)
    {
        return $this->taxService->createTax($data);
    }

    public function show($id)
    {
        return $this->taxService->getTaxById($id);
    }

    public function update($id, $data)
    {
        return $this->taxService->updateTax($id, $data);
    }

    public function destroy($id)
    {
        return $this->taxService->deleteTax($id);
    }
}