<?php
namespace App\Service;

use App\Models\Product;
use App\Repository\ProductRepository;

class ProductService {
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts() {
        $productsFromRepo = $this->productRepository->getAll();
        $productsData = [];

        foreach ($productsFromRepo as $product) {
            $productsData[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'taxRate' => $product->getTaxRate()
            ];
        }

        return $productsData;
    }

    public function getProductById($id) {
        $productsFromRepo = $this->productRepository->getById($id);
        $productsData = [];

        foreach ($productsFromRepo as $product) {
            $productsData[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'taxRate' => $product->getTaxRate()
            ];
        }

        return $productsData;
    }

    public function addProduct($name, $productTypeId, $price): void {
        // Ajuste para criar um produto usando um array associativo
        $productData = [
            'name' => $name,
            'productTypeId' => $productTypeId,
            'price' => $price
        ];
        $product = new Product($productData);
        $this->productRepository->insertProduct($product);
    }

    public function updateProduct($id, $data) {
        $product = $this->productRepository->getById($id);

        if (!$product) {
            return false; // Produto não encontrado
        }

        // Utilize os métodos setters para atualizar o produto
        $product->setName($data['name']);
        $product->setProductTypeId($data['productTypeId']);
        $product->setPrice($data['price']);

        return $this->productRepository->update($product);
    }

    public function deleteProduct($id) {
        return $this->productRepository->delete($id);
    }
}