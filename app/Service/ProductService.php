<?php
namespace App\Service;

use App\Models\Product;
use App\Repository\ProductRepository;

class ProductService {
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAll();
    }

    public function getProductById($id)
    {
        var_dump($this->productRepository->getAll());exit;

        return $this->productRepository->getById($id);
    }

    public function addProduct($name, $productTypeId, $price): void
    {
        $product = new Product($name, $productTypeId, $price);

        $product->getName = $name;
        $product->getProductTypeId = $productTypeId;
        $product->getPrice = $price;
        $this->productRepository->insertProduct($product);
    }

    public function updateProduct($id, $data)
    {
        $product = $this->productRepository->getById($id);

        if (!$product) {
            return false; // Produto não encontrado
        }

        $updatedProduct = new Product(
            $id,
            $data['name'],
            $data['productTypeId'],
            $data['price']
        );

        return $this->productRepository->update($updatedProduct);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }
}