<?php

namespace App\Service;

use App\Helper\CalculateHelper;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Repository\SaleRepository;
use Exception;
use PDOException;
use function PHPUnit\Framework\exactly;

class SaleService
{
    protected $saleRepository;
    protected $productService;
    protected $productTypeService;
    private $saleItemRepository;

    public function __construct(SaleRepository $saleRepository, ProductService $productService, ProductTypeService $productTypeService)
    {
        $this->saleRepository = $saleRepository;
        $this->productService = $productService;
        $this->productTypeService = $productTypeService;
    }

    public function createSale($data)
    {
        $items = [];

        foreach ($data['items'] as $itemData) {
            $product = $this->productService->getProductById($itemData['product_id']);
            if (!$product) {
                throw new Exception('Produto não encontrado');
            }

            $items[] = new SaleItem($itemData['product_id'], $itemData['quantity'], $product['price'], $product['taxPorcentage']);
        }
        $saleId = $this->saleRepository->createSale($items);
        $this->saleItemRepository->createSaleItem($saleId, $items);
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

    public function getSaleDetails($saleId)
    {
        try {
            $saleData = $this->saleRepository->getSaleById($saleId);

            $formattedSaleItems = [];
            $totalTaxes = 0;
            $totalSaleWithoutTaxes = 0;
            $totalSaleWithTaxes = 0;

            foreach ($saleData['saleDetails'] as $item) {
                // Calcula a porcentagem de taxa e o valor da taxa sem multiplicação
                $taxPercentage = ($item['tax_amount'] / ($item['unit_price'] * $item['quantity'])) * 100;
                $taxValue = $item['tax_amount'] / $item['quantity'];

                $formattedSaleItems[] = [
                    'id' => $item['id'],
                    'product_id' => $item['product_id'],
                    'product_name' => $item['product_name'],
                    'category_name' => $item['category_name'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'tax_amount' => $item['tax_amount'],
                    'total_amount' => $item['total_amount'],
                    'tax_percentage' => round($taxPercentage, 2), // Arredonda para 2 casas decimais
                    'tax_value' => round($taxValue, 2) // Arredonda para 2 casas decimais
                ];

                $totalTaxes += $item['tax_amount'];
                $totalSaleWithoutTaxes += ($item['unit_price'] * $item['quantity']);
                $totalSaleWithTaxes += ($item['unit_price'] * $item['quantity']) + $item['tax_amount'];
            }

            $totalTaxes = round($totalTaxes, 2);
            $totalSaleWithTaxes = round($totalSaleWithTaxes, 2);

            return [
                'saleDetails' => $formattedSaleItems,
                'totals' => [
                    'totalTaxes' => $totalTaxes,
                    'totalSaleWithoutTaxes' => $totalSaleWithoutTaxes,
                    'totalSaleWithTaxes' => $totalSaleWithTaxes,
                ]
            ];
        } catch (Exception $e) {
            throw new Exception("Erro ao buscar detalhes da venda: " . $e->getMessage());
        }
    }
}