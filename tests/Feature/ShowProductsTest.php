<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class ShowProductTest extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost/api',
            'http_errors' => false,
        ]);
    }

    public function testShowProduct()
    {
        $productId = 1; // Substitua pelo ID de um produto existente
        $response = $this->client->get("/product/{$productId}");
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertEquals($productId, $data['id']);
        // Adicione outras verificações conforme necessário
    }
}