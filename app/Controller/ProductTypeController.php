<?php

namespace App\Controller;

class ProductTypeController
{
    private $productTypeService;

    public function __construct($productTypeService)
    {
        $this->productTypeService = $productTypeService;
    }

    public function index()
    {
        return $this->productTypeService->getAllProductTypes();
    }

    public function store($data)
    {
        return $this->productTypeService->createProductType($data);
    }

    public function show($id)
    {
        return $this->productTypeService->getProductTypeById($id);
    }

    public function update($id, $data)
    {
        return $this->productTypeService->updateProductType($id, $data);
    }

    public function destroy($id)
    {
        return $this->productTypeService->deleteProductType($id);
    }
}