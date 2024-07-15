<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class DeleteProductTest extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost/api',
            'http_errors' => false,
        ]);
    }

    public function testDeleteProduct()
    {
        $productId = 1; // Substitua pelo ID de um produto existente
        $response = $this->client->delete("/product/{$productId}");

        $this->assertEquals(200, $response->getStatusCode());

        // Verificar se o produto foi realmente deletado
        // Isso pode envolver fazer uma requisição GET para o produto e verificar se retorna 404 ou outra lógica conforme sua API
    }
}