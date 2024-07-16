<?php

namespace App\Service;

use App\Repository\SaleRepository;

class SaleService
{
    protected $saleRepository;
    protected $productService;
    protected $productTypeService;
    protected $taxService;
    protected $taxCalculator;

    public function __construct(SaleRepository $saleRepository, ProductService $productService, ProductTypeService $productTypeService, TaxService $taxService)
    {
        $this->saleRepository = $saleRepository;
        $this->productService = $productService;
        $this->productTypeService = $productTypeService;
        $this->taxService = $taxService;
        $this->taxCalculator = new TaxCalculator();
    }

    public function createSale($data)
    {
        $items = [];

        foreach ($data['items'] as $itemData) {
            $product = $this->productService->getProductById($itemData['product_id']);
            if (!$product) {
                throw new Exception('Produto não encontrado');
            }

            $productType = $this->productTypeService->getProductTypeById($product->typeId);
            if (!$productType) {
                throw new Exception('Tipo de produto não encontrado');
            }

            $tax = $this->taxCalculator->calculateTax($productType->taxRate, $itemData['unit_price'], $itemData['quantity']);
            $items[] = new SaleItem($itemData['product_id'], $itemData['quantity'], $itemData['unit_price'], $tax);
        }

        $sale = new Sale(null, date('Y-m-d'), $items);
        return $this->saleRepository->createSale($sale);
    }

    public function getAllSales()
    {
        return $this->saleRepository->getAllSales();
    }

    public function calculateTotals()
    {
        $sales = $this->saleRepository->getAllSales();
        $totalSales = 0;
        $totalTaxes = 0;

        foreach ($sales as $sale) {
            foreach ($sale->items as $item) {
                $totalSales += $item->unitPrice * $item->quantity;
                $totalTaxes += $item->tax;
            }
        }

        return [
            'total_sales' => $totalSales,
            'total_taxes' => $totalTaxes,
            'grand_total' => $totalSales + $totalTaxes
        ];
    }
}