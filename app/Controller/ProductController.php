<?php
namespace App\Controller;

use App\Service\ProductService;
use App\Repository\ProductRepository;
use http\Client\Request;

/**
 *
 */
class ProductController {
    /**
     * @var ProductService
     */
    private ProductService $productService;

    /**
     *
     */
    public function __construct() {
        $productRepository = new ProductRepository();
        $this->productService = new ProductService($productRepository);
    }

    /**
     * @return void
     */
    public function index(): void
    {
        $products = $this->productService->getAllProducts();
        header('Content-Type: application/json');
        echo json_encode($products);
    }

    /**
     * @param $id
     * @return void
     */
    public function show($id): void
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

    /**
     * @return void
     */
    public function store(): void
    {
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true);

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

    /**
     * @param $id
     * @return void
     */
    public function update($id): void
    {
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true);

        if (json_last_error() !== JSON_ERROR_NONE || empty($input)) {
            http_response_code(400);
            echo json_encode(['message' => 'Dados de entrada inválidos.']);
        }

        $updated = $this->productService->updateProduct($id, $input);

        if ($updated) {
            http_response_code(200);
            echo json_encode(['message' => 'Produto atualizado com sucesso']);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Erro ao atualizar o produto']);
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function destroy($id): void
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