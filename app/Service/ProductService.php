<?php
namespace App\Service;

use App\Models\Product;
use App\Repository\ProductRepository;
use function PHPUnit\Framework\exactly;

/**
 *
 */
class ProductService {
    /**
     * @var ProductRepository
     */
    private ProductRepository $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

    /**
     * @return array
     */
    public function getAllProducts() {
        $productsFromRepo = $this->productRepository->getAll();
        $productsData = [];

        foreach ($productsFromRepo as $product) {
            $productsData[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'category' => $product->getProductTypeId(),
                'price' => $product->getPrice(),
                'taxPercentage' => $product->getTaxPercentage()
            ];
        }

        return $productsData;
    }

    /**
     * @param $id
     * @return array|null
     */
    public function getProductById($id) {
        $product = $this->productRepository->getById($id);

        if (!$product) {
            return null;
        }
        return [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'category' => $product->getProductTypeId(),
            'taxPercentage' => $product->getTaxPercentage()
        ];
    }

    /**
     * @param $name
     * @param $productTypeId
     * @param $price
     * @return void
     */
    public function addProduct($name, $productTypeId, $price): void {
        $productData = [
            'name' => $name,
            'productTypeId' => $productTypeId,
            'price' => $price
        ];
        $product = new Product($productData);
        $this->productRepository->insertProduct($product);
    }

    /**
     * @param $id
     * @param $fields
     * @return bool
     */
    public function updateProduct($id, $fields)
    {
        return $this->productRepository->update($id, $fields);
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteProduct($id) {
        return $this->productRepository->delete($id);
    }
}