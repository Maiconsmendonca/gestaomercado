<?php

namespace App\Controller;

class SaleController
{
    private $saleService;

    public function __construct($saleService)
    {
        $this->saleService = $saleService;
    }

    public function index()
    {
        return $this->saleService->getAllSales();
    }

    public function store($data)
    {
        return $this->saleService->createSale($data);
    }

    public function show($id)
    {
        return $this->saleService->getSaleById($id);
    }

    public function update($id, $data)
    {
        return $this->saleService->updateSale($id, $data);
    }

    public function destroy($id)
    {
        return $this->saleService->deleteSale($id);
    }
}