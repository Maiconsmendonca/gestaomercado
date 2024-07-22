<?php

namespace App\Service;

use App\Models\ProductType;
use App\Repository\ProductTypeRepository;
use function PHPUnit\Framework\exactly;

/**
 *
 */
class ProductTypeService
{
    /**
     * @var ProductTypeRepository
     */
    private ProductTypeRepository $productTypeRepository;

    /**
     * @param $productTypeRepository
     */
    public function __construct($productTypeRepository)
    {
        $this->productTypeRepository = $productTypeRepository;
    }

    /**
     * @return array
     */
    public function getAllProductTypes()
    {
        $productTypesFromRepo = $this->productTypeRepository->getAll();

        $productTypesData = [];

        foreach ($productTypesFromRepo as $productType) {
            $productTypesData[] = [
                'id' => $productType->getId(),
                'name' => $productType->getName(),
                'taxPercentage' => $productType->getTaxPercentage()
            ];
        }

        return $productTypesData;

    }

    /**
     * @param $id
     * @return array|null
     */
    public function getProductTypeById($id)
    {
        $productType = $this->productTypeRepository->getById($id);

        if (!$productType) {
            return null;
        }
        return [
            'id' => $productType->getId(),
            'name' => $productType->getName(),
            'tax_percentage' => $productType->getTaxPercentage()
        ];
    }

    /**
     * @param $name
     * @param $taxPercentage
     * @return void
     */
    public function createProductType($name, $taxPercentage)
    {
        $productTypeData = [
            'name' => $name,
            'tax_percentage' => $taxPercentage,
        ];
        $productType = new ProductType($productTypeData);

        $this->productTypeRepository->insertProductType($productType);
    }

    /**
     * @param $id
     * @param $fields
     * @return bool
     */
    public function updateProductType($id, $fields)
    {
        return $this->productTypeRepository->update($id, $fields);
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteProductType($id)
    {
        return $this->productTypeRepository->delete($id);
    }
}