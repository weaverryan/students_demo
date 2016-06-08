<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Student;
use AppBundle\Form\StudentForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class StudentController extends ApiBaseController
{
    /**
     * @Route("/api/students", name="api_student_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(StudentForm::class);
        $this->submitForm($request, $form);

        if (!$form->isValid()) {
            return $this->createFailedValidationResponse($form);
        }

        /** @var Student $student */
        $student = $form->getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($student);
        $em->flush();

        return $this->createApiResponse($student, 201);
    }

    /**
     * @Route("/api/students/{id}", name="api_student_edit")
     * @Method({"PUT", "PATCH"})
     */
    public function editAction(Request $request, Student $student)
    {
        $form = $this->createForm(StudentForm::class, $student);
        $this->submitForm($request, $form);

        if (!$form->isValid()) {
            return $this->createFailedValidationResponse($form);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($student);
        $em->flush();

        return $this->createApiResponse($student);
    }
}
