<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Test\ApiTestCase;

class CourseControllerTest extends ApiTestCase
{
    public function testAddStudentToCourse()
    {
        $student = $this->createStudent('weaverryan@gmail.com', 'Ryan');
        $course = $this->createCourse('some course');

        $data = [
            'studentId' => $student->getId()
        ];

        $response = $this->client->post(sprintf('/api/courses/%s/students', $course->getId()), [
            'body' => json_encode($data)
        ]);

        $this->assertEquals(201, $response->getStatusCode());
        $this->asserter()->assertResponsePropertyExists(
            $response,
            'id' // id of the enrollment
        );
        $this->asserter()->assertResponsePropertyEquals(
            $response,
            'studentId',
            $student->getId()
        );
    }
}
