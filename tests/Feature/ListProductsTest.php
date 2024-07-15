<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class ListProductsTest extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost/api',
            'http_errors' => false,
        ]);
    }

    public function testListProducts()
    {
        $response = $this->client->get('/product');
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertIsArray($data);
        // Adicione outras verificações conforme necessário
    }
}