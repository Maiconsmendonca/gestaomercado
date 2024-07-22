<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\ProductTypeRepository;
use App\Repository\SaleRepository;
use App\Service\ProductService;
use App\Service\ProductTypeService;
use App\Service\SaleService;
use function PHPUnit\Framework\exactly;

/**
 *
 */
class SaleController
{
    /**
     * @var SaleService
     */
    private SaleService $saleService;

    /**
     *
     */
    public function __construct()
    {
        $saleRepository = new SaleRepository();
        $productRepository = new ProductRepository();
        $productTypeRepository = new ProductTypeRepository();

        $productService = new ProductService($productRepository);
        $productTypeService = new ProductTypeService($productTypeRepository);

        $this->saleService = new SaleService($saleRepository, $productService, $productTypeService);
    }

    /**
     * @return void
     */
    public function index()
    {
        $sales = $this->saleService->getAllSales();

        header('Content-Type: application/json');
        if (empty($sales)) {
            http_response_code(404); // Not Found
            echo json_encode(['message' => 'No sales found']);
        } else {
            http_response_code(200); // OK
            echo json_encode($sales);
        }
    }

    /**
     * @return void
     */
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

    /**
     * @param $id
     * @return void
     */
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

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        return $this->saleService->updateSale($id, $data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->saleService->deleteSale($id);
    }
}