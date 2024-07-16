<?php

namespace App\Service;

use App\Repository\ProductRepository;

class ProductTypeService
{
    private ProductRepository $productTypeRepository;

    public function __construct($productTypeRepository)
    {
        $this->productTypeRepository = $productTypeRepository;
    }

    public function getAllProductTypes()
    {
        return $this->productTypeRepository->getAll();
    }

    public function getProductTypeById($id)
    {
        return $this->productTypeRepository->getById($id);
    }

    public function createProductType($data)
    {
        $newProductType = new ProductType(
            null, // O ID será gerado automaticamente pelo banco de dados
            $data['name'],
            $data['tax_percentage']
        );

        return $this->productTypeRepository->insert($newProductType);
    }

    public function updateProductType($id, $data)
    {
        $productType = $this->productTypeRepository->getById($id);

        if (!$productType) {
            return false; // Tipo de produto não encontrado
        }

        $updatedProductType = new ProductType(
            $id,
            $data['name'],
            $data['tax_percentage']
        );

        return $this->productTypeRepository->update($updatedProductType);
    }

    public function deleteProductType($id)
    {
        return $this->productTypeRepository->delete($id);
    }
}