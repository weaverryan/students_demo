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
        $this->asserter()->assertResponsePropertyEquals(
            $response,
            'firstName',
            'Ryan'
        );
    }

    public function testPUTEditStudent()
    {
        $student = $this->createStudent('weaverryan@gmail.com', 'Ryan');

        $data = [
            'email' => 'weaverryan@gmail.com',
            'firstName' => 'Ryan2',
        ];

        $response = $this->client->put(sprintf('/api/students/%s', $student->getId()), [
            'body' => json_encode($data)
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->asserter()
            ->assertResponsePropertyEquals($response, 'id', $student->getId());
        $this->asserter()->assertResponsePropertyEquals(
            $response,
            'firstName',
            'Ryan2'
        );
    }

    public function testPATCHEditStudent()
    {
        $student = $this->createStudent('weaverryan@gmail.com', 'Ryan');

        $data = [
            'firstName' => 'Ryan2',
        ];

        $response = $this->client->patch(sprintf('/api/students/%s', $student->getId()), [
            'body' => json_encode($data)
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->asserter()->assertResponsePropertyEquals(
            $response,
            'email',
            'weaverryan@gmail.com'
        );
        $this->asserter()->assertResponsePropertyEquals(
            $response,
            'firstName',
            'Ryan2'
        );
    }

    public function testFailValidation()
    {
        $student = $this->createStudent('weaverryan@gmail.com', 'Ryan');

        $data = [
            'email' => 'weaverryan@gmail.com',
        ];

        $response = $this->client->post(sprintf('/api/students', $student->getId()), [
            'body' => json_encode($data)
        ]);

        $this->assertEquals(400, $response->getStatusCode());
        $this->asserter()->assertResponsePropertyEquals(
            $response,
            'errors.email[0]',
            'This email is already taken'
        );
    }

    public function testDelete()
    {
        $student = $this->createStudent('weaverryan@gmail.com');

        $response = $this->client->delete(sprintf('/api/students/%s', $student->getId()));

        $this->assertEquals(204, $response->getStatusCode());
    }
}
