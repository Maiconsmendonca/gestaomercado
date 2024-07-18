<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\ProductTypeRepository;
use App\Repository\SaleRepository;
use App\Service\ProductService;
use App\Service\ProductTypeService;
use App\Service\SaleService;

class aleController
{
    private SaleService $saleService;

    public function __construct()
    {
        $saleRepository = new SaleRepository();
        $productRepository = new ProductRepository();
        $productTypeRepository = new ProductTypeRepository();

        $productService = new ProductService($productRepository);
        $productTypeService = new ProductTypeService($productTypeRepository);

        $this->saleService = new SaleService($saleRepository, $productService, $productTypeService);
    }

    public function index()
    {
        return $this->saleService->getAllSales();
    }

    public function store()
    {
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode(['message' => 'Invalid JSON']);
            return;
        }

        if (!isset($input['date']) || empty($input['items'])) {
            http_response_code(400);
            echo json_encode(['message' => 'Missing date or items']);
            return;
        }

        try {
            $result = $this->saleService->createSale($input);
            if ($result) {
                http_response_code(201);
                echo json_encode(['message' => 'Sale created successfully']);
            } else {
                throw new \Exception('Failed to create sale.');
            }
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Error creating sale: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $response = $this->saleService->getSaleDetails($id);

            header('Content-Type: application/json');
            echo json_encode($response);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Error fetching sale details: ' . $e->getMessage()]);
        }
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