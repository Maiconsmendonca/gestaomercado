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
        // Lógica para buscar todos os tipos de produtos
    }

    public function createProductType($data)
    {
        // Lógica para criar um novo tipo de produto
    }

    public function getProductTypeById($id)
    {
        // Lógica para buscar um tipo de produto pelo ID
    }

    public function updateProductType($id, $data)
    {
        // Lógica para atualizar um tipo de produto
    }

    public function deleteProductType($id)
    {
        // Lógica para deletar um tipo de produto
    }
}