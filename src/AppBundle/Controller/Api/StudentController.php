<?php

namespace AppBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class StudentController extends Controller
{
    /**
     * @Route("/api/students", name="api_student_create")
     * @Method("POST")
     */
    public function createAction()
    {
        return new JsonResponse([], 201);
    }
}
