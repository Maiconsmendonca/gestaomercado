<?php
namespace App\Controller;

use App\Service\ProductService;
use App\Repository\ProductRepository;
use http\Client\Request;

class ProductController {
    private ProductService $productService;

    public function __construct() {
        $productRepository = new ProductRepository();
        $this->productService = new ProductService($productRepository);
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        header('Content-Type: application/json');
        echo json_encode($products);
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            http_response_code(404);
            echo json_encode(['message' => 'Produto não encontrado']);
            return;
        }

        header('Content-Type: application/json');
        echo json_encode($product);
    }

    public function store()
    {
        // Lê o corpo da requisição
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true); // Decodifica o JSON para um array associativo

        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode(['message' => 'Erro ao decodificar JSON']);
            return;
        }

        $name = $input['name'] ?? null;
        $productTypeId = $input['productTypeId'] ?? null;
        $price = $input['price'] ?? null;

        if ($name && $productTypeId && $price) {
            try {
                $this->productService->addProduct($name, $productTypeId, $price);
                http_response_code(201);
                echo json_encode(['message' => 'Produto adicionado com sucesso.']);
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode(['message' => 'Erro ao adicionar produto: ' . $e->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Dados incompletos para adicionar o produto.']);
        }
    }

    public function update($id)
    {
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true);

        $updated = $this->productService->updateProduct($id, $input);

        if ($updated) {
            http_response_code(200);
            echo json_encode(['message' => 'Produto atualizado com sucesso']);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Erro ao atualizar o produto']);
        }
    }

    public function destroy($id)
    {
        $deleted = $this->productService->deleteProduct($id);

        if ($deleted) {
            http_response_code(200);
            echo json_encode(['message' => 'Produto excluído com sucesso']);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Erro ao excluir o produto']);
        }
    }
}