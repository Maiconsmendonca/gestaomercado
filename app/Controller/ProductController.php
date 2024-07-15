<?php
namespace App\Controller;

use App\Service\ProductService;
use App\Repository\ProductRepository;

class ProductController {
    private ProductService $productService;

    public function __construct() {
        $productRepository = new ProductRepository();
        $this->productService = new ProductService($productRepository);
    }

    public function store() {
        $name = $_POST['name'] ?? null;
        $productTypeId = $_POST['productTypeId'] ?? null;
        $price = $_POST['price'] ?? null;

        if ($name && $productTypeId && $price) {
            try {
                $this->productService->addProduct($name, $productTypeId, $price);
                http_response_code(201); // Created
                echo json_encode(['message' => 'Produto adicionado com sucesso.']);
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode(['message' => 'Erro ao adicionar produto.']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Dados incompletos para adicionar o produto.']);
        }
    }
}