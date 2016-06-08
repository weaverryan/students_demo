<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Course;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends ApiBaseController
{
    /**
     * @Route("/api/courses/{id}/students", name="api_course_student_add")
     * @Method("POST")
     */
    public function addStudentAction(Course $course)
    {
        return new Response(null, 201);
    }
}