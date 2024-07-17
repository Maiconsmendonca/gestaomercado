<?php

namespace App\Service;

use App\Models\ProductType;
use App\Repository\ProductTypeRepository;

class ProductTypeService
{
    private ProductTypeRepository $productTypeRepository;

    public function __construct($productTypeRepository)
    {
        $this->productTypeRepository = $productTypeRepository;
    }

    public function getAllProductTypes()
    {
        $productTypesFromRepo = $this->productTypeRepository->getAll();

        $productTypesData = [];

        foreach ($productTypesFromRepo as $productType) {
            $productTypesData[] = [
                'id' => $productType->getId(),
                'name' => $productType->getName(),
                'taxPorcentage' => $productType->getTaxPorcentage()
            ];
        }

        return $productTypesData;

    }

    public function getProductTypeById($id)
    {
        $productType = $this->productTypeRepository->getById($id);

        if (!$productType) {
            return null;
        }
        return [
            'id' => $productType->getId(),
            'name' => $productType->getName(),
            'taxPorcentage' => $productType->getTaxPorcentage()
        ];
    }

    public function createProductType($name, $taxPorcentage)
    {
        $productTypeData = [
            'name' => $name,
            'taxPorcentage' => $taxPorcentage,
        ];
        $productType = new ProductType($productTypeData);
        $this->productTypeRepository->insertProductType($productType);
    }

    public function updateProductType($id, $fields)
    {
        return $this->productTypeRepository->update($id, $fields);
    }

    public function deleteProductType($id)
    {
        return $this->productTypeRepository->delete($id);
    }
}