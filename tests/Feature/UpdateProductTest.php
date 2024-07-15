<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class UpdateProductTest extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost/api',
            'http_errors' => false,
        ]);
    }

    public function testUpdateProduct()
    {
        $productId = 1; // Substitua pelo ID de um produto existente
        $response = $this->client->put("/product/{$productId}", [
            'json' => [
                'name' => 'Updated Product',
                'description' => 'This is an updated description.',
                'price' => 99.99,
            ],
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $body = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('id', $body);
        $this->assertEquals($productId, $body['id']);
        $this->assertEquals('Updated Product', $body['name']);
        $this->assertEquals('This is an updated description.', $body['description']);
        $this->assertEquals(99.99, $body['price']);
    }
}