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
                'taxPorcentage' => $product->getTaxPorcentage()
            ];
        }

        return $productsData;
    }

    public function getProductById($id) {
        $product = $this->productRepository->getById($id);

        if (!$product) {
            return null;
        }
        return [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'taxPorcentage' => $product->getTaxPorcentage()
        ];
    }

    public function addProduct($name, $productTypeId, $price): void {
        $productData = [
            'name' => $name,
            'productTypeId' => $productTypeId,
            'price' => $price
        ];
        $product = new Product($productData);
        $this->productRepository->insertProduct($product);
    }

    public function updateProduct($id, $fields)
    {
        return $this->productRepository->update($id, $fields);
    }

    public function deleteProduct($id) {
        return $this->productRepository->delete($id);
    }
}