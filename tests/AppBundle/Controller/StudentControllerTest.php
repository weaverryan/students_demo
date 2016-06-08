<?php

namespace Tests\AppBundle\Controller;

use GuzzleHttp\Client;

class StudentControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testPOSTCreateStudent()
    {
        $data = [
            'email' => 'weaverryan@gmail.com',
            'firstName' => 'Ryan',
            'lastName' => 'Weaver',
        ];

        $client = new Client(['base_uri' => 'http://localhost:9007']);
        $response = $client->post('/api/students', [
            'body' => json_encode($data)
        ]);

        $this->assertEquals(201, $response->getStatusCode());
        $responseBody = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('id', $responseBody);
    }
}
