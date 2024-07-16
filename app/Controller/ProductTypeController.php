<?php

namespace App\Controller;

class ProductTypeController
{
    private $productTypeService;

    public function __construct($productTypeService)
    {
        $this->productTypeService = $productTypeService;
    }

    public function index()
    {
        $productTypes = $this->productTypeService->getAllProductTypes();
        header('Content-Type: application/json');
        echo json_encode($productTypes);
    }

    // Método para buscar um tipo de produto por ID
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

    // Método para criar um novo tipo de produto
    public function store()
    {
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true);

        $created = $this->productTypeService->createProductType($input);

        if ($created) {
            http_response_code(201); // Created
            echo json_encode(['message' => 'Tipo de produto criado com sucesso']);
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(['message' => 'Erro ao criar o tipo de produto']);
        }
    }

    // Método para atualizar um tipo de produto por ID
    public function update($id)
    {
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true);

        $updated = $this->productTypeService->updateProductType($id, $input);

        if ($updated) {
            http_response_code(200);
            echo json_encode(['message' => 'Tipo de produto atualizado com sucesso']);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Erro ao atualizar o tipo de produto']);
        }
    }

    // Método para excluir um tipo de produto por ID
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