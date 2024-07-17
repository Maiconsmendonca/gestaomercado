<?php

namespace App\Controller;

use App\Repository\ProductTypeRepository;
use App\Service\ProductTypeService;

class ProductTypeController
{
    private ProductTypeService $productTypeService;

    public function __construct()
    {
        $productTypeRepository = new ProductTypeRepository();

        $this->productTypeService = new ProductTypeService($productTypeRepository);
    }

    public function index()
    {
        $productTypes = $this->productTypeService->getAllProductTypes();
        header('Content-Type: application/json');
        echo json_encode($productTypes);
    }

    public function show($id)
    {
        $productType = $this->productTypeService->getProductTypeById($id);

        if (!$productType) {
            http_response_code(404);
            echo json_encode(['message' => 'Tipo de produto não encontrado']);
            return;
        }

        header('Content-Type: application/json');
        echo json_encode($productType);
    }

    public function store()
    {
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode(['message' => 'Erro ao decodificar JSON']);
            return;
        }

        $name = $input['name'] ?? null;
        $taxPorcentage = $input['taxPorcentage'] ?? null;

        if ($name && $taxPorcentage) {
            try {
                $this->productTypeService->createProductType($name, $taxPorcentage);
                http_response_code(201);
                echo json_encode(['message' => 'Tipo de produto adicionado com sucesso.']);
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode(['message' => 'Erro ao adicionar tipo de produto: ' . $e->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Dados incompletos para adicionar o tipo de produto.']);
        }
    }

    public function update($id)
    {
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true);

        if (json_last_error() !== JSON_ERROR_NONE || empty($input)) {
            http_response_code(400);
            echo json_encode(['message' => 'Dados de entrada inválidos.']);
        }

        $updated = $this->productTypeService->updateProductType($id, $input);

        if ($updated) {
            http_response_code(200);
            echo json_encode(['message' => 'Tipo de produto atualizado com sucesso']);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Erro ao atualizar o tipo de produto']);
        }
    }

    public function destroy($id)
    {
        $deleted = $this->productTypeService->deleteProductType($id);

        if ($deleted) {
            http_response_code(200);
            echo json_encode(['message' => 'Tipo de produto excluído com sucesso']);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Erro ao excluir o tipo de produto']);
        }
    }
}