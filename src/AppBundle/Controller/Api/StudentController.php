<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Student;
use AppBundle\Form\StudentForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class StudentController extends Controller
{
    /**
     * @Route("/api/students", name="api_student_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(StudentForm::class);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if (!$form->isValid()) {
            throw new BadRequestHttpException();
        }

        /** @var Student $student */
        $student = $form->getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($student);
        $em->flush();

        $json = $this->container->get('jms_serializer')
            ->serialize($student, 'json');

        return new Response($json, 201, [
            'Content-Type' => 'application/json'
        ]);
    }

    /**
     * @Route("/api/students/{id}", name="api_student_edit")
     * @Method("PUT")
     */
    public function editAction(Request $request, Student $student)
    {
        $form = $this->createForm(StudentForm::class, $student);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if (!$form->isValid()) {
            throw new BadRequestHttpException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($student);
        $em->flush();

        $json = $this->container->get('jms_serializer')
            ->serialize($student, 'json');

        return new Response($json, 200, [
            'Content-Type' => 'application/json'
        ]);
    }
}
