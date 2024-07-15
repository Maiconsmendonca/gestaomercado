<?php
namespace App\Service;

use App\Repository\ProductRepository;

class ProductService {
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function addProduct($name, $productTypeId, $price): void
    {
        $product = new \stdClass();
        $product->name = $name;
        $product->productTypeId = $productTypeId;
        $product->price = $price;
        $this->productRepository->insertProduct($product);
    }
}