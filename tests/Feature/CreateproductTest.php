<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class CreateProductTest extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost/api',
            'http_errors' => false,
        ]);
    }

    public function testCreateProduct()
    {
        $response = $this->client->post('/product', [
            'json' => [
                'name' => 'Test Product',
                'price' => 10.99,
                // Adicione outros campos necessários
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('id', $data);
        $this->assertEquals('Test Product', $data['name']);
        // Adicione outras verificações conforme necessário
    }
}