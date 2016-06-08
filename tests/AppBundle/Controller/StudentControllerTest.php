<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Test\ApiTestCase;
use GuzzleHttp\Client;

class StudentControllerTest extends ApiTestCase
{
    public function testPOSTCreateStudent()
    {
        $data = [
            'email' => 'weaverryan@gmail.com',
            'firstName' => 'Ryan',
            'lastName' => 'Weaver',
        ];

        $response = $this->client->post('/api/students', [
            'body' => json_encode($data)
        ]);

        $this->assertEquals(201, $response->getStatusCode());
        $this->asserter()
            ->assertResponsePropertyExists($response, 'id');
    }
}
